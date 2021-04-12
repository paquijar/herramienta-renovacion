<?php

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

// Route::get('/', function () {
// 	return view('welcome');
// });

Auth::routes();
Route::get('/', 'HomeController@index');

//Rutas para usuario
Route::post('/equipo', 'EquiposController@store');

Route::get('/createTecnicos/{equipo}', 'EquiposController@createTecnicos');
Route::get('/tecnicos', 'HomeController@index');
Route::post('/tecnicos', 'EquiposController@storeTecnicos');

Route::get('/createClinicos/{equipo}', 'EquiposController@createClinicos');
Route::get('/clinicos', 'HomeController@index');
Route::post('/clinicos', 'EquiposController@storeClinicos');

Route::get('/showEquipos', 'EquiposController@showEquipos');
Route::get('/showEquipo/{equipo}', 'EquiposController@showEquipo');
Route::get('/showCalculados', 'EquiposController@showCalculados');
Route::get('/showSin', 'EquiposController@showSin');
Route::get('/info', 'EquiposController@create');
Route::get('/score/{equipo}', 'EquiposController@calcularScore');

//Rutas para admin

Route::resource('categoria', 'CategoriasController');
Route::resource('hospital', 'HospitalsController');
Route::resource('subcategoria', 'SubcategoriasController');
Route::resource('variable', 'VariablesController');
Route::resource('diccionario_variable', 'Diccionario_variablesController');
Route::get('/diccionario/{variable}', 'Diccionario_variablesController@showOpciones');
Route::resource('propuesta', 'PropuestasController');