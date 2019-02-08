<?php

namespace App\Http\Controllers;

use App\Modell;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use DB;
use DataTables;
use Illuminate\Support\Facades\Session;

class CreerController extends BaseController
{

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function renderCreerUtilisateur(){
        return view('creerUser');
    }


    public function createUser(Request $request){
        $nom = $request->get('nom');
        $prenom = $request->get('prenom');
        $login = $request->get('login');
        $password = $request->get('password');
        $profil = $request->get('profil');
        $poste = $request->get('poste');
        $num = $request->get('num');
        $matricule = $request->get('matricule');
        Modell::createUser($nom,$prenom,$login,$password,$profil,$poste,$num,$matricule);
        return  redirect('/utilisateur')->with('emprunt', 'UTILISATEUR CREEER');
    }



}
