<?php

namespace App\Http\Controllers;

use App\Models\PresaleDetail;
use App\Http\Requests\StorePresaleDetailRequest;
use App\Http\Requests\UpdatePresaleDetailRequest;

class PresaleDetailController extends Controller
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
     * @param  \App\Http\Requests\StorePresaleDetailRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePresaleDetailRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PresaleDetail  $presaleDetail
     * @return \Illuminate\Http\Response
     */
    public function show(PresaleDetail $presaleDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePresaleDetailRequest  $request
     * @param  \App\Models\PresaleDetail  $presaleDetail
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePresaleDetailRequest $request, PresaleDetail $presaleDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PresaleDetail  $presaleDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(PresaleDetail $presaleDetail)
    {
        //
    }
}
