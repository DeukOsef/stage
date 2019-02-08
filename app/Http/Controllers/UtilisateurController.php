<?php

namespace App\Http\Controllers;

use App\Modell;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use DB;
use DataTables;
use Illuminate\Support\Facades\Session;

class UtilisateurController extends BaseController
{

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function renderUtilisateur(Request $request){
        $demandes = Modell::getAllUser();
        return view('utilisateur')->with('demandes',$demandes);
    }


    public function getAllUsers(){
        $demandes = Modell::getAllUser();


        return DataTables::of($demandes)
            ->addColumn('action', function ($demandes) {
                $idUser="$demandes->idUser";
                    return '<a href="'.url('supprimerUser').'/'.$idUser.'" class="btn btn-xs btn-primary "> Supprimer</a><a href="'.url('editUser').'/'.$idUser.'" class="btn btn-xs btn-primary "> Modifier</a>';

            })->editColumn('profil', function ($demandes){
                if ($demandes->profil == 1){
                    return "Administrateur";
                }else{
                    return "Utilisateur";
                }
        })
            ->make(true);
    }

    public function supprimerUser($idUser){
        Modell::deleteUser($idUser);
        return  redirect('/utilisateur')->with('demenv', 'UTILISATEUR SUPPRIME');
    }



}
