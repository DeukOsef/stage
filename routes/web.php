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
Route::any('/', 'LoginController@renderLogin'); //arrivé sur le site
Route::any('/login', 'LoginController@connexion'); //envoie des données de connection
Route::any('/logout','LoginController@logout'); // suppression des données


Route::any('/accueil','AccueilController@renderAccueil'); //arrivé sur la page principale
Route::any('/mesEmprunts','MesEmpruntsController@renderMesEmprunts'); //arrivé sur la page des emprunts


Route::any('/getEmprunt', 'MesEmpruntsController@getEmprunt')->name('getEmprunt'); //recuperation des emprunts en cours ou rendu
Route::any('/emprunter','EmprunterController@renderEmprunter'); //chargement de la page emprunter
Route::any('/loadObjet','EmprunterController@loadObjet'); //chargement des objets en fonction des types
Route::any('/emprunt','EmprunterController@emprunt'); //mise en base de l'emprunt


Route::any('/listeObjets','ListeObjetsController@renderListeObjets');
Route::any('/checkManque','ListeObjetsController@checkManque');
Route::any('/info','ListeObjetsController@info');
Route::any('/infoWithCodeB','ListeObjetsController@infoWithCodeB');
Route::any('/getEmpruntAll', 'ListeObjetsController@getEmpruntAll')->name('getEmpruntAll');
Route::any('/rendreEmprunt/{id}','MesEmpruntsController@rendreEmprunt');

Route::any('/CreationObjet','CreationObjetController@renderCreationObjet');
Route::any('/creer','CreationObjetController@creer');
Route::any('/getName','EmprunterController@getName');



Route::any('/barcode','CodeBarreController@barcode');
Route::any('/rimprimer/{idObjet}','ListeObjetsController@rimprimer');
Route::any('/supprimer/{id}','ListeObjetsController@supprimer');


Route::any('/parametre', 'ParametreController@renderParametre');
Route::any('/parametrage','ParametreController@parametrage');


Route::any('/accueilbis','AccueilController@renderAccueilBis'); //arrivé sur la page principale