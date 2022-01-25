<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\balanceRequestsController;

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
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::group(['prefix' => 'admin', 'middleware' => 'auth:sanctum'], function () {
    //Balance request 
    Route::post('requests', [balanceRequestsController::class, 'index']);
    Route::post('store_request', [AdminController::class, 'storeRequest']);
    Route::post('delete_request', [AdminController::class, 'deleteRequest']);
    Route::post('update_request', [AdminController::class, 'updateRequest']);

    //history requests
    Route::post('histories', [historyController::class, 'getHistory']);
    Route::post('user_histories', [historyController::class, 'getUserHistory']);
    Route::post('add_history', [historyController::class, 'store']);
    Route::post('update_history', [historyController::class, 'update']);
    Route::post('delete_history', [historyController::class, 'destroy']);


    Route::get('market_cards', [AdminController::class, 'getMarketCards']);

});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
