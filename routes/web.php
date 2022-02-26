<?php

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/products/{product_id}', [\App\Http\Controllers\ProductController::class, 'purchase'])->name('products.buy');
Route::post('/purchases/store', [\App\Http\Controllers\PurchaseController::class, 'store'])->name('purchase.store');

Route::resource('/admin/products', \App\Http\Controllers\ProductController::class);

Route::get('/invoices/index', [\App\Http\Controllers\InvoiceController::class, 'index'])->name('invoices.index');
Route::get('/invoices/detail/{invoice_id}', [\App\Http\Controllers\InvoiceController::class, 'detail'])->name('invoices.detail');
Route::post('/invoices/store', [\App\Http\Controllers\InvoiceController::class, 'store'])->name('invoices.store');
