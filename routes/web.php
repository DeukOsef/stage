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


//PAGE LOGIN
Route::any('/', 'LoginController@renderLogin');
Route::any('/login', 'LoginController@connexion');
Route::any('/accueil','AccueilController@renderAccueil');
Route::any('/logout','LoginController@logout');
