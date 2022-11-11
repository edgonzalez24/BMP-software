<?php

namespace App\Http\Controllers;

use App\Models\Presale;
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
      $top_articles = DB::select('SELECT p.*
      FROM presale_details p
      ORDER BY p.total_articles DESC
      LIMIT 5');
      dd($presale, $order_total, count($orders_complete), $total_sale, $top_articles);
      return Inertia::render('Dashboard',[
        'presale' => $presale,
        'order_total' => $order_total,
        'orders_complete' => count($orders_complete),
        'total_sale' => $total_sale,
      ]);
    }
}
