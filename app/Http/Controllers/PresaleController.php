<?php

namespace App\Http\Controllers;

use App\Models\Presale;
use App\Http\Requests\StorePresaleRequest;
use App\Http\Requests\UpdatePresaleRequest;
use App\Http\Requests\StorePresaleDetailRequest;
use App\Http\Requests\UpdatePresaleDetailRequest;
use App\Http\Resources\Client as ResourcesClient;
use App\Http\Resources\ClientCollection;
use App\Models\PresaleDetail;
use App\Models\User;
use App\Models\Client;
use App\Models\Dispatch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Http\Resources\Presale as PresaleResources;
use App\Http\Resources\PresaleCollection;
use App\Models\MethodPaid;
use App\Models\Article;
use App\Http\Resources\Article as ArticleResources;
use App\Http\Resources\StockDetailArticleCollection;

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
            'presales' => $presales
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePresaleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePresaleRequest $request)
    {
        if ( ! Auth::user()->can('presale_create')){
            return redirect()->back()->withErrors(['warning' => 'No posees los permisos necesarios. Ponte en contacto con tu manager!.']);
        }
        
        try {
            $presale = new Presale($request->all());
            $presale->save();

            // presaledetail
            for ($i=0; $i < count($request->presale_detail); $i++) { 
                $presaleDetail = PresaleDetail::insert([
                    'total_articles' => $request->presale_detail[$i]->total_articles,
                    'dischargued' => $request->presale_detail[$i]->dischargued,
                    'total' => $request->presale_detail[$i]->total,
                    'article_id' => $request->presale_detail[$i]->article_id,
                    'presale_id' => $presale->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => $th]);
        }

        return redirect()->back()->with('success', 'Registro creado correctamente!.');
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
     * @param  \App\Http\Requests\UpdatePresaleRequest  $request
     * @param  \App\Models\Presale  $presale
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePresaleRequest $request, Presale $presale)
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

    public function getDetail(Request $request) {
        $clients = new ClientCollection(Client::orderBy('id', 'desc')->get());
        $methods_paids = MethodPaid::orderBy('id', 'desc')->get();
        try {
            $article = null;
            if( $request->input('search')) {
                $search = $request->get('search');
                if(isset($search)) {
                    $filter = Article::where('active', '1');
                    $filter->where("name", "like", "%" .$search. "%");
                }
                $article = new StockDetailArticleCollection($filter->orderBy('id', 'desc')->get());
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
        return Inertia::render('Presale/Create', [
            'clients' => $clients,
            'payment_methods' => $methods_paids,
            'articles' => $article,
        ]);
    }
}
