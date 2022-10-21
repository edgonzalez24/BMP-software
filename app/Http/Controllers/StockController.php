<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\Supplier;
use App\Models\MeasureUnits;
use App\Models\Article;
use App\Http\Requests\StoreStockRequest;
use App\Http\Requests\UpdateStockRequest;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Http\Resources\StockCollection;
use App\Http\Resources\Stock as StockResources;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Resources\ArticleCollection;
use App\Http\Resources\Article as ArticleResources;
use Illuminate\Support\Collection;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ( ! Auth::user()->can('stock_index')){
            return redirect()->back()->withErrors(['error' => 'No posees los permisos necesarios. Ponte en contacto con tu manager!.']);
        }

        $stocks = new StockCollection(Stock::orderBy('id', 'desc')->paginate(25));
        return Inertia::render('Stock/Show',[ 
            'stocks' => $stocks,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreStockRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStockRequest $request)
    {
        if ( ! Auth::user()->can('stock_create')){
            return redirect()->back()->withErrors(['warning' => 'No posees los permisos necesarios. Ponte en contacto con tu manager!.']);
        }
        try {
            $stock = new Stock($request->all());
            $stock->save();
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => $th]);
        }

        return redirect()->back()->with('success', 'Registro creado correctamente!.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        if ( ! Auth::user()->can('stock_show')){
            return redirect()->back();
        }

        if($request->id) {
            $article = new ArticleCollection(array(Article::find($request->id)));
            $supplier = Supplier::orderBy('id', 'ASC')->get();
            $measure_units = MeasureUnits::where('name', '<>', 'Sin Asignar')->orderBy('id', 'desc')->get();
            return Inertia::render('Stock/Detail',[ 
                'article' => $article,
                'suppliers' => $supplier,
                'measure_units' => $measure_units
            ]);
        } else {
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStockRequest  $request
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStockRequest $request, Stock $stock)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stock $stock)
    {
        //
    }

    public function filter(Request $request)
    {
        $from = "{$request->get('from')} 00:00:00";
        $to = "{$request->get('to')} 23:59:59";
        try {
            if($request->get('from') && $request->get('to')){
                $filter = Stock::whereBetween('created_at', [$from, $to]);
                $stocks = new StockCollection($filter->orderBy('id', 'desc')->paginate(25));
            } else {
                $stocks = new StockCollection(Stock::orderBy('id', 'desc')->paginate(25));
            }
            return Inertia::render('Stock/Show',[ 
                'stocks' => $stocks,
            ]);
        } catch (\Throwable $th) {
            redirect()->back()->withErrors(['error' => $th]);
        }

    }
}
