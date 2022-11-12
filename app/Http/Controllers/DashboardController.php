<?php

namespace App\Http\Controllers;

use App\Models\Presale;
use App\Models\Client;
use App\Models\PresaleDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Http\Resources\PresaleDetailCollection;

class DashboardController extends Controller
{
    public function index()
    {
      if ( ! Auth::user()->can('client_index')){
        return redirect()->back()->withErrors(['error' => 'No posees los permisos necesarios. Ponte en contacto con tu manager!.']);
      }
      $presale = Presale::whereDate('created_at', now())->get();
      $order_total = count($presale->where('client_id', '<>', '1'));
      $orders_complete = $presale->where('paid', '=', 1);
      $total_sale = $orders_complete->sum('total_paid');
      
      $top_articles = DB::select('SELECT a.id, a.name AS article, s.sale_price, ca.name AS category, su.name AS suppliers, p.total_articles AS total
        FROM `presale_details` p
        INNER JOIN stocks s
        INNER JOIN articles a on a.id = p.article_id
        INNER JOIN category_articles ca on ca.id = a.category_id
        INNER JOIN suppliers su on su.id = s.supplier_id
        WHERE (p.created_at BETWEEN ? AND ?)', [date('Y-m') . '-01 00:00:00', date('Y-m-d 23:59:59')]
      );

      $clients = Presale::whereBetween('presales.created_at', [date('Y-m') . '-01 00:00:00', date('Y-m-d 23:59:59')])
      ->where('paid', '=', 1)
      ->where('client_id', '<>', 1)
      ->orderBy('presales.total_paid', 'desc')
      ->get()
      ->keyBy('client_id')
      ->take(5);
      
      $top_clients = array();
      foreach ($clients as $item) {
        array_push($top_clients, [
          'client' => $item->client->name,
          'total_orders' => count(DB::select('select id from presales WHERE client_id = ? AND (created_at BETWEEN ? AND ?)', [$item->client->id, date('Y-m') . '-01 00:00:00', date('Y-m-d 23:59:59')]))
        ]);
      }


      return Inertia::render('Dashboard',[
        'order_total' => $order_total,
        'orders_complete' => count($orders_complete),
        'total_sale' => $total_sale,
        'top_clients' => $top_clients,
        'top_articles' => $top_articles
      ]);
    }
}
