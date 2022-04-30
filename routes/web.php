<?php

use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\CompanyController as AdminCompanyController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ItemController as AdminItemController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\Dashboard\ArticleController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\CompanyController;
use App\Http\Controllers\Dashboard\ContactController;
use App\Http\Controllers\Dashboard\ItemController;
use App\Http\Controllers\Dashboard\RapportController;
use App\Http\Controllers\Dashboard\SellingController;
use App\Http\Controllers\Dashboard\SellingDetailController;
use App\Http\Controllers\Dashboard\StockController;
use App\Http\Controllers\Dashboard\UserController;
use App\Models\Company;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Dashboard\HomeController as DashboardController;
use App\Http\Controllers\Storefront\CompanyController as StorefrontCompanyController;
use App\Http\Controllers\Storefront\HomeController as StorefrontController;
use App\Http\Controllers\Storefront\ItemController as StorefrontItemController;

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


//
//Auth::routes();
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'postLogin'])->name('postLogin');
Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('register', [AuthController::class, 'postRegister'])->name('postRegister');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');


Route::as('storefront.')->group(function () {
    Route::get('/', [StorefrontController::class, 'index'])->name('home');
    Route::resource('items', StorefrontItemController::class);
    Route::resource('books', BookController::class);
    Route::resource('companies', StorefrontCompanyController::class);
});



Route::get('/admin', [HomeController::class, 'index'])->name('admin');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


Route::middleware(['auth:web', 'super_admin'])->as('admin.')->group(function () {
    Route::prefix('admin')->group(function () {
        Route::resource('categories', AdminCategoryController::class);
        Route::resource('users', AdminUserController::class);
        Route::resource('companies', AdminCompanyController::class);
        Route::resource('items', AdminItemController::class);
        Route::get('settings', function () {

            return view('cpanel.settings.index')->with(['title'=> 'Paramettres','companies'=> Company::orderByDesc('id')->get()]);
        });
    });
});

Route::middleware(['auth:web', 'user_company'])->as('dashboard.')->group(function () {
    Route::prefix('dashboard')->group(function () {
        Route::get('settings', function () {
            return view('dashboard.settings.index')->with('title', 'Paramettres');
        });
        // Route::get('/home', [HomeController::class, 'index'])->name('home');
        Route::resource('items', ItemController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('stocks', StockController::class);
        Route::resource('sellingsx', SellingController::class);
        Route::resource('selling_details', SellingDetailController::class);
        Route::resource('users', UserController::class);
        Route::resource('companies', CompanyController::class);
        Route::resource('articles', ArticleController::class);
        Route::resource('contacts', ContactController::class);

        Route::get('rapports', [RapportController::class, 'index'])->name('rapports');
        Route::get('rapports/{from}/{to}', [RapportController::class, 'index'])->name('SearchRapports');
    });
});



Route::post('git-deploy', function () {
    Artisan::call('git:deploy');
    return __('The action ran successfully!');
});
