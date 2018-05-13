<?php

Route::get('/','AlbumsController@index');
Route::get('/albums','AlbumsController@index');
Route::get('/albums/create','AlbumsController@create');
Route::post('/albums/store','AlbumsController@store');
Route::get('/albums/{id}','AlbumsController@show');
Route::get('/photos/create/{id}','PhotoController@create');
Route::post('/photos/store','PhotoController@store');
Route::get('/photo/show/{id}', 'PhotoController@show');
Route::delete('/photos/{id}', 'PhotoController@destroy');