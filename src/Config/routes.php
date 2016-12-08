<?php

// Registration routes...
Route::get('auth/register', 'Digi\Controllers\Auth\AuthController@getRegister');
Route::post('auth/register', 'Digi\Controllers\Auth\AuthController@postRegister');

// Authentication routes...
Route::get('auth/login', 'Digi\Controllers\Auth\AuthController@getLogin');
Route::post('auth/login', ['middleware' => 'rolecheck', 'uses'=>'Digi\Controllers\Auth\AuthController@postLogin']);
Route::get('auth/logout', 'Digi\Controllers\Auth\AuthController@getLogout');

