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
    return view('welcome');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Roles
Route::get('listar_rol', 'Rol\RolesController@listar_rol')->name('listar_rol');
Route::get('form_rol', 'Rol\RolesController@form_rol')->name('form_rol');
Route::post('nuevo_rol', 'Rol\RolesController@nuevo_rol')->name('nuevo_rol');
Route::get('editar_rol/{id}', 'Rol\RolesController@editar_rol')->name('editar_rol');
Route::post('actualizar_rol/{id}', 'Rol\RolesController@actualizar_rol')->name('actualizar_rol');
Route::get('eliminar_rol/{id}', 'Rol\RolesController@eliminar_rol')->name('eliminar_rol');

//Usuario
Route::get('lista_usuario', 'Auth\RegisterController@lista_usuario')->name('lista_usuario');
Route::get('form_usuario', 'Auth\RegisterController@form_usuario')->name('form_usuario');
Route::put('nuevo_usuario', 'Auth\RegisterController@nuevo_usuario')->name('nuevo_usuario');


