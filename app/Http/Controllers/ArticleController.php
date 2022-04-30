<?php

namespace App\Http\Controllers\Dashboard;


use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {

        $request->validate([
            'color' => 'numeric|nullable',
            'size' => 'numeric|nullable',
        ]);

        $article = new Article();
        $article->item_id = $request->input('item');
        $article->color_id = $request->input('color');
        $article->size_id = $request->input('size');
        // $stock->user_id = auth()->id();


        $article->save();

        return redirect(url()->previous())->with('success', __('The action ran successfully!'));

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Article $article
     * @return Article
     */
    public function show(Article $article)
    {
        $article->qty = $article->qty();
        return $article;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Article $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Article $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Article $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        //
    }
}
