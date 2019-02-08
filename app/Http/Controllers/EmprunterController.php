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

        $idUser = Modell::getIdUserByConcat($request->get('idUser'))->idUser;

        $nom = Modell::getNomById($idUser)->nom;
        $prenom = Modell::getPreomById($idUser)->prenom;
        $dateDeb = $request->get('dateDeb');
//        $secteur = Modell::getSecteurById($idUser)->secteur;
        $codeB = $request->get('codeB');
        $codeB1 = $request->get('codeB1');
        $codeB2 = $request->get('codeB2');
        $codeB3 = $request->get('codeB3');
        $codeB4 = $request->get('codeB4');

        if($codeB != "" || $codeB1 != "" || $codeB2 != "" || $codeB3 != "" || $codeB4 != "" ){

            if ($codeB == ""){
                $codeB ="";
            }
            if ($codeB1 == ""){
                $codeB1 ="1";
            }
            if ($codeB2 == ""){
                $codeB2 ="2";
            }
            if ($codeB3 == ""){
                $codeB3 ="3";
            }
            if ($codeB4 == ""){
                $codeB4 ="4";
            }
                                    //            CODEBARRE 1

            if ($codeB != "" && $codeB != $codeB1 && $codeB != $codeB2 && $codeB != $codeB3 && $codeB != $codeB4 ){
                $objet = Modell::getUnObjet($codeB)->idObjet;

                Modell::emprunt($idUser, $nom, $prenom, $dateDeb, $objet);

            }

                                            //            CODEBARRE 2

            if ($codeB1 != "1" && $codeB1 != $codeB2 && $codeB1 != $codeB3 && $codeB1 != $codeB4 && $codeB1 != $codeB ){

                $objet1 = Modell::getUnObjet($codeB1)->idObjet;


                Modell::emprunt($idUser, $nom, $prenom, $dateDeb, $objet1);

            }

                                            //            CODEBARRE 3

            if ($codeB2 != "2" && $codeB2 != $codeB3 && $codeB2 != $codeB4 && $codeB2 != $codeB && $codeB2 != $codeB1  ){
                $objet2 = Modell::getUnObjet($codeB2)->idObjet;

                Modell::emprunt($idUser, $nom, $prenom, $dateDeb, $objet2);

            }
                                            //            CODEBARRE 4

            if ($codeB3 != "3" && $codeB3 != $codeB4 && $codeB3 != $codeB && $codeB3 != $codeB1 && $codeB3 != $codeB2 ){
                $objet3 = Modell::getUnObjet($codeB3)->idObjet;

                Modell::emprunt($idUser, $nom, $prenom, $dateDeb, $objet3);


            }
                                            //            CODE BARRE 5

            if ($codeB4 != "4" && $codeB4 != $codeB && $codeB4 != $codeB1 && $codeB4 != $codeB2 && $codeB4 != $codeB3 ){
                $objet4 = Modell::getUnObjet($codeB4)->idObjet;
                Modell::emprunt($idUser, $nom, $prenom, $dateDeb, $objet4);

            }

            return redirect('/accueil')->with('emprunt', 'EMPRUNTE');


        }elseif ($codeB == "" && $codeB1 == "" && $codeB2 == "" && $codeB3 == "" && $codeB4 == ""){
            $objetl = $request->get('objet');
            Modell::emprunt($idUser, $nom, $prenom, $dateDeb, $objetl);
        }else{
            return redirect('/emprunter')->with('demenv', 'ERREUR test4');
        }





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
