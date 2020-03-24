<?php

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

Route::get('/ingredient/create', 'IngredientController@index');
Route::get('/ingredients/list', 'IngredientController@getList');
Route::post('/ingredient/create', 'IngredientController@create');


Route::get('/pizza/create', 'PizzaController@index');
Route::post('/pizza/create', 'PizzaController@create');
