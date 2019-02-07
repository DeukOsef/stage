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
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Session;

class ListeObjetsController extends BaseController
{

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function renderListeObjets(Request $request){

        return view('listeObjets');
    }





    public function getEmpruntAll(){
        $demandes = Modell::getEmpruntAll();

        return DataTables::of($demandes)
            ->addColumn('Icone', function ($demandes) {
                return $demandes->type; }
            )->addColumn('action', function ($demandes) {
                if ($demandes->idEmprunt != null && $demandes->dateFin ==null && $demandes->etat ==1){
                    $id="$demandes->idEmprunt";
                    $idObjet="$demandes->idObjet";
                    return '<a href="'.url('rimprimer').'/'.$demandes->idObjet.'" class="btn btn-xs btn-primary "> Imprimer</a>                           <button type="button" onclick="openModalSup('.$idObjet.',event)" id="test" data="'.$idObjet.'" class="btn btn-xs btn-primary " data-toggle="modal" data-target="#modalSup" style="margin-top: 4px"><i class="glyphicon glyphicon-edit"></i>Supprimer</button>                                      <button type="button" onclick="openModal('.$id.',event)" id="test" data="'.$id.'" class="btn btn-xs btn-primary " data-toggle="modal" data-target="#modalRendre" style="margin-top: 4px"><i class="glyphicon glyphicon-edit"></i>Rendre</button>';
                }else{
                    $idObjet="$demandes->idObjet";
                    return '<a href="'.url('rimprimer').'/'.$demandes->idObjet.'" class="btn btn-xs btn-primary "> Imprimer</a> <button type="button" onclick="openModalSup('.$idObjet.',event)" id="test" data="'.$idObjet.'" class="btn btn-xs btn-primary " data-toggle="modal" data-target="#modalSup" style="margin-top: 4px"><i class="glyphicon glyphicon-edit"></i>Supprimer</button>';
                }
                    }
            )->addColumn('site', function ($demandes) {
                return Modell::getNomSite($demandes->site)->nomSite;}
            )->addColumn('secteur', function ($demandes) {
                return Modell::getNomSecteur($demandes->secteur)->nomSecteur;}
            )->editColumn('emprunterPar', function ($demandes){
                return $demandes->emprunterPar;
            })
            ->make(true);
    }

    public function checkManque(){
        $checks = Modell::checkManque();
        $htmll = "";

        foreach ($checks as $check){
            if ($check->nb < $check->limite) {
                   $htmll .= '<div><b>Il ne reste plus que ' . $check->nb . ' unité du type ' . $check->designation . '.</b></div>';
            }
        }
        return $htmll;

    }

    public function info(Request $request){
        $id = $request->get('idObjet');
        $infos = Modell::getInfo($id);
        $historiques = Modell::getHistoriqueById($id);
        $htmlll = "";


        foreach ($infos as $info) {

            if ($info->nomObjet != null) {
                $htmlll .= '<div>Nom Objet : ' . $info->nomObjet . '</div>';
            }
            if ($info->ram != null) {
                $htmlll .= '<div>Ram : ' . $info->ram . '</div>';
            }
            if ($info->marque != null) {
                $htmlll .= '<div>Marque : ' . $info->marque . '</div>';
            }
            if ($info->hddTaille != null) {
                $htmlll .= '<div>Taille du disque dur : ' . $info->marque . '</div>';
            }
            if ($info->hddVitesse != null) {
                $htmlll .= '<div>Vitesse du disque dur : ' . $info->hddVitesse . '</div>';
            }
            if ($info->doubleSim != null) {
                $htmlll .= '<div>Double Sim : ' . $info->doubleSim . '</div>';
            }
            if ($info->cpu != null) {
                $htmlll .= '<div>Processeur : ' . $info->cpu . '</div>';
            }
            if ($info->os != null) {
                $htmlll .= '<div>OS : ' . $info->os . '</div>';
            }
            if ($info->couleur != null) {
                $htmlll .= '<div>Couleur : ' . $info->couleur . '</div>';
            }
            if ($info->laser != null) {
                $htmlll .= '<div>Laser : ' . $info->laser . '</div>';
            }
            if ($info->resolution != null) {
                $htmlll .= '<div>Résolution : ' . $info->resolution . '</div>';
            }
            if ($info->typeChargeur != null) {
                $htmlll .= '<div>Type chargeur : ' . $info->typeChargeur . '</div>';
            }
            if ($info->tempReponse != null) {
                $htmlll .= '<div>Temp de réponse : ' . $info->tempReponse . '</div>';
            }
            if ($info->mecanique != null) {
                $htmlll .= '<div>Mécanique : ' . $info->mecanique . '</div>';
            }
            if ($info->tailleBatterie != null) {
                $htmlll .= '<div>Puissance de la batterie : ' . $info->tailleBatterie . '</div>';
            }
            if ($info->nbPort != null) {
                $htmlll .= '<div>Nombre de ports : ' . $info->nbPort . '</div>';
            }
            if ($info->debit != null) {
                $htmlll .= '<div>Débit : ' . $info->debit . '</div>';
            }
            if ($info->mannageable != null) {
                $htmlll .= '<div>Mannageable : ' . $info->mannageable . '</div>';
            }
            if ($info->categorie != null) {
                $htmlll .= '<div>Catégorie : ' . $info->categorie . '</div>';
            }
            if ($info->nbPrise != null) {
                $htmlll .= '<div>Nombre de prise : ' . $info->nbPrise . '</div>';
            }
            if ($info->parafoudre != null) {
                $htmlll .= '<div>Parafoudre : ' . $info->parafoudre . '</div>';
            }
            if ($info->interrupteur != null) {
                $htmlll .= '<div>Interrupteur : ' . $info->interrupteur . '</div>';
            }
            if ($info->son != null) {
                $htmlll .= '<div>Son : ' . $info->son . '</div>';
            }
            if ($info->titre != null) {
                $htmlll .= '<div>Titre : ' . $info->titre . '</div>';
            }
            if ($info->puissanceProcesseur != null) {
                $htmlll .= '<div>Puissance du processeur : ' . $info->puissanceProcesseur . '</div>';
            }
            if ($info->marqueProcesseur != null) {
                $htmlll .= '<div>Marque du processeur : ' . $info->marqueProcesseur . '</div>';
            }
            if ($info->nomProcesseur != null) {
                $htmlll .= '<div>Nom du processeur : ' . $info->nomProcesseur . '</div>';
            }
            if ($info->apAv != null) {
                $htmlll .= '<div>Appareil photo avant : ' . $info->apAv . '</div>';
            }
            if ($info->apAr != null) {
                $htmlll .= '<div>Appareil photo arrière : ' . $info->apAr . '</div>';
            }
            if ($info->typeSim != null) {
                $htmlll .= '<div>Type sim : ' . $info->typeSim . '</div>';
            }
            if ($info->longueur != null) {
                $htmlll .= '<div>Longueur : ' . $info->longueur . '</div>';
            }
            if ($info->telecommande != null) {
                $htmlll .= '<div>Télécommande : ' . $info->telecommande . '</div>';
            }
            if ($info->focal != null) {
                $htmlll .= '<div>Focal court : ' . $info->focal . '</div>';
            }
            if ($info->descr != null) {
                $htmlll .= '<div>Description : ' . $info->descr . '</div>';
            }
            if ($info->fournisseur != null) {
                $htmlll .= '<div>Créateur : ' . $info->fournisseur . '</div>';
            }
            if ($info->fonctionne != null) {
                $htmlll .= '<div>Fonctionne : ' . $info->fonctionne . '</div>';
            }
            if ($info->vga != null) {
                $htmlll .= '<div>Vga: ' . $info->vga . '</div>';
            }
            if ($info->usb != null) {
                $htmlll .= '<div>Usb : ' . $info->usb . '</div>';
            }
            if ($info->ethernet != null) {
                $htmlll .= '<div>Ethernet : ' . $info->ethernet . '</div>';
            }
            if ($info->hdmi != null) {
                $htmlll .= '<div>Hdmi : ' . $info->hdmi . '</div>';
            }
            $htmlll .= '<br>';
        }

        foreach ($historiques as $historique){
            $htmlll .= '<div>emprunt fait par ' . $historique->prenom .' '. $historique->nom.' du '.$historique->dateDeb .' au '.$historique->dateFin .'</div>';
        }
        return $htmlll;

    }


    public function infoWithCodeB(Request $request){
        $id = $request->get('codeB');
        $infos = Modell::getInfoWithCodeB($id);
        $historiques = Modell::getHistoriqueByNom($id);
        $htmlll = "";


        foreach ($infos as $info) {

            if ($info->nomObjet != null) {
                $htmlll .= '<div>Nom Objet : ' . $info->nomObjet . '</div>';
            }
            if ($info->ram != null) {
                $htmlll .= '<div>Ram : ' . $info->ram . '</div>';
            }
            if ($info->marque != null) {
                $htmlll .= '<div>Marque : ' . $info->marque . '</div>';
            }
            if ($info->hddTaille != null) {
                $htmlll .= '<div>Taille du disque dur : ' . $info->marque . '</div>';
            }
            if ($info->hddVitesse != null) {
                $htmlll .= '<div>Vitesse du disque dur : ' . $info->hddVitesse . '</div>';
            }
            if ($info->doubleSim != null) {
                $htmlll .= '<div>Double Sim : ' . $info->doubleSim . '</div>';
            }
            if ($info->cpu != null) {
                $htmlll .= '<div>Processeur : ' . $info->cpu . '</div>';
            }
            if ($info->os != null) {
                $htmlll .= '<div>OS : ' . $info->os . '</div>';
            }
            if ($info->couleur != null) {
                $htmlll .= '<div>Couleur : ' . $info->couleur . '</div>';
            }
            if ($info->laser != null) {
                $htmlll .= '<div>Laser : ' . $info->laser . '</div>';
            }
            if ($info->resolution != null) {
                $htmlll .= '<div>Résolution : ' . $info->resolution . '</div>';
            }
            if ($info->typeChargeur != null) {
                $htmlll .= '<div>Type chargeur : ' . $info->typeChargeur . '</div>';
            }
            if ($info->tempReponse != null) {
                $htmlll .= '<div>Temp de réponse : ' . $info->tempReponse . '</div>';
            }
            if ($info->mecanique != null) {
                $htmlll .= '<div>Mécanique : ' . $info->mecanique . '</div>';
            }
            if ($info->tailleBatterie != null) {
                $htmlll .= '<div>Puissance de la batterie : ' . $info->tailleBatterie . '</div>';
            }
            if ($info->nbPort != null) {
                $htmlll .= '<div>Nombre de ports : ' . $info->nbPort . '</div>';
            }
            if ($info->debit != null) {
                $htmlll .= '<div>Débit : ' . $info->debit . '</div>';
            }
            if ($info->mannageable != null) {
                $htmlll .= '<div>Mannageable : ' . $info->mannageable . '</div>';
            }
            if ($info->categorie != null) {
                $htmlll .= '<div>Catégorie : ' . $info->categorie . '</div>';
            }
            if ($info->nbPrise != null) {
                $htmlll .= '<div>Nombre de prise : ' . $info->nbPrise . '</div>';
            }
            if ($info->parafoudre != null) {
                $htmlll .= '<div>Parafoudre : ' . $info->parafoudre . '</div>';
            }
            if ($info->interrupteur != null) {
                $htmlll .= '<div>Interrupteur : ' . $info->interrupteur . '</div>';
            }
            if ($info->son != null) {
                $htmlll .= '<div>Son : ' . $info->son . '</div>';
            }
            if ($info->titre != null) {
                $htmlll .= '<div>Titre : ' . $info->titre . '</div>';
            }
            if ($info->puissanceProcesseur != null) {
                $htmlll .= '<div>Puissance du processeur : ' . $info->puissanceProcesseur . '</div>';
            }
            if ($info->marqueProcesseur != null) {
                $htmlll .= '<div>Marque du processeur : ' . $info->marqueProcesseur . '</div>';
            }
            if ($info->nomProcesseur != null) {
                $htmlll .= '<div>Nom du processeur : ' . $info->nomProcesseur . '</div>';
            }
            if ($info->apAv != null) {
                $htmlll .= '<div>Appareil photo avant : ' . $info->apAv . '</div>';
            }
            if ($info->apAr != null) {
                $htmlll .= '<div>Appareil photo arrière : ' . $info->apAr . '</div>';
            }
            if ($info->typeSim != null) {
                $htmlll .= '<div>Type sim : ' . $info->typeSim . '</div>';
            }
            if ($info->longueur != null) {
                $htmlll .= '<div>Longueur : ' . $info->longueur . '</div>';
            }
            if ($info->telecommande != null) {
                $htmlll .= '<div>Télécommande : ' . $info->telecommande . '</div>';
            }
            if ($info->focal != null) {
                $htmlll .= '<div>Focal court : ' . $info->focal . '</div>';
            }
            if ($info->descr != null) {
                $htmlll .= '<div>Description : ' . $info->descr . '</div>';
            }
            if ($info->fournisseur != null) {
                $htmlll .= '<div>Créateur : ' . $info->fournisseur . '</div>';
            }
            if ($info->fonctionne != null) {
                $htmlll .= '<div>Fonctionne : ' . $info->fonctionne . '</div>';
            }
            if ($info->vga != null) {
                $htmlll .= '<div>Vga: ' . $info->vga . '</div>';
            }
            if ($info->usb != null) {
                $htmlll .= '<div>Usb : ' . $info->usb . '</div>';
            }
            if ($info->ethernet != null) {
                $htmlll .= '<div>Ethernet : ' . $info->ethernet . '</div>';
            }
            if ($info->hdmi != null) {
                $htmlll .= '<div>Hdmi : ' . $info->hdmi . '</div>';
            }
        }
        return $htmlll;

    }


    public function rimprimer($id){
        $dataNom = Modell::getNomObjet($id);
        $pdf = PDF::loadView('codeBarre1',compact('dataNom'));
        $name = "etiquette" . date("Y-m-d-H-i") . ".pdf";
        return $pdf->download($name);

    }

    public function supprimer(Request $request){
        $id = $request->get('idObjet');
        Modell::deleteObjet($id);

        return  redirect('/accueil')->with('demenv', 'Objet supprimé');;

    }
}
