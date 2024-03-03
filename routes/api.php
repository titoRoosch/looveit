<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SalesController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/products', [ProductsController::class, 'getProducts']);
Route::get('/products/{product_id}', [ProductsController::class, 'getProductsById']);

Route::get('/sales', [SalesController::class, 'getSales']);
Route::get('/sales/{sales_id}', [SalesController::class, 'getSalesById']);
Route::post('/sales', [SalesController::class, 'createSale']);
Route::post('/sales/{sales_id}', [SalesController::class, 'addItemsToSale']);
Route::patch('/sales/{sales_id}', [SalesController::class, 'cancelSale']);