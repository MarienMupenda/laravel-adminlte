<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Order;
use App\Models\OrderItem;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:web');
    }


    /**
     * Show the application dashboard.
     *
     * @return Application|Factory|View
     */
    public function index()
    {

        $company = auth()->user()->company;

        // $top_selling_items = Item::with('sellingDetails')
        $top_sold_items = Item::leftJoin('order_items', 'items.id', '=', 'item_id')
            ->selectRaw('items.*, COALESCE(sum(order_items.quantity),0) total')
            ->groupBy('items.id')
            ->orderBy('total', 'desc')
            ->where('company_id', $company->id)
            ->take(5)
            ->get();


        $home = [
            //'items' => Item::where('company_id', $company->id)->count(),
            'items' => Item::where('company_id', $company->id)->count(),
            'orders' => Order::orderBy('id', 'desc')->where('company_id', $company->id)->count(),
            'earning' => $this->getEarnins(),
            'currency' => $company->currency->symbol,
            //'users' => User::where('company_id', $company->id)->count(),
            'users' => 1,
            'returns' => 0,
            'comments' => 0,
            //'sessions' => 2,
            'recent_orders' => Order::orderBy('id', 'desc')->where('company_id', $company->id)->take(10)->get(),
            'top_sold_items' => $top_sold_items,
        ];


        return view('index', $home)->with('title', 'Dashboard');
    }

    private function getEarnins()
    {

        $from = Carbon::now()->startOfMonth();
        $to = Carbon::tomorrow();

        $sellings = OrderItem::with(['item'])
            ->whereHas('item', function ($q) {
                $q->where('company_id', Auth::user()->company_id);
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
