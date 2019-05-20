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

Route::get('/', 'UsuarioAjaxController@listarUsuario');
Route::get('/{id}/atualizarUsuario', 'UsuarioAjaxController@atualizarUsuario');
Route::post('/criarUsuario','UsuarioAjaxController@criarUsuario');
Route::get('/deletarUsuario/{id}', 'UsuarioAjaxController@deletarUsuario');