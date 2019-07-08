<?php

Route::resource('Categoria', 'CategoriaController')->except([
    'show', 'create', 'edit'
]);
Route::put('/Categoria/activar/{id}', 'CategoriaController@activar');
Route::put('/Categoria/desactivar/{id}', 'CategoriaController@desactivar');
Route::get('/Categoria/selectcategoria', 'CategoriaController@selectcategoria');
//producto
Route::resource('Producto', 'ProductoController')->except([
    'show', 'create', 'edit'
]);
Route::put('/Producto/activar/{id}', 'ProductoController@activar');
Route::put('/Producto/desactivar/{id}', 'ProductoController@desactivar');
Route::get('/{any}', 'SinglePageController@index')->where('any', '.*');
