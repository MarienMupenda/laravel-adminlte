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
            'items' => null,
            'orders' => null,
            'earning' => null,
            'currency' => null,
            'users' => null,
            'returns' => 0,
            'comments' => 0,
            'recent_orders' => null,
            'top_sold_items' => null,
        ];


        return view('index', $data)->with('title', 'Dashboard');
    }
}
