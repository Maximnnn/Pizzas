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
//pages
Route::get('/', 'PizzaController@pizzaList');
Route::get('/pizza/{pizza}', 'PizzaController@pizza');
Route::get('/ingredient/create', 'IngredientController@index');
Route::get('/pizza/create', 'PizzaController@createPage');

//json apis
Route::get('/ingredients/list', 'IngredientController@getList');
Route::post('/ingredient/create', 'IngredientController@create');
Route::post('/pizza/create', 'PizzaController@create');
Route::post('/pizza/update/{pizza}', 'PizzaController@update');
