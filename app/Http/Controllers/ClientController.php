<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\TypeClient;
use App\Models\Presale;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Resources\Client as ClientResources;
use App\Http\Resources\ClientCollection;
use App\Models\Zone;
use App\Models\MethodPaid;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $type_client_id = $request->get('type_client_id');
        $search = $request->get('search');
        $zone_id = $request->get('zone_id');

        if ( ! Auth::user()->can('client_index')){
            return redirect()->back()->withErrors(['error' => 'No posees los permisos necesarios. Ponte en contacto con tu manager!.']);
        }
        $filter = Client::orderBy('id', 'desc');
        if(isset($search)){
            $filter->where("name", "like", "%" .$search. "%");
        }
        if (isset($type_client_id)) {
            $filter->where('type_client_id', $type_client_id);
        }
        if (isset($zone_id)) {
            $filter->where('zone_id', $zone_id);
        }


        $clients =  new ClientCollection($filter->where('id', '<>', '1')->paginate(25));
        $typeClient = TypeClient::all();
        $zones = Zone::all();
        $payment_methods = MethodPaid::all();
        return Inertia::render('Clients/Show',[
            'clients' => $clients,
            'typeClient' => $typeClient,
            'zones' => $zones,
            'payment_methods' => $payment_methods
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreClientRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClientRequest $request)
    {
        if ( ! Auth::user()->can('client_create')){
            return redirect()->back()->withErrors(['warning' => 'No posees los permisos necesarios. Ponte en contacto con tu manager!.']);
        }

        try {
            $client = new Client($request->all());
            $client->save();
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => 'Ops! Ha ocurrido un error']);
        }

        return redirect()->back()->with('success', 'Registro creado correctamente!.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateClientRequest  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClientRequest $request)
    {
        if ( ! Auth::user()->can('client_edit')){
            return redirect()->back()->withErrors(['warning' => 'No posees los permisos necesarios. Ponte en contacto con tu manager!.']);
        }
        try {
            $client = Client::find($request->get('client_id'));
            $client->update($request->all());

        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => 'Ops! Ha ocurrido un error']);
        }
        return redirect()->back()->with('success', 'Registro actualizado correctamente!.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        if ( ! Auth::user()->can('client_destroy')){
            return redirect()->back()->withErrors(['warning' => 'No posees los permisos necesarios. Ponte en contacto con tu manager!.']);
        }

        try {
            $client->delete();
            return redirect()->back()->with('success', 'Registro eliminado correctamente!.');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => 'Ops! Ha ocurrido un error']);
        }
    }
}
