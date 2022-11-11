<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Models\Presale;
use App\Models\HistoryPayment;
use App\Http\Resources\Presale as PresaleResources;
use App\Http\Resources\PresaleCollection;

class AccountHistory extends Controller
{
    public function index(Request $request)
    {
        $from = "{$request->get('from')} 00:00:00";
        $to = "{$request->get('to')} 23:59:59";
        $filter = Presale::orderBy('id', 'desc');
        $client_id = $request->get('client_id');
        $clients = Client::orderBy('id', 'desc')->get();
        $history = null;

        if ( ! Auth::user()->can('acountHistory_index')){
            return redirect()->back()->withErrors(['error' => 'No posees los permisos necesarios. Ponte en contacto con tu manager!.']);
        }
        try {
            if ($request->get('from') && $request->get('to')){
                $filter = Presale::whereBetween('created_at', [$from, $to]);
            }

            if (isset($client_id)) {
                $filter->where('client_id', $client_id);
            }

            if($request->get('history')){
              $history = HistoryPayment::where('presale_id', $request->get('history'))->orderBy('id', 'desc')->get();
            }

            $presales = new PresaleCollection($filter->where('dispatch_id', '4')->where('total_pending', '>', 0)->paginate(25));
            return Inertia::render('AccountHistory/Show',[
                'presales' => $presales,
                'clients' => $clients,
                'history'=> $history

            ]);
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => $th]);
        }
    }

    public function payment(Request $request)
    {
      try {
        if ($request->get('presale_id')) {
          $presale = Presale::find($request->get('presale_id'));
          if ($presale->total_pending > 0) {
            $pending = $presale->total_pending;
            $amount = $request->get('amount');
            $residue = $pending - $amount;
            if ($residue < 0) {
              $residue;
              $presale->paid = 1;
            }

            HistoryPayment::insert([
              'amount' => $amount,
              'presale_id' => $presale->id,
              'created_at' => now(),
              'updated_at' => now(),
            ]);

            $presale->total_pending = $residue;
            $presale->update();
            return redirect()->back()->with('success', 'Abono agregado correctamente!.');
          }
        }else{
          return redirect()->back()->withErrors(['error' => 'No ha sido posible procesar el abono!.']);
        }
      } catch (\Throwable $th) {
        return redirect()->back()->withErrors(['error' => $th]);
      }
    }

    public function presaleClose(Request $request)
    {
        $from = "{$request->get('from')} 00:00:00";
        $to = "{$request->get('to')} 23:59:59";
        $filter = Presale::orderBy('id', 'desc');
        $client_id = $request->get('client_id');
        $clients = Client::orderBy('id', 'desc')->get();

        if ( ! Auth::user()->can('acountHistory_index')){
            return redirect()->back()->withErrors(['error' => 'No posees los permisos necesarios. Ponte en contacto con tu manager!.']);
        }
        try {
            if ($request->get('from') && $request->get('to')){
                $filter = Presale::whereBetween('created_at', [$from, $to]);
            }

            if (isset($client_id)) {
                $filter->where('client_id', $client_id);
            }

            $presales = new PresaleCollection($filter->where('dispatch_id', '4')->where('total_pending', '=', 0)->paginate(25));
            return Inertia::render('PresaleClose/Show',[
                'presales' => $presales,
                'clients' => $clients,
            ]);
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => $th]);
        }
    }
}
