<?php


Route::get('/', 'PropertyController@index');
Route::get('api/property', 'PropertyController@getData');
