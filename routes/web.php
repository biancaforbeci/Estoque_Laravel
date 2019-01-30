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

Route::get('/', function () {
    return view('index');
});

Route::get('/produtos', 'ControllerProduto@index');
Route::get('/produtos/novo','ControllerProduto@create');


Route::get('/categorias','ControllerCategoria@index');
Route::get('/categorias/novo','ControllerCategoria@create');
Route::post('/categorias','ControllerCategoria@store');
Route::post('/categorias/{id}','ControllerCategoria@update');
Route::get('/categorias/editar/{id}','ControllerCategoria@edit');
Route::get('/categorias/apagar/{id}','ControllerCategoria@destroy');

Route::get('/clientes','ControllerCliente@indexView');
Route::get('/clientes/novo','ControllerCliente@create');
Route::post('/clientes',"ControllerCliente@store");
Route::post('/clientes/{id}','ControllerCliente@update');
Route::get('/clientes/editar/{id}','ControllerCliente@edit');
Route::get('/clientes/apagar/{id}','ControllerCliente@delete');
