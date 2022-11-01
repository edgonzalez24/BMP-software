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
    public function index(Request $request)
    {
        $from = "{$request->get('from')} 00:00:00";
        $to = "{$request->get('to')} 23:59:59";
        $clients = Client::orderBy('id', 'desc')->get();
        $filter = Presale::all();
        $client_id = $request->get('client_id');

        if ( ! Auth::user()->can('presale_index')){
            return redirect()->back()->withErrors(['error' => 'No posees los permisos necesarios. Ponte en contacto con tu manager!.']);
        }
        try {
            
            if (isset($from) && isset($to)){
                $filter = Presale::whereBetween('created_at', [$from, $to]);
            } 
            
            if (isset($client_id)) {
                $filter->where('client_id', $client_id);
            }
            $presales = new PresaleCollection($filter->orderBy('id', 'desc')->paginate(25));
            return Inertia::render('Presale/Show',[ 
                'presales' => $presales,
                'clients' => $clients,
            ]);
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => $th]);
        }
        
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
                    'total_articles' => $request->presale_detail[$i]['total_articles'],
                    'dischargued' => $request->presale_detail[$i]['dischargued'],
                    'total' => $request->presale_detail[$i]['total'],
                    'article_id' => $request->presale_detail[$i]['id'],
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
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePresaleRequest  $request
     * @param  \App\Models\Presale  $presale
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePresaleRequest $request)
    {
        if ( ! Auth::user()->can('presale_edit')){
            return redirect()->back()->withErrors(['warning' => 'No posees los permisos necesarios. Ponte en contacto con tu manager!.']);
        }
        
        try {
            $presale = Presale::find($request->presale_id);
            $presale->update($request->all());

            // Edita agregando nuevos productos
            for ($i=0; $i < count($request->new_presale_detail); $i++) { 
                $presaleDetail = PresaleDetail::insert([
                    'total_articles' => $request->new_presale_detail[$i]['total_articles'],
                    'dischargued' => $request->new_presale_detail[$i]['dischargued'],
                    'total' => $request->new_presale_detail[$i]['total'],
                    'article_id' => $request->new_presale_detail[$i]['id'],
                    'presale_id' => $presale->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            // Edita productos ya agregados
            for ($i=0; $i < count($request->old_presale_detail); $i++) { 
                PresaleDetail::find($request->old_presale_detail[$i]['id_detail'])->update([
                    'total_articles' => $request->old_presale_detail[$i]['total_articles'],
                    'dischargued' => $request->old_presale_detail[$i]['dischargued'],
                    'total' => $request->old_presale_detail[$i]['total'],
                    'article_id' => $request->old_presale_detail[$i]['id'],
                    'presale_id' => $request->old_presale_detail[$i]['id_presale'],
                ]);
            }
        } catch (\Throwable $th) {
            die($th);
            return redirect()->back()->withErrors(['error' => $th]);
        }

        return redirect()->back()->with('success', 'Registro actualizado correctamente!.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Presale  $presale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Presale $presale)
    {        
        if ( ! Auth::user()->can('presale_destroy')){
            return redirect()->back()->withErrors(['warning' => 'No posees los permisos necesarios. Ponte en contacto con tu manager!.']);
        }
        try {
            PresaleDetail::where('presale_id', $presale->id)->delete();
            Presale::find($presale->id)->update(['dispatch_id' => 5]);
            return redirect()->back()->with('success', 'Registro eliminado correctamente!.');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => $th]);
        }
    }

    public function getDetail(Request $request) {
        $clients = new ClientCollection(Client::orderBy('id', 'desc')->get());
        $methods_paids = MethodPaid::orderBy('id', 'desc')->get();
        $dispatches = Dispatch::orderBy('id', 'desc')->get();
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
            'dispatches' => $dispatches,
        ]);
    }

    public function show( Request $request) {
        if($request->id) {
            $presale = new PresaleCollection(array(Presale::find($request->id)));
            $methods_paids = MethodPaid::orderBy('id', 'desc')->get();
            $dispatches = Dispatch::orderBy('id', 'desc')->get();
            $clients = new ClientCollection(Client::orderBy('id', 'desc')->get());
            $article = null;
            if( $request->input('search')) {
                $search = $request->get('search');
                if(isset($search)) {
                    $filter = Article::where('active', '1');
                    $filter->where("name", "like", "%" .$search. "%");
                }
                $article = new StockDetailArticleCollection($filter->orderBy('id', 'desc')->get());
            }

            return Inertia::render('Presale/Edit', [
                'presale' => $presale,
                'payment_methods' => $methods_paids,
                'dispatches' => $dispatches,
                'clients' => $clients,
                'articles' => $article,
            ]);
        }   else {
                return redirect()->back();
        }
    }

    public function destroy_uniq(Request $request)
    {   
        try {
            PresaleDetail::where('article_id', $request->id)->delete();
            return redirect()->back();
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => $th]);
        }
    }
}
