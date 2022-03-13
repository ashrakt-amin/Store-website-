<?php

use App\Http\Middleware\Local;
use App\Http\Middleware\UserType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\CheckOutController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\ConverterController;
use App\Http\Controllers\PaypalController;
use App\Http\Controllers\MoyasarController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\MessageController;


use Illuminate\Support\Facades\App;





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

  

Route::prefix('/')->middleware('admin')->group(function(){

    Route::resource('categories',CategoriesController::class);
    Route::resource('products',productsController::class);
    Route::get('message',[MessageController::class ,'admin'])->name('message');
    Route::get('trash',[MessageController::class ,'trash'])->name('trash');
    Route::delete('trash/{id}',[MessageController::class ,'forceDelete'])->name('destroy');
    Route::get('restore/{id}',[MessageController::class ,'restore'])->name('restore');
    Route::resource('users',UsersController::class);
    Route::resource('roles',RolesController::class);


});


Route::prefix('/nav',[HomepageController::class,'header'])->middleware('local')->group(function(){
    Route::get('/category/{id}',[HomepageController::class,'productsOfCategory'])->name('homepage.category');
    Route::get('/homepage/products',[HomepageController::class,'getProducts'])->name('homepage.products');
    Route::get('lang/{lang}',[HomepageController::class,'switchLang'])->name('lang.switch');
    Route::post('/cart',[CartController::class,'store'])->name('cart.store');
    Route::get('/cart/index',[CartController::class,'index'])->name('homepage.cart');
    Route::patch('/cart',[CartController::class,'update'])->name('cart.update');
    Route::delete('/cart',[CartController::class,'destroy'])->name('cart.destroy');
    Route::get('/moyasar/{id}',[MoyasarController::class,'index'])->name('homepage.moyasar');
    Route::get('/moyasar/{id}/callback',[MoyasarController::class,'callback'])->name('moyasar.callback');
    Route::get('/homepage/about',[ContactController::class,'show'])->name('homepage.about');
    Route::get('/paypal',[PaypalController::class,'createOrder'])->name('paypal.create');
    Route::get('/paypal/return',[PaypalController::class,'paypalReturn'])->name('paypal.return');
    Route::get('/paypal/cancel',[PaypalController::class,'paypalCancel'])->name('paypal.cancel');
    Route::get('/notification/{id}',[NotificationsController::class,'read'])->name('notification');
    
    Route::middleware(['auth:sanctum', 'verified'])->group(function(){
        Route::post('/checkout',[CheckOutController::class,'store'])->name('checkout.store');
        Route::get('/orders',[OrdersController::class,'index'])->name('homepage.orders');
        Route::get('/contact',[ContactController::class,'create'])->name('homepage.create');
        Route::post('/store',[ContactController::class,'store'])->name('contact.store');
        
      });
    });
//Route::get('trash',[productsController::class,'trash'])->name('products.trash');


Route::get('/{lang?}', function () {
    return view('welcome');
});


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    (['auth:sanctum', 'verified']);
    return view('dashboard');
    
})->name('dashboard');



Route::get('/xml','CategoriesController@xml');
Route::get('/json','CategoriesController@json');

Route::get('/currency/{from}/{to}',[ConverterController::class, 'convert']);
Route::get('currency-converter/currencies',[ConverterController::class,'currency']);
