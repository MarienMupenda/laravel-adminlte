<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Currency;
use App\Models\Item;
use App\Models\Product;
use App\Models\Unit;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{

    //constructor wich create category
    private $category;

    public function __construct()
    {
        $this->category = Category::find(1);
    }


    public function index()
    {

        $heads = [
            '#',
            'Nom',
            'Categorie',
            'Prix',
            'Stock',
            'Statut',
            ['Actions', 'no-export' => true, 'width' => 5],
        ];


        $btnDelete = '<button class="mx-1 shadow btn btn-xs btn-default text-danger" title="Delete">
        <i class="fa fa-lg fa-fw fa-trash"></i>
    </button>';
        $btnDetails = '<button class="mx-1 shadow btn btn-xs btn-default text-teal" title="Details">
        <i class="fa fa-lg fa-fw fa-eye"></i>
    </button>';

        $products = Product::orderBy('id', 'desc')->whereHas('item', function ($q) {
            $q->where('company_id', Auth::user()->company->id);
        })->get();

        // $products = ProductResource::collection($products);

        foreach ($products as $product) {
            $img = $product->item->image_small();

            $btnEdit = '<a href="' . route('products.edit', $product) . '" class="mx-1 shadow btn btn-xs btn-default text-primary" title="Edit">
        <i class="fa fa-lg fa-fw fa-pen"></i>
    </a>';

            $data[] = [
                "<img class='uz-img'  src='$img' alt='$product->name'>",
                $product->name,
                $product->item->category,
                $product->item->price . ' ' . $product->item->currency->code,
                ($product->quantity ?? 0) . ' ' . $product->item->unit->name,
                trans(ucfirst($product->item->status)),

                '<nobr>' . $btnEdit . '</nobr>',


            ];

        }

        $config = [
            'data' => $data ?? null,
            'order' => [[1, 'asc']],
            'columns' => [['orderable' => false], null, null, null, null, null, ['orderable' => false]],
        ];

        return view('products.index', compact('config', 'heads'))->with('title', 'Produits');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $data = [
            'categories' => $this->category->children()->get(),
            'units' => Unit::all(),
            'currencies' => Currency::all(),
        ];
        return view('products.create', $data)->with('title', 'Ajouter un produit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(StoreProductRequest $request)
    {

        $item = new Item();
        $item->category_id = $request->category_id;
        $item->unit_id = $request->unit_id;
        $item->price = $request->price;
        $item->currency_id = $request->currency_id;
        $item->company_id = Auth::user()->company->id;
        $item->save();

        $item->slug = Helpers::slugify($request->name, $this->category->name, $item->id);
        if ($request->hasFile('image')) {
            $item->image = Helpers::uploadItemImage($request, Auth::user()->company->id);
        }
        $item->save();


        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->item_id = $item->id;
        $product->save();

        return redirect()->route('products.index')->with('success', 'Produit ajouté avec succès');
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
     * @param Item $product
     * @return Application|Factory|View
     */
    public function edit(Product $product)
    {
        $data = [
            'product' => ProductResource::make($product),
            'categories' => $this->category->children()->get(),
            'units' => Unit::all(),
        ];
        return \view('products.edit', $data)->with('title', $product->name);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Item $item
     * @return Application|Redirector|RedirectResponse
     */
    public function update(UpdateProductRequest $request, Item $item)
    {

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
