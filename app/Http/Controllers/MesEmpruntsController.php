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

class MesEmpruntsController extends BaseController
{

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function renderMesEmprunts(Request $request){
        return view('MesEmprunts');
    }





    public function getEmprunt(){
        $demandes = Modell::getEmprunt(session()->get('client')->idUser);

        return DataTables::of($demandes)
            ->addColumn('Icone', function ($demandes) {
                return "icon/".Modell::getTypeById($demandes->idObjet)->type.".png"; }
            )->addColumn('Site', function ($demandes) {
                return Modell::getNomSite(Modell::getSiteByIdObjet($demandes->idObjet)->site)->nomSite; }
            )->addColumn('etat', function ($demandes) {
            if($demandes->etat== 1){
                return 'emprunté';
            }else if ($demandes->etat == 2){
                return 'Rendu';
            }
        })
            ->addColumn('action', function ($demandes) {
                if($demandes->etat== 1){
                    $id="$demandes->idObjet";
                    return '<button type="button" onclick="openModal('.$id.',event)" id="test" data="'.$id.'" class="btn btn-xs btn-primary " data-toggle="modal" data-target="#modalRendre" style="margin-top: 4px"><i class="glyphicon glyphicon-edit"></i>Rendre</button>';}
            })
            ->make(true);
    }

    public function rendreEmprunt(Request $request){
        $commentaire = "";
        $commentaire .= $request->get('commentaire');
        $id = $request->get('idEmprunt');
        $fonctionne = $request->get('fonctionne');
        if ($fonctionne == 1){
            $fonctionne = "non";
        }else{
            $fonctionne = "oui";
        }


        Modell::rendreEmprunt($id,$commentaire);
        $idObjet = Modell::getObjetByIdEmprunt($id)->idObjet ;
        Modell::updateObjet($idObjet,$fonctionne);

        $test = Modell::getEmpruntFini($id);
        $emprunt = array();
        $emprunt['idEmprunt'] = $test->idEmprunt;
        $emprunt['idObjet'] = $test->idObjet;
        $emprunt['idUser'] = $test->idUser;
        $emprunt['dateDeb'] =$test->dateDeb;
        $emprunt['dateFin'] =$test->dateFin;
        $emprunt['nom'] =$test->nom;
        $emprunt['prenom'] = $test->prenom;
        $emprunt['nomObjet'] =$test-> nomObjet;
        $emprunt['etat'] = $test->etat;
        $emprunt['commentaire'] = $test->commentaire;

        Modell::insertEmpruntFini($emprunt);
        Modell::deleteEmpruntFini($id);



        return redirect('/accueil')->with('emprunt','L\'emprunt est terminé, veuuillez ranger l\'objet a son emplacement');
    }


}
