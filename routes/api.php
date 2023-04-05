<?php

use App\Http\Controllers\Api\MidtransController;
use App\Http\Controllers\Api\ProductsController;
use App\Http\Controllers\Api\OrdersController;
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

Route::resource('products', ProductsController::class);
Route::resource('orders', OrdersController::class);
Route::post('midtrans/payment', [MidtransController::class, 'index']);
Route::post('/webhooks/midtrans', [MidtransController::class, 'handleWebhook']);


