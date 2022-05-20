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





        $data = [
            //'items' => Item::where('company_id', $company->id)->count(),
            'items' => null,
            'orders' => null,
            'earning' => null,
            'currency' =>null,
            //'users' => User::where('company_id', $company->id)->count(),
            'users' => 1,
            'returns' => 0,
            'comments' => 0,
            //'sessions' => 2,
            'recent_orders' => [],
            'top_sold_items' =>[],
        ];


        return view('index', $data)->with('title', 'Dashboard');
    }
}
