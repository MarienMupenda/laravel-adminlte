<?php


use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\RapportController;
use App\Http\Controllers\SellingController;
use App\Http\Controllers\SellingDetailController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController as DashboardController;

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





Route::get('/', [DashboardController::class, 'index'])->name('home');

Route::middleware(['auth:web', 'user_company'])->as('dashboard.')->group(function () {
    Route::prefix('dashboard')->group(function () {
        Route::get('settings', function () {
            return view('dashboard.settings.index')->with('title', 'Paramettres');
        });
        // Route::get('/home', [HomeController::class, 'index'])->name('home');
        Route::resource('items', ItemController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('sellings', SellingController::class);
        Route::resource('selling_details', SellingDetailController::class);
        Route::resource('users', UserController::class);
        Route::resource('companies', CompanyController::class);
        Route::resource('contacts', ContactController::class);

        Route::get('rapports', [RapportController::class, 'index'])->name('rapports');
        Route::get('rapports/{from}/{to}', [RapportController::class, 'index'])->name('SearchRapports');
    });
});



Route::post('git-deploy', function () {
    Artisan::call('git:deploy');
    return __('The action ran successfully!');
});
