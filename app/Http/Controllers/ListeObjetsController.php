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
                    return '<a href="'.url('rimprimer').'/'.$demandes->idObjet.'" class="btn btn-xs btn-primary "> Imprimer</a> <button type="button" onclick="openModalSup('.$idObjet.',event)" id="test" data="'.$idObjet.'" class="btn btn-xs btn-primary " data-toggle="modal" data-target="#modalSup" style="margin-top: 4px"><i class="glyphicon glyphicon-edit"></i>Supprimer</button>                           <button type="button" onclick="openModalSup('.$idObjet.',event)" id="test" data="'.$idObjet.'" class="btn btn-xs btn-primary " data-toggle="modal" data-target="#modalEmprunter" style="margin-top: 4px"><i class="glyphicon glyphicon-edit"></i>Emprunter</button>';
                }
                    }
            )->addColumn('site', function ($demandes) {
                return Modell::getNomSite($demandes->site)->nomSite;}
            )->addColumn('secteur', function ($demandes) {
                return Modell::getNomSecteur($demandes->secteur)->nomSecteur;}
            )->editColumn('emprunterPar', function ($demandes){
                return $demandes->emprunterPar;
            })->editColumn('armoire', function ($demandes){
                $tab = array();
                $tab['emprunterPar'] = $demandes->emprunterPar;
                $tab['armoire'] = $demandes->armoire;
                return $tab;
            })->editColumn('rayonnage', function ($demandes){
                $tab = array();
                $tab['emprunterPar'] = $demandes->emprunterPar;
                $tab['rayonnage'] = $demandes->rayonnage;
                return $tab;
            })
            ->make(true);
    }

    public function checkManque(){
        $checks = Modell::checkManque();
        $htmll = "";

        foreach ($checks as $check){
            if ($check->nb < $check->limite) {
                   $htmll .= '<div style="font-size: 20px ;"><b>&nbsp;&nbsp;Il ne reste plus que ' . $check->nb .' '. $check->designation . '(s) en stock.</b></div>';
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
                $htmlll .= '<div style="font-size: 20px ;"><b>Nom Objet :</b> ' . $info->nomObjet . '</div>';
            }
            if ($info->ram != null) {
                $htmlll .= '<div style="font-size: 20px ;"><b>Ram :</b> ' . $info->ram . '</div>';
            }
            if ($info->marque != null) {
                $htmlll .= '<div style="font-size: 20px ;"><b>Marque : </b>' . $info->marque . '</div>';
            }
            if ($info->hddTaille != null) {
                $htmlll .= '<div style="font-size: 20px ;"><b>Taille du disque dur : </b>' . $info->marque . '</div>';
            }
            if ($info->hddVitesse != null) {
                $htmlll .= '<div style="font-size: 20px ;"><b>Vitesse du disque dur : </b>' . $info->hddVitesse . '</div>';
            }
            if ($info->doubleSim != null) {
                $htmlll .= '<div style="font-size: 20px ;"><b>Double Sim : </b>' . $info->doubleSim . '</div>';
            }
            if ($info->cpu != null) {
                $htmlll .= '<div style="font-size: 20px ;"><b>Processeur :</b> ' . $info->cpu . '</div>';
            }
            if ($info->os != null) {
                $htmlll .= '<div style="font-size: 20px ;"><b>OS :</b> ' . $info->os . '</div>';
            }
            if ($info->couleur != null) {
                $htmlll .= '<div style="font-size: 20px ;"><b>Couleur : </b>' . $info->couleur . '</div>';
            }
            if ($info->laser != null) {
                $htmlll .= '<div style="font-size: 20px ;"><b>Laser :</b> ' . $info->laser . '</div>';
            }
            if ($info->resolution != null) {
                $htmlll .= '<div style="font-size: 20px ;"><b>Résolution : </b>' . $info->resolution . '</div>';
            }
            if ($info->typeChargeur != null) {
                $htmlll .= '<div style="font-size: 20px ;"><b>Type chargeur :</b> ' . $info->typeChargeur . '</div>';
            }
            if ($info->tempReponse != null) {
                $htmlll .= '<div style="font-size: 20px ;"><b>Temp de réponse :</b> ' . $info->tempReponse . '</div>';
            }
            if ($info->mecanique != null) {
                $htmlll .= '<div style="font-size: 20px ;"><b>Mécanique : </b>' . $info->mecanique . '</div>';
            }
            if ($info->tailleBatterie != null) {
                $htmlll .= '<div style="font-size: 20px ;"><b>Puissance de la batterie :</b> ' . $info->tailleBatterie . '</div>';
            }
            if ($info->nbPort != null) {
                $htmlll .= '<div style="font-size: 20px ;"><b>Nombre de ports :</b> ' . $info->nbPort . '</div>';
            }
            if ($info->debit != null) {
                $htmlll .= '<div style="font-size: 20px ;"><b>Débit :</b> ' . $info->debit . '</div>';
            }
            if ($info->armoire != null) {
                $htmlll .= '<div style="font-size: 20px ;"><b>Armoire :</b> ' . $info->armoire . '</div>';
            }
            if ($info->rayonnage != null) {
                $htmlll .= '<div style="font-size: 20px ;"><b>Rayonnage :</b> ' . $info->rayonnage . '</div>';
            }
            if ($info->mannageable != null) {
                $htmlll .= '<div style="font-size: 20px ;"><b>Mannageable : </b>' . $info->mannageable . '</div>';
            }
            if ($info->categorie != null) {
                $htmlll .= '<div style="font-size: 20px ;"><b>Catégorie :</b> ' . $info->categorie . '</div>';
            }
            if ($info->nbPrise != null) {
                $htmlll .= '<div style="font-size: 20px ;"><b>Nombre de prise :</b> ' . $info->nbPrise . '</div>';
            }
            if ($info->parafoudre != null) {
                $htmlll .= '<div style="font-size: 20px ;"><b>Parafoudre :</b> ' . $info->parafoudre . '</div>';
            }
            if ($info->interrupteur != null) {
                $htmlll .= '<div style="font-size: 20px ;"><b>Interrupteur :</b> ' . $info->interrupteur . '</div>';
            }
            if ($info->son != null) {
                $htmlll .= '<div style="font-size: 20px ;"><b>Son :</b> ' . $info->son . '</div>';
            }
            if ($info->titre != null) {
                $htmlll .= '<div style="font-size: 20px ;"><b>Titre :</b> ' . $info->titre . '</div>';
            }
            if ($info->puissanceProcesseur != null) {
                $htmlll .= '<div style="font-size: 20px ;"><b>Puissance du processeur :</b> ' . $info->puissanceProcesseur . '</div>';
            }
            if ($info->marqueProcesseur != null) {
                $htmlll .= '<div style="font-size: 20px ;"><b>Marque du processeur :</b> ' . $info->marqueProcesseur . '</div>';
            }
            if ($info->nomProcesseur != null) {
                $htmlll .= '<div style="font-size: 20px ;"><b>Nom du processeur :</b> ' . $info->nomProcesseur . '</div>';
            }
            if ($info->apAv != null) {
                $htmlll .= '<div style="font-size: 20px ;"><b>Appareil photo avant : </b>' . $info->apAv . '</div>';
            }
            if ($info->apAr != null) {
                $htmlll .= '<div style="font-size: 20px ;"><b>Appareil photo arrière :</b> ' . $info->apAr . '</div>';
            }
            if ($info->typeSim != null) {
                $htmlll .= '<div style="font-size: 20px ;"><b>Type sim :</b> ' . $info->typeSim . '</div>';
            }
            if ($info->longueur != null) {
                $htmlll .= '<div style="font-size: 20px ;"><b>Longueur :</b> ' . $info->longueur . '</div>';
            }
            if ($info->telecommande != null) {
                $htmlll .= '<div style="font-size: 20px ;"><b>Télécommande :</b> ' . $info->telecommande . '</div>';
            }
            if ($info->focal != null) {
                $htmlll .= '<div style="font-size: 20px ;"><b>Focal court :</b> ' . $info->focal . '</div>';
            }
            if ($info->descr != null) {
                $htmlll .= '<div style="font-size: 20px ;"><b>Description :</b> ' . $info->descr . '</div>';
            }
            if ($info->fournisseur != null) {
                $htmlll .= '<div style="font-size: 20px ;"><b>Créateur :</b> ' . $info->fournisseur . '</div>';
            }
            if ($info->fonctionne != null) {
                $htmlll .= '<div style="font-size: 20px ;"><b>Fonctionne :</b> ' . $info->fonctionne . '</div>';
            }
            if ($info->vga != null) {
                $htmlll .= '<div style="font-size: 20px ;"><b>Vga</b>: ' . $info->vga . '</div>';
            }
            if ($info->usb != null) {
                $htmlll .= '<div style="font-size: 20px ;"><b>Usb :</b>' . $info->usb . '</div>';
            }
            if ($info->site != null) {
                $htmlll .= '<div style="font-size: 20px ;"><b>Site :</b> ' . $info->site. '</div>';
            }
            if ($info->secteur != null) {
                $htmlll .= '<div style="font-size: 20px ;"><b>Secteur :</b> ' . $info->secteur. '</div>';
            }
            if ($info->ethernet != null) {
                $htmlll .= '<div style="font-size: 20px ;"><b>Ethernet : </b>' . $info->ethernet . '</div>';
            }
            if ($info->hdmi != null) {
                $htmlll .= '<div style="font-size: 20px ;"><b>Hdmi : </b>' . $info->hdmi . '</div>';
            }
            $htmlll .= '<br>';
            $htmlll .= '<h2 class="modal-title">Historique de l\'objet  </h2>';
            $htmlll .= '<br>';
        }

        foreach ($historiques as $historique){
            $htmlll .= '<div style="font-size: 20px ;">Emprunt fait par ' . $historique->prenom .' '. $historique->nom.' du '.$historique->dateDeb .' au '.$historique->dateFin .'</div>';

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
                $htmlll .= '<div style="font-size: 20px ;"><b>Nom Objet :</b> ' . $info->nomObjet . '</div>';
            }
            if ($info->ram != null) {
                $htmlll .= '<div style="font-size: 20px ;"><b>Ram :</b> ' . $info->ram . '</div>';
            }
            if ($info->marque != null) {
                $htmlll .= '<div style="font-size: 20px ;"><b>Marque : </b>' . $info->marque . '</div>';
            }
            if ($info->hddTaille != null) {
                $htmlll .= '<div style="font-size: 20px ;"><b>Taille du disque dur : </b>' . $info->marque . '</div>';
            }
            if ($info->hddVitesse != null) {
                $htmlll .= '<div style="font-size: 20px ;"><b>Vitesse du disque dur : </b>' . $info->hddVitesse . '</div>';
            }
            if ($info->doubleSim != null) {
                $htmlll .= '<div style="font-size: 20px ;"><b>Double Sim : </b>' . $info->doubleSim . '</div>';
            }
            if ($info->cpu != null) {
                $htmlll .= '<div style="font-size: 20px ;"><b>Processeur :</b> ' . $info->cpu . '</div>';
            }
            if ($info->os != null) {
                $htmlll .= '<div style="font-size: 20px ;"><b>OS :</b> ' . $info->os . '</div>';
            }
            if ($info->couleur != null) {
                $htmlll .= '<div style="font-size: 20px ;"><b>Couleur : </b>' . $info->couleur . '</div>';
            }
            if ($info->laser != null) {
                $htmlll .= '<div style="font-size: 20px ;"><b>Laser :</b> ' . $info->laser . '</div>';
            }
            if ($info->armoire != null) {
                $htmlll .= '<div style="font-size: 20px ;"><b>Armoire :</b> ' . $info->armoire . '</div>';
            }
            if ($info->rayonnage != null) {
                $htmlll .= '<div style="font-size: 20px ;"><b>Rayonnage :</b> ' . $info->rayonnage . '</div>';
            }
            if ($info->resolution != null) {
                $htmlll .= '<div style="font-size: 20px ;"><b>Résolution : </b>' . $info->resolution . '</div>';
            }
            if ($info->typeChargeur != null) {
                $htmlll .= '<div style="font-size: 20px ;"><b>Type chargeur :</b> ' . $info->typeChargeur . '</div>';
            }
            if ($info->tempReponse != null) {
                $htmlll .= '<div style="font-size: 20px ;"><b>Temp de réponse :</b> ' . $info->tempReponse . '</div>';
            }
            if ($info->mecanique != null) {
                $htmlll .= '<div style="font-size: 20px ;"><b>Mécanique : </b>' . $info->mecanique . '</div>';
            }
            if ($info->tailleBatterie != null) {
                $htmlll .= '<div style="font-size: 20px ;"><b>Puissance de la batterie :</b> ' . $info->tailleBatterie . '</div>';
            }
            if ($info->nbPort != null) {
                $htmlll .= '<div style="font-size: 20px ;"><b>Nombre de ports :</b> ' . $info->nbPort . '</div>';
            }
            if ($info->debit != null) {
                $htmlll .= '<div style="font-size: 20px ;"><b>Débit :</b> ' . $info->debit . '</div>';
            }
            if ($info->mannageable != null) {
                $htmlll .= '<div style="font-size: 20px ;"><b>Mannageable : </b>' . $info->mannageable . '</div>';
            }
            if ($info->categorie != null) {
                $htmlll .= '<div style="font-size: 20px ;"><b>Catégorie :</b> ' . $info->categorie . '</div>';
            }
            if ($info->nbPrise != null) {
                $htmlll .= '<div style="font-size: 20px ;"><b>Nombre de prise :</b> ' . $info->nbPrise . '</div>';
            }
            if ($info->parafoudre != null) {
                $htmlll .= '<div style="font-size: 20px ;"><b>Parafoudre :</b> ' . $info->parafoudre . '</div>';
            }
            if ($info->interrupteur != null) {
                $htmlll .= '<div style="font-size: 20px ;"><b>Interrupteur :</b> ' . $info->interrupteur . '</div>';
            }
            if ($info->son != null) {
                $htmlll .= '<div style="font-size: 20px ;"><b>Son :</b> ' . $info->son . '</div>';
            }
            if ($info->titre != null) {
                $htmlll .= '<div style="font-size: 20px ;"><b>Titre :</b> ' . $info->titre . '</div>';
            }
            if ($info->site != null) {
                $htmlll .= '<div style="font-size: 20px ;"><b>Site :</b> ' . $info->site. '</div>';
            }
            if ($info->secteur != null) {
                $htmlll .= '<div style="font-size: 20px ;"><b>Secteur :</b> ' . $info->secteur. '</div>';
            }
            if ($info->puissanceProcesseur != null) {
                $htmlll .= '<div style="font-size: 20px ;"><b>Puissance du processeur :</b> ' . $info->puissanceProcesseur . '</div>';
            }
            if ($info->marqueProcesseur != null) {
                $htmlll .= '<div style="font-size: 20px ;"><b>Marque du processeur :</b> ' . $info->marqueProcesseur . '</div>';
            }
            if ($info->nomProcesseur != null) {
                $htmlll .= '<div style="font-size: 20px ;"><b>Nom du processeur :</b> ' . $info->nomProcesseur . '</div>';
            }
            if ($info->apAv != null) {
                $htmlll .= '<div style="font-size: 20px ;"><b>Appareil photo avant : </b>' . $info->apAv . '</div>';
            }
            if ($info->apAr != null) {
                $htmlll .= '<div style="font-size: 20px ;"><b>Appareil photo arrière :</b> ' . $info->apAr . '</div>';
            }
            if ($info->typeSim != null) {
                $htmlll .= '<div style="font-size: 20px ;"><b>Type sim :</b> ' . $info->typeSim . '</div>';
            }
            if ($info->longueur != null) {
                $htmlll .= '<div style="font-size: 20px ;"><b>Longueur :</b> ' . $info->longueur . '</div>';
            }
            if ($info->telecommande != null) {
                $htmlll .= '<div style="font-size: 20px ;"><b>Télécommande :</b> ' . $info->telecommande . '</div>';
            }
            if ($info->focal != null) {
                $htmlll .= '<div style="font-size: 20px ;"><b>Focal court :</b> ' . $info->focal . '</div>';
            }
            if ($info->descr != null) {
                $htmlll .= '<div style="font-size: 20px ;"><b>Description :</b> ' . $info->descr . '</div>';
            }
            if ($info->fournisseur != null) {
                $htmlll .= '<div style="font-size: 20px ;"><b>Créateur :</b> ' . $info->fournisseur . '</div>';
            }
            if ($info->fonctionne != null) {
                $htmlll .= '<div style="font-size: 20px ;"><b>Fonctionne :</b> ' . $info->fonctionne . '</div>';
            }
            if ($info->vga != null) {
                $htmlll .= '<div style="font-size: 20px ;"><b>Vga</b>: ' . $info->vga . '</div>';
            }
            if ($info->usb != null) {
                $htmlll .= '<div style="font-size: 20px ;"><b>Usb :</b>' . $info->usb . '</div>';
            }
            if ($info->ethernet != null) {
                $htmlll .= '<div style="font-size: 20px ;"><b>Ethernet : </b>' . $info->ethernet . '</div>';
            }
            if ($info->hdmi != null) {
                $htmlll .= '<div style="font-size: 20px ;"><b>Hdmi : </b>' . $info->hdmi . '</div>';
            }
            $htmlll .= '<br>';
            $htmlll .= '<h2 class="modal-title">Historique de l\'objet </h2>';
            $htmlll .= '<br>';
        }

        foreach ($historiques as $historique){
            $htmlll .= '<div style="font-size: 20px ;">Emprunt fait par ' . $historique->prenom .' '. $historique->nom.' du '.$historique->dateDeb .' au '.$historique->dateFin .'</div>';

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

        return  redirect('/accueil')->with('demenv', 'OBJET SUPPRIME');;

    }

    public function emprunter(Request $request){
        $idObjet = $request->get('idObjet');
        $idUser = $request->get('idUser');
        $dateDeb = $request->get('dateDeb');
        $nom = Modell::getNomById($idUser)->nom;
        $prenom = Modell::getPreomById($idUser)->prenom;
        Modell::emprunt($idUser,$nom,$prenom,$dateDeb,$idObjet);

        return  redirect('/accueil')->with('emprunt', 'OBJET EMPRUNTE');

    }
}
