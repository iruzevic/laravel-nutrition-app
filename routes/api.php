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

Route::post('register', 'PassportController@register');
Route::post('login', 'PassportController@login');

Route::group(['middleware' => 'auth:api'], function(){
  Route::get('userDetails', 'PassportController@getDetails');

  Route::resource('meals', 'MealsController', array('only' => array('index', 'store', 'show', 'update', 'destroy')));
  Route::resource('nutrients', 'NutrientsController', array('only' => array('index', 'store', 'show', 'update', 'destroy')));
  Route::resource('nutrientsTypes', 'NutrientsTypeController', array('only' => array('index', 'store', 'show', 'update', 'destroy')));
  Route::resource('entries', 'EntriesController', array('only' => array('index', 'store', 'show', 'update', 'destroy')));
});
