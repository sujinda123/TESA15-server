<?php

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::apiResource('lemons','App\Http\Controllers\LemonController');
Route::get('lemons/getLast','App\Http\Controllers\LemonController@getLast');
Route::get('lemons/checkUpdate','App\Http\Controllers\LemonController@checkUpdate');
Route::post('lemons/create','App\Http\Controllers\LemonController@create');
Route::put('lemons/update','App\Http\Controllers\LemonController@update');

Route::get('lemons/mqtt','App\Http\Controllers\LemonController@mqtt_lemons');

Route::apiResource('lemons','App\Http\Controllers\LemonController');
