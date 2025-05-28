<?php

use Illuminate\Support\Facades\Route;

Route::get('/characters/{character}', '\App\Http\Controllers\CharacterController@show');
Route::get('/characters', '\App\Http\Controllers\CharacterController@index');