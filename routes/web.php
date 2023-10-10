<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\CustomerController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [CustomAuthController::class, 'dashboard']); 
Route::get('dashboard', [CustomAuthController::class, 'dashboard'])->name('dashboard'); 
Route::get('login', [CustomAuthController::class, 'index'])->name('login');
Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom'); 
Route::get('registration', [CustomAuthController::class, 'registration'])->name('register-user');
Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom'); 
Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');


Route::get('users', [UserController::class, 'index'])->name('users');
Route::get('/user/{id}', [UserController::class, 'show'])->name('show-user');
Route::post('/user/{id}', [UserController::class, 'update'])->name('update-user');


Route::get('products', [ProductController::class, 'index'])->name('products');
Route::get('/add/product', [ProductController::class, 'create'])->name('product-create');
Route::post('/add/product', [ProductController::class, 'store'])->name('product.store');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('show-product');
Route::get('/product/{id}/edit', [ProductController::class, 'edit'])->name('edit-product');
Route::post('/product/{id}', [ProductController::class, 'update'])->name('product.update');

Route::get('sales', [SaleController::class, 'index'])->name('sales');
Route::get('sale/create', [SaleController::class, 'create'])->name('create-sale');
Route::post('sale/create', [SaleController::class, 'store'])->name('store.sale');
Route::post('sale/create/{id}', [SaleController::class, 'completeSale'])->name('completesale.sale');
Route::get('sale/{id}', [SaleController::class, 'show'])->name('show-sale');
Route::get('sale/{id}/edit', [SaleController::class, 'edit'])->name('edit-sale');
Route::get('sale/{id}', [SaleController::class, 'update'])->name('edit.sale');

Route::get('/search-customers', [CustomerController::class, 'searchCustomers']);
