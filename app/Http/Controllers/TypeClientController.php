<?php

namespace App\Http\Controllers;

use App\Models\TypeClient;
use App\Http\Requests\StoreTypeClientRequest;
use App\Http\Requests\UpdateTypeClientRequest;

class TypeClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTypeClientRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTypeClientRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TypeClient  $typeClient
     * @return \Illuminate\Http\Response
     */
    public function show(TypeClient $typeClient)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTypeClientRequest  $request
     * @param  \App\Models\TypeClient  $typeClient
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTypeClientRequest $request, TypeClient $typeClient)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TypeClient  $typeClient
     * @return \Illuminate\Http\Response
     */
    public function destroy(TypeClient $typeClient)
    {
        //
    }
}
