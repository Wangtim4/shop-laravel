<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WebController;
use GuzzleHttp\Middleware;
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

Route::get('/', 'WebController@index');
Route::get('/contact_us', 'WebController@contactUs');
Route::post('/products/check-product', 'ProductController@checkProduct');



Route::resource('products', 'ProductController');

Route::resource('admin/orders', 'Admin\OrderController');


Route::post('signup', 'AuthController@signup');
Route::post('login', 'AuthController@login');

Route::group(['middleware' => 'auth:api'], function () {
    Route::get('user', 'AuthController@user');
    Route::get('logout', 'AuthController@logout');

    Route::post('carts/checkout', 'CartController@checkout');
    
    Route::get('carts', 'CartController@index');
    Route::resource('cart-items','CartItemController');
});
