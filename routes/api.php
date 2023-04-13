<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
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
Route::any('/Products/GetAllProducts',[ProductController::class,'GetAllProducts']);
Route::any('/Products/GetAllProductsImages',[ProductController::class,'GetAllProductsImages']);
Route::controller(CustomerController::class)->group(function(){
    Route::post('register', 'register');
    Route::post('login', 'login');
});
Route::any('/Category/GetAllCategory',[CategoryController::class,'GetAllCategory']);
Route::post('/Customer/CreateCustomerAddress',[CustomerController::class,'CreateCustomerAddress']);
Route::post('/Customer/UpdateCustomerAddress',[CustomerController::class,'UpdateCustomerAddress']);
Route::post('/Order/CreateOrder',[OrderController::class,'CreateOrder']);
Route::post('/Order/AddToCart',[OrderController::class,'AddToCart']);
