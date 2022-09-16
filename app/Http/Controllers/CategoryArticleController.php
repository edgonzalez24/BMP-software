<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\CategoryArticle;
use App\Http\Requests\StoreCategoryArticleRequest;
use App\Http\Requests\UpdateCategoryArticleRequest;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class CategoryArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if ( ! Auth::user()->can('category_article_index')){
            return redirect()->back()->withErrors(['error' => 'No posees los permisos necesarios. Ponte en contacto con tu manager!.']);
        }
        $categoryArticle = CategoryArticle::orderBy('id', 'desc')->paginate(15);
        return Inertia::render('Category/Show',[ 
            'categoryArticle' => $categoryArticle,
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        if ( ! Auth::user()->can('category_article_create')){
            return redirect()->back()->withErrors(['warning' => 'No posees los permisos necesarios. Ponte en contacto con tu manager!.']);
        }
        return Inertia::render('Category/CategoryCreate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCategoryArticleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryArticleRequest $request)
    {
        if ( ! Auth::user()->can('category_article_create')){
            return redirect()->back()->withErrors(['warning' => 'No posees los permisos necesarios. Ponte en contacto con tu manager!.']);
        }

        $validated = $request->validated();
        
        try {
            $categoryArticle = new CategoryArticle($request->all());
            $categoryArticle->save();
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => $th]);
        }

        return redirect()->back()->with('success', 'Registro creado correctamente!.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoryArticleRequest  $request
     * @param  \App\Models\CategoryArticle  $categoryArticle
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryArticleRequest $validateRequest, Request $request)
    {
        //
        if ( ! Auth::user()->can('category_article_edit')){
            return redirect()->back()->withErrors(['warning' => 'No posees los permisos necesarios. Ponte en contacto con tu manager!.']);
        } 

        $validated = $validateRequest->validated($request->name);
        
        try {
            $categoryArticle = CategoryArticle::find($validated->category_id);
            $categoryArticle->update($request->all());
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => $th]);
        }
        return redirect()->back()->with('success', 'Registro actualizado correctamente!.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CategoryArticle  $categoryArticle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if ( ! Auth::user()->can('category_article_destroy')){
            return redirect()->back()->withErrors(['warning' => 'No posees los permisos necesarios. Ponte en contacto con tu manager!.']);
        }

        try {
            $categoryArticle = CategoryArticle::find($request->category_id);
            $categoryArticle->delete();
            return redirect()->back()->with('success', 'Registro eliminado correctamente!.');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => $th]);
        }
    }
}
