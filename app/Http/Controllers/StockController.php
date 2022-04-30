<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Item;
use App\Models\Price;
use App\Models\Stock;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $data = [
            'stocks' => Stock::orderBy('id','desc')->where('company_id',auth()->user()->company_id)->paginate(20),
        ];

        return view('dashboard.stocks.index', $data)->with('title', 'Stocks');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $data = [
            'items' => Item::all(),
        ];

        return view('dashboard.stocks.create', $data)->with('title', 'Ajouter au stock');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Application|Redirector|RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'item' => 'numeric|required',
            //'article' => 'numeric|required',
            'qty' => 'numeric|required|min:1',
            'pa' => 'numeric|required|min:1',
        ]);

        $stock = new Stock();
        $stock->item_id = $request->input('item');
       // $stock->article_id = $request->input('article');
        $stock->initial_price = $request->input('pa');
        $stock->qty = $request->input('qty');
        $stock->user_id = auth()->id();


        $stock->save();

        return redirect(url()->previous())->with('success', __('The action ran successfully!'));

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
