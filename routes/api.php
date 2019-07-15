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

/* RESTful routes for processes API */
Route::resource('/processes','ProcessController');

/* RESTful routes for API Keys */
Route::resource('/keys','KeyController');
