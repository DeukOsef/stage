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
        $noms = Modell::getAllNoms();
        // Envoi du formulaire
        return view('emprunter')->with('types', $types)->with('noms', $noms);


    }

    public function loadObjet(Request $request)
    {
        $numType = $request->get('numType');
        $html = "";

        $objets = Modell::getObjet($numType);

        foreach($objets as $objet){
            $html .= "<option value='".$objet->idObjet."'>".$objet->nomObjet."</option>";
        }

        return $html;
    }

    public function emprunt(Request $request){

        $idUser = $request->get('idUser');
        $nom = Modell::getNomById($idUser)->nom;
        $prenom = Modell::getPreomById($idUser)->prenom;


        if ($request->get('codeB') == "") {
            $dateDeb = $request->get('dateDeb');
            $objet = $request->get('objet');


        }else if ($request->get('codeB') != ""){
            $dateDeb = $request->get('dateDeb');
            $nomObjet = $request->get('codeB');
            $objet = Modell::getUnObjet($nomObjet);
        }


        Modell::emprunt($idUser, $nom, $prenom, $dateDeb, $objet);

        return redirect('/accueil')->with('emprunt', 'Votre emprunt a été accordé');
    }


    public  function getName(Request $request){

        $name = $request->get('name');

        $allNames = Modell::getNames($name);
        $html = '';
        if(count($allNames) > 0){
            $html = $allNames[0]->nom . ' ' . $allNames[0]->prenom;
        }

        return $html;



    }
}
