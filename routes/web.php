<?php

Route::resource('Categoria', 'CategoriaController')->except([
    'show', 'create', 'edit'
]);

Route::put('/Categoria/activar/{id}', 'CategoriaController@activar');
Route::put('/Categoria/desactivar/{id}', 'CategoriaController@desactivar');
Route::get('/{any}', 'SinglePageController@index')->where('any', '.*');
