<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ExpenseController;

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
Route::get('registration', [CustomAuthController::class, 'registration'])->name('register-user')->middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('create user'));
Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom')->middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('create user'));
Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');


Route::get('users', [UserController::class, 'index'])->name('users')->middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('view user'));
Route::get('/user/{id}', [UserController::class, 'show'])->name('show-user')->middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('edit user'));
Route::post('/user/{id}', [UserController::class, 'update'])->name('update-user')->middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('edit user'));
Route::get('/role/permissions', [UserController::class, 'roleAndPermissions'])->name('role-permissions')->middleware(\Spatie\Permission\Middleware\RoleMiddleware::using('Admin'));
Route::post('/role/permissions', [UserController::class, 'updateRoles'])->name('update_roles')->middleware(\Spatie\Permission\Middleware\RoleMiddleware::using('Admin'));


Route::get('customers', [CustomerController::class, 'index'])->name('customers')->middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('view customer'));
Route::get('/customer', [CustomerController::class, 'create'])->name('create-customer')->middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('create customer'));
Route::post('/customer', [CustomerController::class, 'store'])->name('customer.store')->middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('create customer'));
Route::get('/customer/{id}/edit', [CustomerController::class, 'edit'])->name('edit-customer')->middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('edit customer'));
Route::post('/customer/{id}', [CustomerController::class, 'update'])->name('customer.update')->middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('edit customer'));

Route::get('products', [ProductController::class, 'index'])->name('products')->middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('view product'));
Route::get('/add/product', [ProductController::class, 'create'])->name('product-create')->middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('create product'));
Route::get('/add/custom/product', [ProductController::class, 'createCustomProduct'])->name('custom-product-create')->middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('create product'));
Route::post('/add/custom/product', [ProductController::class, 'storeCustomProduct'])->name('custom-product-store')->middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('create product'));
Route::post('/add/product', [ProductController::class, 'store'])->name('product.store')->middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('create product'));
Route::get('/product/{id}', [ProductController::class, 'show'])->name('show-product')->middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('view product'));
Route::get('/product/{id}/edit', [ProductController::class, 'edit'])->name('edit-product')->middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('edit product'));
Route::post('/product/{id}', [ProductController::class, 'update'])->name('product.update')->middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('edit product'));
Route::get('/products/filter', [ProductController::class, 'filter'])->name('products-filter')->middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('view product'));

Route::get('sales', [SaleController::class, 'index'])->name('sales')->middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('view sale'));
Route::get('/sales/filter', [SaleController::class, 'filter'])->name('sales-filter')->middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('view sale'));
Route::get('sale/create', [SaleController::class, 'create'])->name('create-sale')->middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('create sale'));
Route::post('sale/create', [SaleController::class, 'store'])->name('store.sale')->middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('create sale'));
Route::post('sale/create/{id}', [SaleController::class, 'completeSale'])->name('completesale.sale')->middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('create sale'));
Route::get('sale/{id}/edit', [SaleController::class, 'edit'])->name('edit-sale')->middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('edit sale'));
Route::get('sale/{id}', [SaleController::class, 'update'])->name('edit.sale')->middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('edit sale'));

Route::get('/search-customers', [CustomerController::class, 'searchCustomers']);
Route::get('/search-product', [ProductController::class, 'searchProducts']);

Route::get('sale/{id}', [SaleController::class, 'show'])->name('show-sale')->middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('view sale'));
Route::get('/sales/print/{id}', [SaleController::class, 'printSales'])->name('sales.print')->middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('view sale'));;


Route::get('expenses', [ExpenseController::class, 'index'])->name('expenses')->middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('view expense'));
Route::get('/expenses/filter', [ExpenseController::class, 'filter'])->name('expenses-filter')->middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('view expense'));
Route::get('/expense', [ExpenseController::class, 'create'])->name('create-expense')->middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('create expense'));
Route::post('/expense', [ExpenseController::class, 'store'])->name('expense.store')->middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('create expense'));
Route::get('expense/{id}', [ExpenseController::class, 'show'])->name('show-expense')->middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('view expense'));
Route::get('/expense/{id}/edit', [ExpenseController::class, 'edit'])->name('edit-expense')->middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('edit expense'));
Route::post('/expense/{id}', [ExpenseController::class, 'update'])->name('expense.update')->middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('edit expense'));

Route::post('return/sale-product/{id}', [SaleController::class, 'returnSale'])->name('return.saledproduct')->middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('return sale'));
Route::post('cancel/sale-product/{id}', [SaleController::class, 'cancelSale'])->name('cancel.saledproduct')->middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('view sale'));
