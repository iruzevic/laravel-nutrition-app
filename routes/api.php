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
  Route::resource('meals', 'MealsController', array('only' => array('store', 'show', 'update', 'destroy')));
  Route::resource('nutrients', 'NutrientsController', array('only' => array('store', 'show', 'update', 'destroy')));
  Route::resource('nutrients-types', 'NutrientsTypesController', array('only' => array('store', 'show', 'update', 'destroy')));
  Route::resource('entries', 'EntriesController', array('only' => array('store', 'show', 'update', 'destroy')));
  Route::resource('users-details', 'UsersDetailsController', array('only' => array('store', 'show', 'update')));
});
