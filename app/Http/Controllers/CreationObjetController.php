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

class CreationObjetController extends BaseController
{

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function renderCreationObjet(Request $request)
    {

        // Récupération des informations pour le formulaire
        $types = Modell::getType();

        // Envoi du formulaire
        return view('CreationObjet')->with('types', $types);


    }


    public function creer(Request $request)
    {
        $numb = $request->get('numb');


        if ($request->type == 1) {
            $dataInsertDemandeCp = array();
            for ($i =0 ; $i< $numb ; $i++) {
                $dataInsertDemandeCp['nomObjet'] = Modell::getNomType(1)->nomType . "-" . Modell::getNombreType(1)->numero;
                $dataInsertDemandeCp['type'] = 1;
                $dataInsertDemandeCp['etat'] = 0;
                $dataInsertDemandeCp['marque'] = $request->get('marque_uc');
                $dataInsertDemandeCp['ram'] = $request->get('ram_uc');
                $dataInsertDemandeCp['hddTaille'] = $request->get('hddTaille_uc');
                $dataInsertDemandeCp['hddVitesse'] = $request->get('hddVitesse_uc');
                $dataInsertDemandeCp['os'] = $request->get('OS_uc');
                $dataInsertDemandeCp['cpu'] = $request->get('cpu_uc');
                $dataInsertDemandeCp['cgConnectique'] = $request->get('cgConn_uc');
                Modell::creer($dataInsertDemandeCp);
                Modell::updateNumero(1);
            }
            return redirect('/accueil')->with('demenv', 'Objet créé');

        } else if ($request->type == 2) {
            for ($i =0 ; $i< $numb ; $i++) {
                $dataInsertDemandeCp = array();
                $dataInsertDemandeCp['nomObjet'] = Modell::getNomType(2)->nomType . "-" . Modell::getNombreType(2)->numero;
                $dataInsertDemandeCp['type'] = 2;
                $dataInsertDemandeCp['etat'] = 0;
                $dataInsertDemandeCp['marque'] = $request->get('marque_imp');
                $dataInsertDemandeCp['couleur'] = $request->get('couleur_imp');
                $dataInsertDemandeCp['laser'] = $request->get('laser_imp');
                $dataInsertDemandeCp['connectique'] = $request->get('conn_imp');

                Modell::creer($dataInsertDemandeCp);
                Modell::updateNumero(2);
            }
            return redirect('/accueil')->with('demenv', 'Objet créé');

        } else if ($request->type == 3) {
            for ($i =0 ; $i< $numb ; $i++) {
                $dataInsertDemandeCp = array();
                $dataInsertDemandeCp['nomObjet'] = Modell::getNomType(3)->nomType . "-" . Modell::getNombreType(3)->numero;
                $dataInsertDemandeCp['type'] = 3;
                $dataInsertDemandeCp['etat'] = 0;
                $dataInsertDemandeCp['marque'] = $request->get('marque_telp');
                $dataInsertDemandeCp['ram'] = $request->get('ram_telp');
                $dataInsertDemandeCp['hddTaille'] = $request->get('hddTaille_telp');
                $dataInsertDemandeCp['resolution'] = $request->get('resolution_telp');
                $dataInsertDemandeCp['ap'] = $request->get('Ap_telp');
                $dataInsertDemandeCp['typeChargeur'] = $request->get('typeChargeur_telp');
                $dataInsertDemandeCp['doubleSim'] = $request->get('sim_telp');
                $dataInsertDemandeCp['os'] = $request->get('OS_telp');
                Modell::creer($dataInsertDemandeCp);
                Modell::updateNumero(3);
            }
            return redirect('/accueil')->with('demenv', 'Objet créé');

        } else if ($request->type == 4) {
            for ($i =0 ; $i< $numb ; $i++) {
                $dataInsertDemandeCp = array();
                $dataInsertDemandeCp['nomObjet'] = Modell::getNomType(4)->nomType . "-" . Modell::getNombreType(4)->numero;
                $dataInsertDemandeCp['type'] = 4;
                $dataInsertDemandeCp['etat'] = 0;
                $dataInsertDemandeCp['marque'] = $request->get('marque_tbt');
                $dataInsertDemandeCp['ram'] = $request->get('ram_tbt');
                $dataInsertDemandeCp['hddTaille'] = $request->get('hddTaille_tbt');
                $dataInsertDemandeCp['resolution'] = $request->get('resolution_tbt');
                $dataInsertDemandeCp['ap'] = $request->get('Ap_tbt');
                $dataInsertDemandeCp['typeChargeur'] = $request->get('typeChargeur_tbt');
                $dataInsertDemandeCp['os'] = $request->get('OS_tbt');
                $dataInsertDemandeCp['connectique'] = $request->get('Conn_telp');
                Modell::creer($dataInsertDemandeCp);
                Modell::updateNumero(4);
            }
            return redirect('/accueil')->with('demenv', 'Objet créé');

        } else if ($request->type == 5) {
            for ($i =0 ; $i< $numb ; $i++) {
                $dataInsertDemandeCp = array();
                $dataInsertDemandeCp['nomObjet'] = Modell::getNomType(5)->nomType . "-" . Modell::getNombreType(5)->numero;
                $dataInsertDemandeCp['type'] = 5;
                $dataInsertDemandeCp['etat'] = 0;
                $dataInsertDemandeCp['marque'] = $request->get('marque_ecr');
                $dataInsertDemandeCp['resolution'] = $request->get('resolution_ecr');
                $dataInsertDemandeCp['tempReponse'] = $request->get('tdr_ecr');
                $dataInsertDemandeCp['connectique'] = $request->get('conn_ecr');
                Modell::creer($dataInsertDemandeCp);
                Modell::updateNumero(5);
            }
            return redirect('/accueil')->with('demenv', 'Objet créé');

        } else if ($request->type == 6) {
            for ($i =0 ; $i< $numb ; $i++) {
                $dataInsertDemandeCp = array();
                $dataInsertDemandeCp['nomObjet'] = Modell::getNomType(6)->nomType . "-" . Modell::getNombreType(6)->numero;
                $dataInsertDemandeCp['type'] = 6;
                $dataInsertDemandeCp['etat'] = 0;
                $dataInsertDemandeCp['marque'] = $request->get('marque_cla');
                $dataInsertDemandeCp['mecanique'] = $request->get('meca_cla');
                $dataInsertDemandeCp['connectique'] = $request->get('conn_cla');
                Modell::creer($dataInsertDemandeCp);
                Modell::updateNumero(1);
            }
            return redirect('/accueil')->with('demenv', 'Objet créé');

        } else if ($request->type == 7) {
            for ($i =0 ; $i< $numb ; $i++) {
                $dataInsertDemandeCp = array();
                $dataInsertDemandeCp['nomObjet'] = Modell::getNomType(7)->nomType . "-" . Modell::getNombreType(7)->numero;
                $dataInsertDemandeCp['type'] = 7;
                $dataInsertDemandeCp['etat'] = 0;
                $dataInsertDemandeCp['marque'] = $request->get('marque_pcp');
                $dataInsertDemandeCp['ram'] = $request->get('ram_pcp');
                $dataInsertDemandeCp['hddTaille'] = $request->get('hddTaille_pcp');
                $dataInsertDemandeCp['hddVitesse'] = $request->get('hddVitesse_pcp');
                $dataInsertDemandeCp['os'] = $request->get('OS_pcp');
                $dataInsertDemandeCp['cpu'] = $request->get('cpu_pcp');
                $dataInsertDemandeCp['cgConnectique'] = $request->get('cgConn_pcp');
                $dataInsertDemandeCp['resolution'] = $request->get('resolution_pcp');
                $dataInsertDemandeCp['tailleBatterie'] = $request->get('tailleBatterie_pcp');
                Modell::creer($dataInsertDemandeCp);
                Modell::updateNumero(7);
            }
            return redirect('/accueil')->with('demenv', 'Objet créé');

        } else if ($request->type == 8) {
            for ($i =0 ; $i< $numb ; $i++) {
                $dataInsertDemandeCp = array();
                $dataInsertDemandeCp['nomObjet'] = Modell::getNomType(8)->nomType . "-" . Modell::getNombreType(8)->numero;
                $dataInsertDemandeCp['type'] = 8;
                $dataInsertDemandeCp['etat'] = 0;
                $dataInsertDemandeCp['typePort'] = $request->get('typePort_swt');
                $dataInsertDemandeCp['nbPort'] = $request->get('nbPort_swt');
                $dataInsertDemandeCp['debit'] = $request->get('debit_swt');
                $dataInsertDemandeCp['mannageable'] = $request->get('mann_swt');
                Modell::creer($dataInsertDemandeCp);
                Modell::updateNumero(8);
            }
            return redirect('/accueil')->with('demenv', 'Objet créé');

        } else if ($request->type == 9) {
            for ($i =0 ; $i< $numb ; $i++) {
                $dataInsertDemandeCp = array();
                $dataInsertDemandeCp['nomObjet'] = Modell::getNomType(9)->nomType . "-" . Modell::getNombreType(9)->numero;
                $dataInsertDemandeCp['type'] = 9;
                $dataInsertDemandeCp['etat'] = 0;
                $dataInsertDemandeCp['marque'] = $request->get('marque_cr');
                $dataInsertDemandeCp['categorie'] = $request->get('cat_cr');
                Modell::creer($dataInsertDemandeCp);
                Modell::updateNumero(9);
            }
            return redirect('/accueil')->with('demenv', 'Objet créé');

        } else if ($request->type == 10) {
            for ($i =0 ; $i< $numb ; $i++) {
                $dataInsertDemandeCp = array();
                $dataInsertDemandeCp['nomObjet'] = Modell::getNomType(10)->nomType . "-" . Modell::getNombreType(10)->numero;
                $dataInsertDemandeCp['type'] = 10;
                $dataInsertDemandeCp['etat'] = 0;
                $dataInsertDemandeCp['marque'] = $request->get('marque_mult');
                $dataInsertDemandeCp['nbPrise'] = $request->get('nbPrise_mult');
                $dataInsertDemandeCp['parafoudre'] = $request->get('parafoudre_mult');
                $dataInsertDemandeCp['interrupteur'] = $request->get('inter_mult');
                Modell::creer($dataInsertDemandeCp);
                Modell::updateNumero(10);
            }
            return redirect('/accueil')->with('demenv', 'Objet créé');

        } else if ($request->type == 11) {
            for ($i =0 ; $i< $numb ; $i++) {
                $dataInsertDemandeCp = array();
                $dataInsertDemandeCp['nomObjet'] = Modell::getNomType(11)->nomType . "-" . Modell::getNombreType(11)->numero;
                $dataInsertDemandeCp['type'] = 11;
                $dataInsertDemandeCp['etat'] = 0;
                $dataInsertDemandeCp['marque'] = $request->get('marque_vidp');
                $dataInsertDemandeCp['connectique'] = $request->get('conn_vidp');
                $dataInsertDemandeCp['resolution'] = $request->get('resolution_swt');
                $dataInsertDemandeCp['son'] = $request->get('son_vidp');
                $dataInsertDemandeCp['decibel'] = $request->get('decibel_vidp');
                Modell::creer($dataInsertDemandeCp);
                Modell::updateNumero(11);
            }
            return redirect('/accueil')->with('demenv', 'Objet créé');
        } else if ($request->type == 12) {
            for ($i =0 ; $i< $numb ; $i++) {
                $dataInsertDemandeCp = array();
                $dataInsertDemandeCp['nomObjet'] = Modell::getNomType(12)->nomType . "-" . Modell::getNombreType(12)->numero;
                $dataInsertDemandeCp['type'] = 12;
                $dataInsertDemandeCp['etat'] = 0;
                $dataInsertDemandeCp['autre'] = $request->get('autre_atr');
                Modell::creer($dataInsertDemandeCp);
                Modell::updateNumero(12);
            }
            return redirect('/accueil')->with('demenv', 'Objet créé');

        } else {
            return redirect('/accueil')->with('demenv', 'Objet non créé');
        }
    }

}