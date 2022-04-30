<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\SellingDetail;
use Illuminate\Http\Request;

class SellingDetailController extends Controller
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
            'selling' => 'numeric|required',
            'item' => 'numeric|required',
           // 'article' => 'numeric|required',
            'qty' => 'numeric|required|min:1|max:' . $request->input('stock'),
            'price' => 'numeric|required',
            //'iprice' => 'numeric|required',
        ]);

        $sellingDetail = new SellingDetail();
        $sellingDetail->selling_id = $request->input('selling');
        $sellingDetail->item_id = $request->input('item');
       // $sellingDetail->article_id = $request->input('article');
        $sellingDetail->selling_price = $request->input('price');
        $sellingDetail->initial_price = $request->input('price');
        $sellingDetail->qty = $request->input('qty');


        $sellingDetail->save();

        return redirect(route('sellings.show', $sellingDetail->selling_id))->with('success', __('The action ran successfully!'));

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param SellingDetail $sellingDetail
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(SellingDetail $sellingDetail)
    {

        $sellingDetail->delete();
        return redirect(route('sellings.show', $sellingDetail->selling_id))->with('success', __('The action ran successfully!'));


    }
}
