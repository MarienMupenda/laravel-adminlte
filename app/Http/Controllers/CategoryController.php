<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Item;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|Response
     */
    public function index()
    {
        $data = [
            'categories' => Category::orderBy('id', 'desc')->paginate(20)
        ];

        return view('dashboard.categories.index', $data)->with('title', 'Categories');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|Response
     */
    public function create()
    {
        return view('dashboard.categories.create')->with('title', 'Ajouter une categorie');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'string|required',
        ]);

        $category = new Category();
        $category->name = $request->input('name');


        $category->save();

        return redirect(url()->previous())->with('success', __('The action ran successfully!'));
    }

    /**
     * Display the specified resource.
     *
     * @param Category $category
     * @return Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Category $category
     * @return Application|Factory|View|Response
     */
    public function edit(Category $category)
    {
        return  view('dashboard.categories.edit', ['category' => $category])->with('title', $category->name);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Category $category
     * @return RedirectResponse
     */
    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'name' => 'string|required',
            'icon' => 'string|nullable'
        ]);

        $category->update($data);

        return back()->with('success', __('The action ran successfully!'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function destroy(Category $category)
    {
        if (count($category->items) > 0) {
            return redirect(url()->previous())->with('error', __('Impossible de supprimer !'));
        } else {
            $category->delete();
            return redirect(url()->previous())->with('success', __('The action ran successfully!'));
        }
    }
}