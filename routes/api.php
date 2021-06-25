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

Route::get('/lembaga', 'InstitutionController@index');
Route::get('/lembaga/{id}', 'InstitutionController@show');
Route::post('/lembaga/', 'InstitutionController@store');
Route::delete('/lembaga/{id}', 'InstitutionController@destroy');
Route::patch('/lembaga/{id}', 'InstitutionController@update');