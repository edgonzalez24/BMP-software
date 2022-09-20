<?php

namespace App\Http\Controllers;

use App\Models\MeasureUnits;
use App\Http\Requests\StoreMeasureUnitsRequest;
use App\Http\Requests\UpdateMeasureUnitsRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Inertia\Inertia;


class MeasureUnitsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ( ! Auth::user()->can('measure_units_index')){
            return redirect()->back()->withErrors(['error' => 'No posees los permisos necesarios. Ponte en contacto con tu manager!.']);
        }

        $measureUnits = MeasureUnits::orderBy('id', 'desc')->paginate(15);
        return Inertia::render('Measure/Show',[ 
            'measureUnits' => $measureUnits,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMeasureUnitsRequest $request)
    {
        if ( ! Auth::user()->can('measure_units_create')){
            return redirect()->back()->withErrors(['warning' => 'No posees los permisos necesarios. Ponte en contacto con tu manager!.']);
        }

        $validated = $request->validated();
        
        try {
            $measureUnits = new MeasureUnits($request->all());
            $measureUnits->save();
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => $th]);
        }

        return redirect()->back()->with('success', 'Registro creado correctamente!.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MeasureUnits  $measureUnits
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMeasureUnitsRequest $validateRequest)
    {
        //
        if ( ! Auth::user()->can('measure_units_edit')){
            return redirect()->back()->withErrors(['warning' => 'No posees los permisos necesarios. Ponte en contacto con tu manager!.']);
        } 

        $validated = $validateRequest->validated($validateRequest->get('name'));
        
        try {
            $measureUnits = MeasureUnits::find($validateRequest->get('measure_id'));
            $measureUnits->update($request->all());
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => $th]);
        }
        return redirect()->back()->with('success', 'Registro actualizado correctamente!.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MeasureUnits  $measureUnits
     * @return \Illuminate\Http\Response
     */
    public function destroy(MeasureUnits $measureUnits)
    {
        if ( ! Auth::user()->can('measure_units_destroy')){
            return redirect()->back()->withErrors(['warning' => 'No posees los permisos necesarios. Ponte en contacto con tu manager!.']);
        }

        try {
            $measureUnits->delete();
            return redirect()->back()->with('success', 'Registro eliminado correctamente!.');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => $th]);
        }
    }
}
