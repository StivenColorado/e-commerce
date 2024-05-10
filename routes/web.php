<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ShowController;
use App\Http\Controllers\ShoppingCartController;

Auth::routes();
Route::get('/', [ProductController::class, 'home'])->name('products.home');
Route::get('/show/{id}', [ShowController::class, 'index'])->name('show.index');

Route::get('buscar', [SearchController::class, 'index'])->name('search.index');
Route::get('buscar/resultados', [SearchController::class, 'search'])->name('search.results');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    // Users
    Route::group(['prefix' => 'users', 'middleware' => ['role:admin'], 'controller' => UserController::class], function () {
        Route::get('/', 'index')->name('users.index')->middleware('can:users.index');
        Route::get('/create', 'create')->name('users.create')->middleware('can:users.create');
        Route::post('/', 'store')->name('users.store')->middleware('can:users.store');
        Route::get('/{user}/edit', 'edit')->name('users.edit')->middleware('can:users.edit');
        Route::put('/{user}', 'update')->name('users.update')->middleware('can:users.update');
        Route::delete('/{user}', 'destroy')->name('users.destroy')->middleware('can:users.destroy');
    });

    // products
    Route::group(['prefix' => 'products', 'controller' => ProductController::class], function () {
        Route::get('/', 'index')->name('products.index')->middleware('can:products.index');
        Route::get('/show/{product}', 'show')->name('products.show')->middleware('can:products.show');
        Route::post('/store', 'store')->name('products.store')->middleware('can:products.store');
        Route::post('/update/{product}', 'update')->name('products.update')->middleware('can:products.update');
        // Route::put('/{product}', 'update')->name('products.update')->middleware('can:products.update');
        Route::delete('/{product}', 'destroy')->name('products.destroy')->middleware('can:products.destroy');
    });

    // Category
    Route::group(['prefix' => 'categories', 'controller' => CategoryController::class], function () {
        Route::get('/', 'index')->name('categories.index')->middleware('can:categories.index');
        Route::get('/get-all', 'index')->name('categories.get-all');
        Route::get('/get-all-dt', 'getAll')->name('categories.get-all-dt');
        Route::get('/{category}', 'show')->name('categories.show');
        Route::post('/', 'store')->name('categories.store')->middleware('can:categories.store');
        Route::put('/{category}', 'update')->name('categories.update')->middleware('can:categories.update');
        Route::delete('/{category}', 'destroy')->name('categories.destroy')->middleware('can:categories.destroy');
    });

    //TODO configurar rutas para shopping
    Route::group(['prefix' => 'shoppingCart', 'controller' => ShoppingCartController::class], function () {
        Route::get('/', 'index')->name('shoppingCart.index');
        Route::get('/show/{product}', 'show')->name('shoppingCart.show');
        Route::post('/store', [ShoppingCartController::class, 'store'])->name('shoppingCart.store');
        Route::post('/update/{product}', 'update')->name('shoppingCart.update');
        Route::delete('/{product}', 'destroy')->name('shoppingCart.destroy');
    });
});
