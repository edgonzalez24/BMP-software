<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\CategoryArticle;
use App\Models\MeasureUnits;
use Illuminate\Http\Request;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Http\Resources\ArticleCollection;
use App\Http\Resources\Article as ArticleResources;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ( ! Auth::user()->can('article_index')){
            return redirect()->back()->withErrors(['error' => 'No posees los permisos necesarios. Ponte en contacto con tu manager!.']);
        }

        $article = new ArticleCollection(Article::orderBy('id', 'desc')->paginate(15));
        $category = CategoryArticle::orderBy('id', 'desc')->get();
        $measureUnits = MeasureUnits::orderBy('id', 'desc')->get();
        return Inertia::render('Article/Show',[ 
            'articles' => $article,
            'categories' => $category,
            'measures_units' => $measureUnits
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreArticleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreArticleRequest $request)
    {
        if ( ! Auth::user()->can('article_create')){
            return redirect()->back()->withErrors(['warning' => 'No posees los permisos necesarios. Ponte en contacto con tu manager!.']);
        }

        $validated = $request->validated();
        
        try {
            $article = new Article($request->all());
            $article->save();
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => $th]);
        }

        return redirect()->back()->with('success', 'Registro creado correctamente!.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateArticleRequest  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateArticleRequest $request)
    {
        if ( ! Auth::user()->can('article_edit')){
            return redirect()->back()->withErrors(['warning' => 'No posees los permisos necesarios. Ponte en contacto con tu manager!.']);
        } 

        $validated = $request->validated($request->all());
        try {
            $article = Article::find($request->get('article_id'));
            $article->update($request->all());
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => $th]);
        }
        return redirect()->back()->with('success', 'Registro actualizado correctamente!.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        if ( ! Auth::user()->can('article_destroy')){
            return redirect()->back()->withErrors(['warning' => 'No posees los permisos necesarios. Ponte en contacto con tu manager!.']);
        }
        
        try {
            /* PARA IMPLEMENTAR CUANDO SE MANEJEN LOS STOCKS */
            // Un artículo no puede ser eliminado si tiene existencias en estocks
            /* if (count($article->stocks) > 0) {                
                return redirect()->back()->withErrors(['warning' => 'No se puede eliminar un artículo que tenga unidades en existencias en estock!.']);
            } */

            $article->delete();
            return redirect()->back()->with('success', 'Registro eliminado correctamente!.');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => $th]);
        }
    }
}
