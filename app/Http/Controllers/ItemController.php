<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Http\Resources\ItemResource;
use App\Models\Category;
use App\Models\Color;
use App\Models\Item;
use App\Models\Size;
use App\Models\Unit;
use Auth;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Image;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {

        $heads = [
            '#',
            'Nom',
            'Categorie',
            ['label' => 'Prix',],
            ['label' => 'Stock',],
            ['label' => 'Vendus',],
            ['label' => 'Statut',],
            ['label' => 'Actions', 'no-export' => true, 'width' => 5],
        ];



        $btnDelete = '<button class="mx-1 shadow btn btn-xs btn-default text-danger" title="Delete">
        <i class="fa fa-lg fa-fw fa-trash"></i>
    </button>';
        $btnDetails = '<button class="mx-1 shadow btn btn-xs btn-default text-teal" title="Details">
        <i class="fa fa-lg fa-fw fa-eye"></i>
    </button>';

        $items = Item::orderBy('id', 'desc')->where('company_id', '=', Auth::user()->company_id)->get();

        foreach ($items as $item) {
            $img = $item->image_small();

            $btnEdit = '<a href="' . route('dashboard.items.edit', $item) . '" class="mx-1 shadow btn btn-xs btn-default text-primary" title="Edit">
        <i class="fa fa-lg fa-fw fa-pen"></i>
    </a>';

            $data[] = [
                "<img class='uz-img'  src='$img' alt='$item->name'>",
                $item->name,
                $item->category->name,
                $item->price(),
                $item->qty() . ' ' . $item->unit->name,
                $item->soldQty() . ' ' . $item->unit->name,
                trans(ucfirst($item->state())),

                '<nobr>' . $btnEdit . '</nobr>',


            ];
        }

        $config = [
            'data' => $data ?? null,
            'order' => [[1, 'asc']],
            'columns' => [['orderable' => false], null, null, null, null, null, null, ['orderable' => false]],
        ];

        return view('dashboard.items.index', compact('config', 'heads'))->with('title', 'Produits');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $data = [
            'categories' => Category::all(),
            'units' => Unit::all(),
        ];
        return view('dashboard.items.create', $data)->with('title', 'Ajouter un produit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'string|required|unique:items,name,NULL,id,company_id,' . Auth::user()->company_id,
            'image' => 'image|nullable|max:1999',
            'category' => 'numeric|required',
            'description' => 'string|nullable',
            'barcode' => 'numeric|nullable|unique:items,barcode,NULL,id,company_id,' . Auth::user()->company_id,
            //'pa' => 'numeric|nullable|min:1',
            'pv' => 'numeric|required|min:1',

        ]);


        $item = new Item();
        $item->name = $request->input('name');
        $item->category_id = $request->input('category');
        $item->unit_id = $request->input('unit');
        $item->selling_price = $request->input('pv');
        $item->description = $request->input('description');
        $item->barcode = $request->input('barcode');
        //  $item->initial_price = $request->input('pa');
        $item->company_id = Auth::user()->company_id;


        if ($request->hasFile('image')) {
            $item->image = Helpers::uploadItemImage($request, auth()->user()->company_id);
        }

        $item->save();


        return redirect(url()->previous())->with('success', __('The action ran successfully!'));
    }

    /**
     * Display the specified resource.
     *
     * @param Item $item
     * @return Application|Factory|View
     */
    public function show(Item $item)
    {

        return view('dashboard.items.show', ['item' => $item]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Item $item
     * @return Application|Factory|View
     */
    public function edit(Item $item)
    {
        $data = [
            'item' => $item,
            'articles' => $item->articles,
            'categories' => Category::orderBy('name', 'asc')->get(),
            'units' => Unit::all(),
            'colors' => Color::orderBy('name', 'asc')->get(),
            'sizes' => Size::orderBy('name', 'asc')->get(),
        ];
        return \view('dashboard.items.edit', $data)->with('title', $item->name);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Item $item
     * @return Application|Redirector|RedirectResponse
     */
    public function update(Request $request, Item $item)
    {
        $request->validate([
            'image' => 'image|nullable|max:1999',
            'pa' => 'numeric|nullable|min:1',
            'description' => 'string|nullable',
            'pv' => 'numeric|nullable|min:1',
            'image_url' => 'string|nullable|min:1',
        ]);


        if ($item->name != $request->name) {
            $request->validate([
                'name' => 'string|required|unique:items,name,NULL,id,company_id,' . Auth::user()->company_id,
            ]);
        }

        if ($item->barcode != $request->barcode) {
            $request->validate([
                'barcode' => 'numeric|nullable|unique:items,barcode,NULL,id,company_id,' . Auth::user()->company_id,
            ]);
        }

        if ($request->hasFile('image')) {
            $item->delete_image();
            $item->image = Helpers::uploadItemImage($request, auth()->user()->company_id);
        }

        if ($request->has('image_url') and !empty($request->image_url)) {
            $item->delete_image();
            $item->image = Helpers::uploadItemImageUrl($request, Auth::user()->company_id);
        }


        $item->name = $request->input('name');
        $item->category_id = $request->input('category');
        $item->unit_id = $request->input('unit');
        $item->selling_price = $request->input('pv');
        $item->barcode = $request->input('barcode');
        $item->description = $request->input('description');
        $item->company_id = Auth::user()->company_id;

        // if ($item->description) {
        //    $item->state = Item::STATE_PUBLISHED;
        //l}

        $item->update();

        // return ItemResource::make($item);


        return redirect(url()->previous())->with('success', __('The action ran successfully!'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Item $item
     * @return Application|Redirector|RedirectResponse
     */
    public function destroy(Item $item)
    {
        $item->delete();
        return redirect(route('dashboard.items.index'))->with('success', __('The action ran successfully!'));
    }
}
