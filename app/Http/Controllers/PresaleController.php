<?php

namespace App\Http\Controllers;

use App\Models\Presale;
use App\Models\PresaleDetail;
use App\Models\User;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Http\Resources\Presale as PresaleResources;
use App\Http\Resources\PresaleCollection;

class PresaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if ( ! Auth::user()->can('presale_index')){
            return redirect()->back()->withErrors(['error' => 'No posees los permisos necesarios. Ponte en contacto con tu manager!.']);
        }
        $presales = new PresaleCollection(Presale::orderBy('id', 'desc')->paginate(25));
        return Inertia::render('Presale/Show',[ 
            'presales' => $presales,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Presale  $presale
     * @return \Illuminate\Http\Response
     */
    public function show(Presale $presale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Presale  $presale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Presale $presale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Presale  $presale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Presale $presale)
    {
        //
    }
}
