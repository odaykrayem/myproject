<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AdminController;
use App\Http\Controllers\AuthController;

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

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::group(['prefix' => 'admin', 'middleware' => 'auth:sanctum'], function () {
    //Balance request 
    Route::post('requests', [AdminController::class, 'getRequests']);
    Route::post('histories', [AdminController::class, 'getHistory']);
    Route::post('store_request', [AdminController::class, 'storeRequest']);
    Route::post('delete_request', [AdminController::class, 'deleteRequest']);
    Route::post('update_request', [AdminController::class, 'updateRequest']);


    Route::get('market_cards', [AdminController::class, 'getMarketCards']);

});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
