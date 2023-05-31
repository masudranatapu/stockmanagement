<?php

use Illuminate\Support\Facades\Route;
// forntend
use App\Http\Controllers\HomeController;
// user
use App\Http\Controllers\User\InformationController;
// admin 
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\StockController;

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


Route::get('/', [HomeController::class, 'welcome'])->name('home');

// lang change 
Route::get('changelanguage/{lang}', [HomeController::class, 'changeLanguage'])->name('changeLanguage');

Auth::routes();

Route::group(['as' => 'admin.', 'prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth', 'admin']], function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('products', [ProductController::class, 'index'])->name('products.index');
    Route::get('products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('products/store', [ProductController::class, 'store'])->name('products.store');
    Route::get('products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::post('products/{id}/update', [ProductController::class, 'update'])->name('products.update');
    Route::get('products/{id}/delete', [ProductController::class, 'delete'])->name('products.delete');

    Route::get('stocks', [StockController::class, 'index'])->name('stocks.index');
    Route::get('stocks/add', [StockController::class, 'create'])->name('stocks.create');
    Route::post('stocks/store', [StockController::class, 'store'])->name('stocks.store');
    Route::get('stocks/{id}/delete', [StockController::class, 'delete'])->name('stocks.delete');

});

Route::group(['as' => 'user.', 'prefix' => 'user', 'namespace' => 'User', 'middleware' => ['auth', 'user']], function () {
    
    Route::get('/information', [InformationController::class, 'information'])->name('dashboard');

});
