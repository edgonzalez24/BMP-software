<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\TypeClient;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if ( ! Auth::user()->can('client_index')){
            return redirect()->back()->withErrors(['error' => 'No posees los permisos necesarios. Ponte en contacto con tu manager!.']);
        }

        $clients = Client::orderBy('id', 'desc')->paginate(15);
        $typeClient = TypeClient::all();
        return Inertia::render('Client/Show',[ 
            'client' => $client,
            'typeClient' => $typeClient,
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

        $validated = $request->validated();
        
        try {
            $client = new Client($request->all());
            $client->save();
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => $th]);
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

        $validated = $request->validated($request->all());
        try {
            $client = Client::find($request->get('client_id'));
            $client->update($request->all());
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => $th]);
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
            return redirect()->back()->withErrors(['error' => $th]);
        }
    }
}
