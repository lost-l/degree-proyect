<?php

use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Livewire\ProductDetails;
use App\Http\Livewire\Products;
use App\Http\Livewire\Purchase;
use App\Http\Livewire\PurchaseDetails;
use App\Http\Livewire\ShowProducts;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
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

//Public routes
Route::redirect('/admin/login', '/');
Route::get('/', HomeController::class)->name('home');
Route::prefix('products')->group(function () {
    Route::get('/', ShowProducts::class)->name('products');
    Route::get('/{product}', ProductDetails::class)->name('product-details');
});
Route::view('about-us', 'about-us')->name('about-us');
Route::controller(ContactUsController::class)->group(function () {
    Route::get('contact-us', 'create')->name('contact-us.create');
    Route::post('contact-us', 'store')->name('contact-us.store');
});

//Protected routes
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard');
    Route::prefix('purchase')->group(function () {
        Route::get('/', Purchase::class)->name('purchase.create');
        // ->middleware('role:costumer');
        Route::get('/details/{order}', PurchaseDetails::class)->name('purchase.show');
    });
});
