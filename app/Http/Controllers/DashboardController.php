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
      $top_articles = DB::select('SELECT DISTINCT(p.article_id), a.id, a.name AS article, s.sale_price, ca.name AS category, su.name AS suppliers
      FROM `presale_details` p
      INNER JOIN stocks s
      INNER JOIN articles a on a.id = p.article_id
      INNER JOIN category_articles ca on ca.id = a.category_id
      INNER JOIN suppliers su on su.id = s.supplier_id
      WHERE (p.created_at BETWEEN ? AND ?)
      LIMIT 10', [date('Y-m') . '-01 00:00:00', date('Y-m-d 23:59:59')]);


      $clients = DB::select("SELECT DISTINCT(p.client_id), c.name, p.total_paid
      FROM presales p
      INNER JOIN clients c on c.id = p.client_id
      WHERE (p.created_at BETWEEN ? AND ?) AND p.total_paid > 0 AND c.id != 1
      ORDER BY p.total_paid LIMIT 10", [date('Y-m') . '-01 00:00:00', date('Y-m-d') . ' 23:59:59']);

      $top_clients = [];
      for ($i=0; $i < count($clients); $i++) {
        $item = [
          'id' => $clients[$i]->client_id,
          'client' => $clients[$i]->name,
          'count_presales' => count(DB::select('SELECT id FROM presales WHERE client_id = ?', [$clients[$i]->client_id])),
        ];
        $top_clients[] = $item;
      }


      $sales_for_month = Presale::select(
        DB::raw('sum(presales.total_paid) as sums'),
        DB::raw("DATE_FORMAT(presales.created_at,'%M %Y') as months"),
        )
        ->groupBy('created_at')
        ->orderBy('presales.created_at', 'asc')
        ->get();

      return Inertia::render('Dashboard',[
        'presale' => $presale,
        'order_total' => $order_total,
        'orders_complete' => count($orders_complete),
        'total_sale' => $total_sale,
        'top_clients' => $top_clients,
        'sales_for_month' => $sales_for_month->toArray(),
        'top_articles' => $top_articles
      ]);
    }
}
