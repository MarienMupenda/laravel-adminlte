<?php


use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RapportController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index'])->name('home');


Route::middleware(['auth:web'])->group(function () {
    Route::resource('products', ProductController ::class);
    Route::resource('books', BookController ::class);
    Route::resource('items', ProductController ::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('orders', OrderController::class);
    Route::resource('order-items', OrderItemController::class);
    Route::resource('users', UserController::class);
    Route::resource('companies', CompanyController::class);
    Route::resource('contacts', ContactController::class);

    Route::get('rapports', [RapportController::class, 'index'])->name('rapports');
    Route::get('rapports/{from}/{to}', [RapportController::class, 'index'])->name('SearchRapports');
});


Route::post('git-deploy', function () {
    return Artisan::call('git:deploy');
});

