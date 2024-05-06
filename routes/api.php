<?php

use App\Http\Controllers\AuthUserApiController;
use App\Http\Controllers\userController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::post('/login', [AuthUserApiController::class, 'login']);
Route::post('/register', [userController::class, 'store']);

//rutas protegidas
//descomentar linea de api en el archivo kernel.php
Route::group(['middleware' => ['auth:sanctum']], function () {

    //grupo de rutas usuario
    Route::group(['prefix' => 'users', 'controller' => userController::class], function () {
        Route::get('/', 'index');
        Route::get('/{user}', 'show');
        Route::post('/', 'store');
        Route::put('/{user}', 'update');
        Route::delete('/{user}', 'destroy');
    });
    Route::post('/logout', [AuthUserApiController::class, 'logout']);
    Route::get('/profile', [AuthUserApiController::class, 'profile']);
});
