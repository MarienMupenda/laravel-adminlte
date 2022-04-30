<?php

namespace App\Http\Controllers;

use App\Http\Resources\ItemResource;
use App\Models\Company;
use App\Models\Item;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

use function App\Helpers\Helpers;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //  $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index(Request $request)
    {

        $items = Item::query();
        $items->with(['promotions', 'category', 'company'])->orderByDesc('created_at')
            ->where('state', Item::STATE_PUBLISHED);
        $items = $items->where('state', Item::STATE_PUBLISHED)->whereHas('company', function (Builder $q) {
            $q->where('state', Company::STATE_ACTIVE);
        });
        $items = ItemResource::collection($items->limit(4)->get());


        $page  = [
            'title' => 'Uzaraka - Le grand marché de Lubumbashi',
            'description' => 'bienvenu sur uzaraka',
            'url' => '/',
            'topItems' => $items,
            'topCompany' => $items,
            'recentItems' => $items,
        ];




        return view('index')->with('page', (object)$page);
    }

    public function products()
    {

        $page  = [
            'title' => 'Home',
            'description' => 'bienvenu sur uzaraka',
            'url' => '/'
        ];

        return view('index')->with('page', (object)$page);
    }
}
