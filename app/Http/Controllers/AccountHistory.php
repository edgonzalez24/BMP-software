<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Models\Presale;
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

            $presales = new PresaleCollection($filter->where('dispatch_id', '4')->where('total_pending', '>', 0)->paginate(25));
            return Inertia::render('AccountHistory/Show',[ 
                'presales' => $presales,
                'clients' => $clients,
                
            ]);
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => $th]);
        }
    }
}
