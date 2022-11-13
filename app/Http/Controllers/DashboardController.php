<?php

namespace App\Http\Controllers;

use App\Models\Presale;
use App\Models\Client;
use App\Models\PresaleDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
      if ( ! Auth::user()->can('client_index')){
        return redirect()->back()->withErrors(['error' => 'No posees los permisos necesarios. Ponte en contacto con tu manager!.']);
      }

      $presale = Presale::whereDate('created_at', now())->paginate(25);
      $order_total = count($presale);
      $orders_complete = $presale->where('paid', '=', 1);
      $total_sale = $orders_complete->sum('total_paid');
      $top_articles = DB::select('SELECT a.id, a.name AS article, s.sale_price, ca.name AS category, su.name AS suppliers
      FROM `presale_details` p
      INNER JOIN stocks s on s.article_id = p.article_id
      INNER JOIN articles a on a.id = s.article_id
      INNER JOIN category_articles ca on ca.id = a.category_id
      INNER JOIN suppliers su on su.id = s.supplier_id
      WHERE (p.created_at BETWEEN ? AND ?)
      ORDER BY s.sale_price DESC
      LIMIT 10', [date('Y-m') . '-01', date('Y-m-d')]);

      $clients = DB::select("select distinct(p.client_id), c.name
      from presales p
      inner join clients c on c.id = p.client_id
      where (p.created_at BETWEEN '2022-11-01 23:59:59' AND '2022-11-12 23:59:59') and p.total_paid > 0
      order by p.total_paid limit 10");

      $top_clients = [];
      for ($i=0; $i < count($clients); $i++) {
        $item = [
          'id' => $clients[$i]->client_id,
          'client' => $clients[$i]->name,
          'count_presales' => count(DB::select('select id from presales where client_id = ?', [$clients[$i]->client_id])),
        ];
        $top_clients[] = $item;
      }

      $sales_for_mont = Presale::select(
        DB::raw('sum(presales.total_paid) as sums'),
        DB::raw("DATE_FORMAT(presales.created_at,'%M %Y') as months"),
        )
      ->groupBy('months')
      ->orderBy('presales.created_at', 'asc')
      ->get()
      ->toArray();

      dd($presale, $order_total, count($orders_complete), $total_sale, $top_articles, $top_clients, $sales_for_mont);
      return Inertia::render('Dashboard',[
        'presale' => $presale,
        'order_total' => $order_total,
        'orders_complete' => count($orders_complete),
        'total_sale' => $total_sale,
        'top_clients' => $top_clients,
        'sales_for_mont' => $sales_for_mont,
      ]);
    }
}
