<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Item;
use App\Models\Selling;
use Auth;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;

class SellingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {

        $data = [
            'sellings' => Selling::orderBy('id', 'DESC')->where('company_id', auth()->user()->company_id)->paginate(10),
            'sellings2' => Selling::orderBy('id', 'DESC')->where('company_id', auth()->user()->company_id)->whereDate('created_at', Carbon::today())->paginate(10),
            'items_count' => count(Item::all()),
            'today_sales' => 23,
            'week_sales' => 23,
            'month_sales' => 2,
        ];

        return view('sellings.index', $data)->with('title', __('Sellings'));
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
            'items' => Item::all(),
        ];

        return view('sellings.create', $data)->with('title', 'Nouvelle Commande');

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
            'customer' => 'string|required',
        ]);

        $selling = new Selling();
        $selling->customer = $request->input('customer');
        $selling->user_id = auth()->id();


        $selling->save();

        return redirect(route('sellings.show', $selling))->with('success', __('The action ran successfully!'));

    }

    /**
     * Display the specified resource.
     *
     * @param Selling $selling
     * @return Application|Factory|View
     */
    public function show(Selling $selling)
    {
        $data = [
            'categories' => Category::all(),
            'items' => Item::orderBy('name', 'asc')->where('company_id', Auth::user()->company_id)->get(),
            'selling' => $selling,
        ];


        return view('sellings.show', $data)->with('title', 'COMMANDE #' . $selling->makeInvoice());

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
     * @return Application|Factory|View|Response
     */
    public function update(Request $request, Selling $selling)
    {
        $request->validate([
            'paid' => 'int|required',
        ]);

        $selling->paid = $request->input('paid');

        $selling->update();

        return redirect(url()->previous())->with(['paid' => 1, 'success' => __('The action ran successfully!')]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function destroy(Selling $selling)
    {
        $selling->delete();

        return redirect(url()->previous())->with('success', __('The action ran successfully!'));

    }
}
