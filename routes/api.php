<?php

use Illuminate\Http\Request;

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

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');


//Customers
Route::post('customers/{id}/update', 'CustomerController@update');
Route::delete('customers/{id}/delete', 'CustomerController@destroy');

Route::resource('/customers', 'CustomerController');

//Trasactions
Route::post('transactions/{id}/update', 'TransactionController@update');
Route::delete('transactions/{id}/delete', 'TransactionController@destroy');

Route::resource('/transactions', 'TransactionController');


