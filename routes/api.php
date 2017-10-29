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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::middleware('auth:api')->get('/currency/list', 'CurrencyController@index');
Route::middleware('auth:api')->get('/currency/convert', 'CurrencyController@convert');
Route::middleware('auth:api')->delete('/currency/delete/{id}', 'CurrencyController@delete');
Route::middleware('auth:api')->post('/currency/create', 'CurrencyController@create');
