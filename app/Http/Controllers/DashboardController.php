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

      $clients = Presale::whereBetween('presales.created_at', [date('Y-m') . '-01', date('Y-m-d')])
      ->orderBy('presales.total_paid', 'desc')
      ->limit(10)
      ->get();
      //dd($clients[0]->client->name);
      $top_clients = array();
      foreach ($clients as $item) {
        array_push($top_clients, [
          'client' => $item->client->name,
          'total_orders' => count(DB::select('select id from presales WHERE client_id = ? AND (created_at BETWEEN ? AND ?)', [$item->client->id, date('Y-m') . '-01', date('Y-m-d')]))
        ]);
      }

      dd($presale, $order_total, count($orders_complete), $total_sale, $top_articles, $top_clients);
      return Inertia::render('Dashboard',[
        'presale' => $presale,
        'order_total' => $order_total,
        'orders_complete' => count($orders_complete),
        'total_sale' => $total_sale,
        'top_clients' => $top_clients,
      ]);
    }
}
