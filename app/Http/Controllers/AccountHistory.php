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
    public function index()
    {        
        if ( ! Auth::user()->can('acountHistory_index')){
            return redirect()->back()->withErrors(['error' => 'No posees los permisos necesarios. Ponte en contacto con tu manager!.']);
        }

        $clients = Client::orderBy('id', 'desc');
        $presales = new PresaleCollection(Presale::where('dispatch_id', '4')->where('total_pending', '>', 0)->paginate(25));
        return Inertia::render('AccountHistory/Show',[ 
            'presales' => $presales,
            'clients' => $clients,
        ]);
    }
}
