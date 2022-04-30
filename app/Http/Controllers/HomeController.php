<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Selling;
use App\Models\SellingDetail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:web');
    }


    /**
     * Show the application dashboard.
     *
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {

        $company = auth()->user()->company;
        // $top_selling_items = Item::with('sellingDetails')
        $top_selling_items = Item::leftJoin('selling_details', 'items.id', '=', 'selling_details.item_id')
            ->selectRaw('items.*, COALESCE(sum(selling_details.qty),0) total')
            ->groupBy('items.id')
            ->orderBy('total', 'desc')
            ->where('company_id', $company->id)
            ->take(5)
            ->get();


        $home = [
            //'items' => Item::where('company_id', $company->id)->count(),
            'items' => Item::where('company_id', $company->id)->count(),
            'orders' => Selling::orderBy('id', 'desc')->where('company_id', $company->id)->count(),
            'earning' => $this->getEarnins(),
            'currency' => $company->currency->symbol,
            'users' => User::where('company_id', $company->id)->count(),
            'returns' => 0,
            'comments' => 0,
            //'sessions' => 2,
            'recent_orders' => Selling::orderBy('id', 'desc')->where('company_id', $company->id)->take(10)->get(),
            'top_selling_items' => $top_selling_items,
        ];


        return view('dashboard.index', $home)->with('title', 'Dashboard');
    }

    private function getEarnins()
    {

        $from = Carbon::now()->startOfMonth();
        $to = Carbon::tomorrow();

        $sellings = SellingDetail::with(['item'])
            ->whereHas('item', function ($q) {
                $q->where('company_id', \Auth::user()->company_id);
            })

            ->whereBetween('created_at', [$from, $to])
            ->get();


        $total = 0;

        foreach ($sellings as $selling) {
            $total += $selling->selling_price;
        }

        return $total;
    }
}
