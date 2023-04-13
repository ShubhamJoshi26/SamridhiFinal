<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

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
Route::get('/', function () {
    return view('admin/login');
});
Route::get('/Admin', function () {
    return view('admin/login');
});
Route::post('/AdminLogin',[AdminController::class,'LoginAdmin']);
Route::get('/Dashboard',function(){return view('/admin/dashboard');});
Route::get('/Product/ProductList',[ProductController::class,'ProductList']);
Route::get('/Product/AddProduct',[ProductController::class,'AddProduct']);
Route::post('/Product/CreateProduct',[ProductController::class,'CreateProduct']);
Route::get('/Category/CategoryList',[CategoryController::class,'CategoryList']);
Route::get('/Category/AddCategory',function(){return view('/category/addcategory');});
Route::post('/CreateCategory',[CategoryController::class,'CreateCategory']);
Route::get('/Category/EditCategory',[CategoryController::class,'EditCategory']);
Route::get('/Category/Delete',[CategoryController::class,'DeleteCategory']);
Route::any('/product/deleteproduct',[ProductController::class,'DeleteProductImage']);
Route::get('/Coupon/CouplonsList',[CouponController::class,'CouponList']);
Route::get('/Coupons/AddCoupons',[CouponController::class,'AddCoupons']);
Route::post('/CreateCoupon',[CouponController::class,'CreateCoupon']);
Route::get('/Inventroy/InventoryList',[InventoryController::class,'InventoryList']);
Route::get('/Inventory/AddInventory',[InventoryController::class,'AddInventory']);
Route::get('/productautocomplete',[InventoryController::class,'getProducts']);
Route::post('/CreateInventory',[InventoryController::class,'CreateInventory']);
Route::get('/Inventory/Delete',[InventoryController::class,'DeleteInventory']);
Route::any('/inventory/checkExistInventory',[InventoryController::class,'CheckExistInventory']);
Route::get('/CustomerList',[CustomerController::class,'CustomerList']);
Route::any('/Customer/EditCustomer',[CustomerController::class,'EditCustomer']);