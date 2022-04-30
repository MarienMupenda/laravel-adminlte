<?php

use App\Http\Controllers\Api\v1\ArticleController;
use App\Http\Controllers\Api\v1\BusinessController;
use App\Http\Controllers\Api\v1\CategoryController;
use App\Http\Controllers\Api\v1\CompanyController;
use App\Http\Controllers\Api\v1\ItemController;
use App\Http\Controllers\Api\v1\AuthController;
use App\Http\Controllers\Api\v1\Pos\SellingController as SellingControllerPos;
use App\Http\Controllers\Api\v1\SellingController;
use App\Http\Controllers\Api\v1\UnitController;
use App\Http\Controllers\Api\v1\UserController;
use App\Http\Resources\v1\ItemResource;
use App\Models\Article;
use App\Models\Item;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();

});*/


//Auth
Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

Route::middleware('auth:api')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
});


Route::get('/search/{search}', function ($search) {

    $item = Item::query()
        ->with(['promotions', 'category', 'company'])
        ->orderByDesc('created_at')
        ->where('name', 'LIKE', "%{$search}%")
        ->orWhere('description', 'LIKE', "%{$search}%")
        ->orWhere('selling_price', 'LIKE', "%{$search}%")
        ->paginate(10);

    return ItemResource::collection($item);
})->where('search', '.*');

//API Access Token
//Route::middleware('auth:api')->group(function () {
/* Client App*/
Route::apiresource('items', ItemController::class, ['as' => 'api']);

Route::apiresource('users', UserController::class, ['as' => 'api']);


Route::apiresource('units', UnitController::class, ['as' => 'api']);

Route::post('items/update/{id}', [ItemController::class, 'update']);

Route::get('items/category/{id1}/company/{id2}', [ItemController::class, 'filter']);

Route::apiresource('categories', CategoryController::class, ['as' => 'api']);
Route::apiresource('companies', CompanyController::class, ['as' => 'api']);
Route::apiresource('businesses', BusinessController::class, ['as' => 'api']);
Route::apiresource('sellings', SellingController::class, ['as' => 'api']);

Route::apiresource('articles', ArticleController::class, ['as' => 'api']);

Route::prefix('pos')->group(function () {
    Route::apiresource('sellings', SellingControllerPos::class, ['as' => 'pos']);
});


Route::get('articles/item/{id1}', function ($id) {
    return Article::with(['color', 'size', 'item'])->orderBy('color_id')->where('item_id', $id)->get();
});

//Login
Route::get('ping', function () {
    return Carbon::today();
});

/* Admin Web */
Route::get("item/null", function () {
    return new Item();
});

Route::get("items/{id}", function ($id) {
    //return Item::where('category_id',$id)->order_by('nam','ASC')->get();
    return Item::where('category_id', $id)->get();
});


Route::get("item/{id}", function ($id) {
    $item = Item::find($id);
    if ($item != null) {
        $item->stock_qty = $item->qty();
        $item->u = $item->unit->name;
    }
    return $item;
});

Route::get("item/{barcode}/{company_id}", function ($barcode, $company_id) {
    $item = Item::where('company_id', $company_id)->where("barcode", $barcode)->first();
    if ($item != null) {
        $item->stock_qty = $item->qty();
        $item->u = $item->unit->name;
    }
    return $item;
});


//});