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

class EmprunterController extends BaseController
{

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function renderEmprunter(Request $request)
    {

        // Récupération des informations pour le formulaire
        $types = Modell::getType();

        // Envoi du formulaire
        return view('emprunter')->with('types', $types);


    }

    public function loadObjet(Request $request)
    {
        $numType = $request->get('numType');
        $html = "";

        $objets = Modell::getObjet($numType);

        foreach($objets as $objet){
            $html = "<option value='".$objet->idObjet."'>".$objet->nomObjet."</option>";
        }

        return $html;
    }

    public function emprunt(Request $request){

        if ($request->get('codeB') == "") {
            $idUser = $request->get('idUser');
            $nom = $request->get('nom');
            $prenom = $request->get('prenom');
            $dateDeb = $request->get('dateDeb');
            $objet = $request->get('objet');
        }else if ($request->get('codeB') != ""){
            $idUser = $request->get('idUser');
            $nom = $request->get('nom');
            $prenom = $request->get('prenom');
            $dateDeb = $request->get('dateDeb');
            $objet = $request->get('codeB');
        }


        Modell::emprunt($idUser, $nom, $prenom, $dateDeb, $objet);

        return redirect('/accueil')->with('demenv', 'Votre emprunt a été accordé');
    }
}
