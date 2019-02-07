<?php

namespace App\Http\Controllers;

use App\Modell;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Barryvdh\DomPDF\Facade as PDF;
use DB;
use DataTables;
use Image;
use Response;
use Illuminate\Support\Facades\File;


class CreationObjetController extends BaseController
{

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function renderCreationObjet(Request $request)
    {

        // Récupération des informations pour le formulaire
        $types = Modell::getType();
        $sites =Modell::getSite();
        $secteurs =Modell::getSecteurs();

        // Envoi du formulaire
        return view('CreationObjet')->with('types', $types)->with('sites', $sites)->with('secteurs', $secteurs);


    }


    public function creer(Request $request)
    {
        $numb = $request->get('numb');



        if ($request->type == 1) {
            for ($i = 0; $i < $numb; $i++) {
                $dataInsertDemandeCp = array();
                $dataNom = array();
                $dataInsertDemandeCp['fournisseur'] = $request->get('fournisseur');
                $dataInsertDemandeCp['secteur'] = $request->get('secteur');
                $dataInsertDemandeCp['nomObjet'] = Modell::getNomType(1)->nomType . "-" . Modell::getNombreType(1)->numero;
                $dataInsertDemandeCp['type'] = 1;
                $dataInsertDemandeCp['etat'] = 0;
                $dataInsertDemandeCp['marque'] = $request->get('marque_uc');


                $dataInsertDemandeCp['vga'] = $request->get('vga_uc');
                $dataInsertDemandeCp['usb'] = $request->get('usb');
                $dataInsertDemandeCp['ethernet'] = $request->get('ethernet');
                $dataInsertDemandeCp['hdmi'] = $request->get('hdmi');


                $dataInsertDemandeCp['ram'] = $request->get('ram_uc');
                $dataInsertDemandeCp['hddTaille'] = $request->get('hddTaille_uc');
                $dataInsertDemandeCp['hddVitesse'] = $request->get('hddVitesse_uc');
                $dataInsertDemandeCp['os'] = $request->get('OS_uc');
                $dataInsertDemandeCp['cpu'] = $request->get('cpu_uc');
                $dataInsertDemandeCp['cgConnectique'] = $request->get('cgConn_uc');
                $dataInsertDemandeCp['puissanceProcesseur'] = $request->get('puiProc_uc');
                $dataInsertDemandeCp['marqueProcesseur'] = $request->get('marqueProc_uc');
                $dataInsertDemandeCp['nomProcesseur'] = $request->get('nomProc_uc');
                $dataInsertDemandeCp['codeDep'] = "OR01400561";
                $dataInsertDemandeCp['site'] = $request->get('site');
                $dataInsertDemandeCp['armoire'] = $request->get('armoire');
                $dataInsertDemandeCp['rayonnage'] = $request->get('rayonnage');

                if ($request->file('facture') != null) {
                    $nomObjet = Modell::getNomType(1)->nomType . "-" . Modell::getNombreType(1)->numero;
                    $pdf = $request->file('facture');
                    $pdfname = 'facture-' . $nomObjet . '.pdf';
                    $pdf->move('storage/facture', $pdfname);
                }




                Modell::creer($dataInsertDemandeCp);
                Modell::updateNumero(1);
                $dataNom[] = $dataInsertDemandeCp['nomObjet'];
            }
            $pdf = PDF::loadView('codeBarre',compact('dataNom'));
            $name = "etiquette" . date("Y-m-d-H-i") . ".pdf";




            if ($numb == 0) {
                return redirect('/accueil')->with('demenv', 'Votre objet n\'a pas été créé');
            }else {
                if ($request->get('etiq') == 1) {
                    //var_dump($dataNom);die;
                    //return view('codeBarre')->with('dataNom',$dataNom);
                    return $pdf->download($name);
                } else {
                    return redirect('/accueil')->with('emprunt', 'Vos objets ont été créés');
                }
            }

        } else if ($request->type == 2) {
            for ($i = 0; $i < $numb; $i++) {
                $dataInsertDemandeCp = array();
                $dataInsertDemandeCp['fournisseur'] = $request->get('fournisseur');
                $dataInsertDemandeCp['secteur'] = $request->get('secteur');
                $dataInsertDemandeCp['nomObjet'] = Modell::getNomType(2)->nomType . "-" . Modell::getNombreType(2)->numero;
                $dataInsertDemandeCp['type'] = 2;
                $dataInsertDemandeCp['etat'] = 0;
                $dataInsertDemandeCp['marque'] = $request->get('marque_imp');
                $dataInsertDemandeCp['vga'] = $request->get('vga');
                $dataInsertDemandeCp['usb'] = $request->get('usb');
                $dataInsertDemandeCp['ethernet'] = $request->get('usb');
                $dataInsertDemandeCp['hdmi'] = $request->get('hdmi');
                $dataInsertDemandeCp['couleur'] = $request->get('couleur_imp');
                $dataInsertDemandeCp['laser'] = $request->get('laser_imp');
                $dataInsertDemandeCp['connectique'] = $request->get('conn_imp');
                $dataInsertDemandeCp['site'] = $request->get('site');
                $dataInsertDemandeCp['armoire'] = $request->get('armoire');
                $dataInsertDemandeCp['rayonnage'] = $request->get('rayonnage');

                if ($request->file('facture') != null) {
                    $nomObjet = Modell::getNomType(1)->nomType . "-" . Modell::getNombreType(1)->numero;
                    $pdf = $request->file('facture');
                    $pdfname = 'facture-' . $nomObjet . '.pdf';
                    $pdf->move('storage/facture', $pdfname);
                }

                Modell::creer($dataInsertDemandeCp);
                Modell::updateNumero(2);
                $dataNom[] = $dataInsertDemandeCp['nomObjet'];
            }
            $pdf = PDF::loadView('codeBarre',compact('dataNom'));
            $name = "etiquette" . date("Y-m-d-H-i") . ".pdf";




            if ($numb == 0) {
                return redirect('/accueil')->with('demenv', 'Votre objet n\'a pas été créé');
            }else {
                if ($request->get('etiq') == 1) {
                    //var_dump($dataNom);die;
                    //return view('codeBarre')->with('dataNom',$dataNom);
                    return $pdf->download($name);
                } else {
                    return redirect('/accueil')->with('emprunt', 'Vos objets ont été créés');
                }
            }

        } else if ($request->type == 3) {

            for ($i = 0; $i < $numb; $i++) {
                $dataInsertDemandeCp = array();
                $dataInsertDemandeCp['fournisseur'] = $request->get('fournisseur');
                $dataInsertDemandeCp['secteur'] = $request->get('secteur');
                $dataInsertDemandeCp['nomObjet'] = Modell::getNomType(3)->nomType . "-" . Modell::getNombreType(3)->numero;
                $dataInsertDemandeCp['type'] = 3;
                $dataInsertDemandeCp['etat'] = 0;
                $dataInsertDemandeCp['marque'] = $request->get('marque_telp');
                $dataInsertDemandeCp['ram'] = $request->get('ram_telp');
                $dataInsertDemandeCp['hddTaille'] = $request->get('hddTaille_telp');
                $dataInsertDemandeCp['resolution'] = $request->get('resolution_telp');
                $dataInsertDemandeCp['ap'] = $request->get('Ap_telp');
                $dataInsertDemandeCp['typeChargeur'] = $request->get('typeChargeur_telp');
                $nomObjet = Modell::getNomType(1)->nomType . "-" . Modell::getNombreType(1)->numero;
                $pdf = $request->file('facture');
                $pdfname = 'facture-'.$nomObjet.'.pdf';
                $pdf->move('storage/facture',$pdfname);
                if ($request->get('sim_telp')==0) {
                    $dataInsertDemandeCp['doubleSim'] = "non";
                }else{
                    $dataInsertDemandeCp['doubleSim'] = "oui";
                }
                $dataInsertDemandeCp['os'] = $request->get('OS_telp');
                $dataInsertDemandeCp['typeSim'] = $request->get('typeSim_telp');
                $dataInsertDemandeCp['codeDep'] = "OR01400561";
                $dataInsertDemandeCp['site'] = $request->get('site');
                if ($request->get('ApAr_telp')==0){
                    $dataInsertDemandeCp['apAr'] = "non";
                }else{
                    $dataInsertDemandeCp['apAr'] = "oui";
                }

                if ($request->get('ApAv_telp')==0){
                    $dataInsertDemandeCp['apAv'] = "non";
                }else{
                    $dataInsertDemandeCp['apAv'] = "oui";
                }
                $dataInsertDemandeCp['armoire'] = $request->get('armoire');
                $dataInsertDemandeCp['rayonnage'] = $request->get('rayonnage');

                Modell::creer($dataInsertDemandeCp);
                Modell::updateNumero(3);
                $dataNom[] = $dataInsertDemandeCp['nomObjet'];
            }
            $pdf = PDF::loadView('codeBarre',compact('dataNom'));
            $name = "etiquette" . date("Y-m-d-H-i") . ".pdf";




            if ($numb == 0) {
                return redirect('/accueil')->with('demenv', 'Votre objet n\'a pas été créé');
            }else {
                if ($request->get('etiq') == 1) {
                    //var_dump($dataNom);die;
                    //return view('codeBarre')->with('dataNom',$dataNom);
                    return $pdf->download($name);
                } else {
                    return redirect('/accueil')->with('emprunt', 'Vos objets ont été créés');
                }
            }

        } else if ($request->type == 4) {

            for ($i = 0; $i < $numb; $i++) {
                $dataInsertDemandeCp = array();
                $dataInsertDemandeCp['fournisseur'] = $request->get('fournisseur');
                $dataInsertDemandeCp['secteur'] = $request->get('secteur');
                $dataInsertDemandeCp['nomObjet'] = Modell::getNomType(4)->nomType . "-" . Modell::getNombreType(4)->numero;
                $dataInsertDemandeCp['type'] = 4;
                $dataInsertDemandeCp['etat'] = 0;
                $dataInsertDemandeCp['marque'] = $request->get('marque_tbt');
                $dataInsertDemandeCp['ram'] = $request->get('ram_tbt');
                $dataInsertDemandeCp['vga'] = $request->get('vga');
                $dataInsertDemandeCp['usb'] = $request->get('usb');
                $dataInsertDemandeCp['ethernet'] = $request->get('usb');
                $dataInsertDemandeCp['hdmi'] = $request->get('hdmi');
                $dataInsertDemandeCp['hddTaille'] = $request->get('hddTaille_tbt');
                $dataInsertDemandeCp['resolution'] = $request->get('resolution_tbt');
                $dataInsertDemandeCp['ap'] = $request->get('Ap_tbt');
                $dataInsertDemandeCp['typeChargeur'] = $request->get('typeChargeur_tbt');
                $dataInsertDemandeCp['os'] = $request->get('OS_tbt');
                $dataInsertDemandeCp['connectique'] = $request->get('Conn_telp');
                $dataInsertDemandeCp['site'] = $request->get('site');
                $dataInsertDemandeCp['armoire'] = $request->get('armoire');
                $dataInsertDemandeCp['rayonnage'] = $request->get('rayonnage');
                if ($request->file('facture') != null) {
                    $nomObjet = Modell::getNomType(1)->nomType . "-" . Modell::getNombreType(1)->numero;
                    $pdf = $request->file('facture');
                    $pdfname = 'facture-' . $nomObjet . '.pdf';
                    $pdf->move('storage/facture', $pdfname);
                }

                if ($request->get('ApAr_tbt')==0){
                    $dataInsertDemandeCp['apAr'] = "non";
                }else{
                    $dataInsertDemandeCp['apAr'] = "oui";
                }

                if ($request->get('ApAv_tbt')==0){
                    $dataInsertDemandeCp['apAv'] = "non";
                }else{
                    $dataInsertDemandeCp['apAv'] = "oui";
                }
                Modell::creer($dataInsertDemandeCp);
                Modell::updateNumero(4);
                $dataNom[] = $dataInsertDemandeCp['nomObjet'];
            }
            $pdf = PDF::loadView('codeBarre',compact('dataNom'));
            $name = "etiquette" . date("Y-m-d-H-i") . ".pdf";




            if ($numb == 0) {
                return redirect('/accueil')->with('demenv', 'Votre objet n\'a pas été créé');
            }else {
                if ($request->get('etiq') == 1) {
                    //var_dump($dataNom);die;
                    //return view('codeBarre')->with('dataNom',$dataNom);
                    return $pdf->download($name);
                } else {
                    return redirect('/accueil')->with('emprunt', 'Vos objets ont été créés');
                }
            }

        } else if ($request->type == 5) {
            for ($i = 0; $i < $numb; $i++) {
                $dataInsertDemandeCp = array();
                $dataInsertDemandeCp['fournisseur'] = $request->get('fournisseur');
                $dataInsertDemandeCp['secteur'] = $request->get('secteur');
                $dataInsertDemandeCp['nomObjet'] = Modell::getNomType(5)->nomType . "-" . Modell::getNombreType(5)->numero;
                $dataInsertDemandeCp['type'] = 5;
                $dataInsertDemandeCp['etat'] = 0;
                $dataInsertDemandeCp['marque'] = $request->get('marque_ecr');
                $dataInsertDemandeCp['resolution'] = $request->get('resolution_ecr');
                $dataInsertDemandeCp['vga'] = $request->get('vga');
                $dataInsertDemandeCp['usb'] = $request->get('usb');
                $dataInsertDemandeCp['ethernet'] = $request->get('usb');
                $dataInsertDemandeCp['hdmi'] = $request->get('hdmi');
                $dataInsertDemandeCp['tempReponse'] = $request->get('tdr_ecr');
                $dataInsertDemandeCp['connectique'] = $request->get('conn_ecr');
                $dataInsertDemandeCp['site'] = $request->get('site');
                $dataInsertDemandeCp['armoire'] = $request->get('armoire');
                $dataInsertDemandeCp['rayonnage'] = $request->get('rayonnage');
                if ($request->file('facture') != null) {
                    $nomObjet = Modell::getNomType(1)->nomType . "-" . Modell::getNombreType(1)->numero;
                    $pdf = $request->file('facture');
                    $pdfname = 'facture-' . $nomObjet . '.pdf';
                    $pdf->move('storage/facture', $pdfname);
                }

                Modell::creer($dataInsertDemandeCp);
                Modell::updateNumero(5);
                $dataNom[] = $dataInsertDemandeCp['nomObjet'];
            }
            $pdf = PDF::loadView('codeBarre',compact('dataNom'));
            $name = "etiquette" . date("Y-m-d-H-i") . ".pdf";




            if ($numb == 0) {
                return redirect('/accueil')->with('demenv', 'Votre objet n\'a pas été créé');
            }else {
                if ($request->get('etiq') == 1) {
                    //var_dump($dataNom);die;
                    //return view('codeBarre')->with('dataNom',$dataNom);
                    return $pdf->download($name);
                } else {
                    return redirect('/accueil')->with('emprunt', 'Vos objets ont été créés');
                }
            }

        } else if ($request->type == 6) {
            for ($i = 0; $i < $numb; $i++) {
                $dataInsertDemandeCp = array();
                $dataInsertDemandeCp['fournisseur'] = $request->get('fournisseur');
                $dataInsertDemandeCp['secteur'] = $request->get('secteur');
                $dataInsertDemandeCp['nomObjet'] = Modell::getNomType(6)->nomType . "-" . Modell::getNombreType(6)->numero;
                $dataInsertDemandeCp['type'] = 6;
                $dataInsertDemandeCp['vga'] = $request->get('vga');
                $dataInsertDemandeCp['usb'] = $request->get('usb');
                $dataInsertDemandeCp['ethernet'] = $request->get('usb');
                $dataInsertDemandeCp['hdmi'] = $request->get('hdmi');
                $dataInsertDemandeCp['etat'] = 0;
                $dataInsertDemandeCp['marque'] = $request->get('marque_cla');
                if ($request->get('meca_cla')==0){
                $dataInsertDemandeCp['mecanique'] = "non";
            }else{
                $dataInsertDemandeCp['mecanique'] = "oui";
            }
                $dataInsertDemandeCp['connectique'] = $request->get('conn_cla');
                $dataInsertDemandeCp['site'] = $request->get('site');
                $dataInsertDemandeCp['armoire'] = $request->get('armoire');
                $dataInsertDemandeCp['rayonnage'] = $request->get('rayonnage');
                if ($request->file('facture') != null) {
                    $nomObjet = Modell::getNomType(1)->nomType . "-" . Modell::getNombreType(1)->numero;
                    $pdf = $request->file('facture');
                    $pdfname = 'facture-' . $nomObjet . '.pdf';
                    $pdf->move('storage/facture', $pdfname);
                }
                Modell::creer($dataInsertDemandeCp);
                Modell::updateNumero(1);
                $dataNom[] = $dataInsertDemandeCp['nomObjet'];
            }
            $pdf = PDF::loadView('codeBarre',compact('dataNom'));
            $name = "etiquette" . date("Y-m-d-H-i") . ".pdf";




            if ($numb == 0) {
                return redirect('/accueil')->with('demenv', 'Votre objet n\'a pas été créé');
            }else {
                if ($request->get('etiq') == 1) {
                    //var_dump($dataNom);die;
                    //return view('codeBarre')->with('dataNom',$dataNom);
                    return $pdf->download($name);
                } else {
                    return redirect('/accueil')->with('emprunt', 'Vos objets ont été créés');
                }
            }

        } else if ($request->type == 7) {
            for ($i = 0; $i < $numb; $i++) {
                $dataInsertDemandeCp = array();
                $dataInsertDemandeCp['fournisseur'] = $request->get('fournisseur');
                $dataInsertDemandeCp['secteur'] = $request->get('secteur');
                $dataInsertDemandeCp['nomObjet'] = Modell::getNomType(7)->nomType . "-" . Modell::getNombreType(7)->numero;
                $dataInsertDemandeCp['type'] = 7;
                $dataInsertDemandeCp['etat'] = 0;
                $dataInsertDemandeCp['marque'] = $request->get('marque_pcp');
                $dataInsertDemandeCp['vga'] = $request->get('vga');
                $dataInsertDemandeCp['usb'] = $request->get('usb');
                $dataInsertDemandeCp['ethernet'] = $request->get('usb');
                $dataInsertDemandeCp['hdmi'] = $request->get('hdmi');
                $dataInsertDemandeCp['ram'] = $request->get('ram_pcp');
                $dataInsertDemandeCp['hddTaille'] = $request->get('hddTaille_pcp');
                $dataInsertDemandeCp['hddVitesse'] = $request->get('hddVitesse_pcp');
                $dataInsertDemandeCp['os'] = $request->get('OS_pcp');
                $dataInsertDemandeCp['cpu'] = $request->get('cpu_pcp');
                $dataInsertDemandeCp['cgConnectique'] = $request->get('cgConn_pcp');
                $dataInsertDemandeCp['resolution'] = $request->get('resolution_pcp');
                $dataInsertDemandeCp['tailleBatterie'] = $request->get('tailleBatterie_pcp');
                $dataInsertDemandeCp['puissanceProcesseur'] = $request->get('puiProc_pcp');
                $dataInsertDemandeCp['marqueProcesseur'] = $request->get('marqueProc_pcp');
                $dataInsertDemandeCp['nomProcesseur'] = $request->get('nomProc_pcp');
                $dataInsertDemandeCp['site'] = $request->get('site');
                $dataInsertDemandeCp['armoire'] = $request->get('armoire');
                $dataInsertDemandeCp['rayonnage'] = $request->get('rayonnage');
                if ($request->file('facture') != null) {
                    $nomObjet = Modell::getNomType(1)->nomType . "-" . Modell::getNombreType(1)->numero;
                    $pdf = $request->file('facture');
                    $pdfname = 'facture-' . $nomObjet . '.pdf';
                    $pdf->move('storage/facture', $pdfname);
                }
                Modell::creer($dataInsertDemandeCp);
                Modell::updateNumero(7);
                $dataNom[] = $dataInsertDemandeCp['nomObjet'];
            }
            $pdf = PDF::loadView('codeBarre',compact('dataNom'));
            $name = "etiquette" . date("Y-m-d-H-i") . ".pdf";




            if ($numb == 0) {
                return redirect('/accueil')->with('demenv', 'Votre objet n\'a pas été créé');
            }else {
                if ($request->get('etiq') == 1) {
                    //var_dump($dataNom);die;
                    //return view('codeBarre')->with('dataNom',$dataNom);
                    return $pdf->download($name);
                } else {
                    return redirect('/accueil')->with('emprunt', 'Vos objets ont été créés');
                }
            }

        } else if ($request->type == 8) {
            for ($i = 0; $i < $numb; $i++) {
                $dataInsertDemandeCp = array();
                $dataInsertDemandeCp['fournisseur'] = $request->get('fournisseur');
                $dataInsertDemandeCp['secteur'] = $request->get('secteur');
                $dataInsertDemandeCp['nomObjet'] = Modell::getNomType(8)->nomType . "-" . Modell::getNombreType(8)->numero;
                $dataInsertDemandeCp['type'] = 8;
                $dataInsertDemandeCp['etat'] = 0;
                $dataInsertDemandeCp['nbPort'] = $request->get('nbPort_swt');
                $dataInsertDemandeCp['debit'] = $request->get('debit_swt');
                if ($request->get('mann_swt')==0){
                    $dataInsertDemandeCp['mannageable'] = "non";
                }else{
                    $dataInsertDemandeCp['mannageable'] = "oui";
                }
                $dataInsertDemandeCp['site'] = $request->get('site');
                $dataInsertDemandeCp['armoire'] = $request->get('armoire');
                $dataInsertDemandeCp['rayonnage'] = $request->get('rayonnage');
                if ($request->file('facture') != null) {
                    $nomObjet = Modell::getNomType(1)->nomType . "-" . Modell::getNombreType(1)->numero;
                    $pdf = $request->file('facture');
                    $pdfname = 'facture-' . $nomObjet . '.pdf';
                    $pdf->move('storage/facture', $pdfname);
                }
                Modell::creer($dataInsertDemandeCp);
                Modell::updateNumero(8);
                $dataNom[] = $dataInsertDemandeCp['nomObjet'];
            }
            $pdf = PDF::loadView('codeBarre',compact('dataNom'));
            $name = "etiquette" . date("Y-m-d-H-i") . ".pdf";




            if ($numb == 0) {
                return redirect('/accueil')->with('demenv', 'Votre objet n\'a pas été créé');
            }else {
                if ($request->get('etiq') == 1) {
                    //var_dump($dataNom);die;
                    //return view('codeBarre')->with('dataNom',$dataNom);
                    return $pdf->download($name);
                } else {
                    return redirect('/accueil')->with('emprunt', 'Vos objets ont été créés');
                }
            }

        } else if ($request->type == 9) {
            for ($i = 0; $i < $numb; $i++) {
                $dataInsertDemandeCp = array();
                $dataInsertDemandeCp['fournisseur'] = $request->get('fournisseur');
                $dataInsertDemandeCp['secteur'] = $request->get('secteur');
                $dataInsertDemandeCp['nomObjet'] = Modell::getNomType(9)->nomType . "-" . Modell::getNombreType(9)->numero;
                $dataInsertDemandeCp['type'] = 9;
                $dataInsertDemandeCp['etat'] = 0;
                $dataInsertDemandeCp['marque'] = $request->get('marque_cr');
                $dataInsertDemandeCp['categorie'] = $request->get('cat_cr');
                $dataInsertDemandeCp['longueur'] = $request->get('longueur_cr');
                $dataInsertDemandeCp['site'] = $request->get('site');
                $dataInsertDemandeCp['armoire'] = $request->get('armoire');
                $dataInsertDemandeCp['rayonnage'] = $request->get('rayonnage');
                if ($request->file('facture') != null) {
                    $nomObjet = Modell::getNomType(1)->nomType . "-" . Modell::getNombreType(1)->numero;
                    $pdf = $request->file('facture');
                    $pdfname = 'facture-' . $nomObjet . '.pdf';
                    $pdf->move('storage/facture', $pdfname);
                }
                Modell::creer($dataInsertDemandeCp);
                Modell::updateNumero(9);
                $dataNom[] = $dataInsertDemandeCp['nomObjet'];
            }
            $pdf = PDF::loadView('codeBarre',compact('dataNom'));
            $name = "etiquette" . date("Y-m-d-H-i") . ".pdf";




            if ($numb == 0) {
                return redirect('/accueil')->with('demenv', 'Votre objet n\'a pas été créé');
            }else {
                if ($request->get('etiq') == 1) {
                    //var_dump($dataNom);die;
                    //return view('codeBarre')->with('dataNom',$dataNom);
                    return $pdf->download($name);
                } else {
                    return redirect('/accueil')->with('emprunt', 'Vos objets ont été créés');
                }
            }

        } else if ($request->type == 10) {
            for ($i = 0; $i < $numb; $i++) {
                $dataInsertDemandeCp = array();
                $dataInsertDemandeCp['fournisseur'] = $request->get('fournisseur');
                $dataInsertDemandeCp['secteur'] = $request->get('secteur');
                $dataInsertDemandeCp['nomObjet'] = Modell::getNomType(10)->nomType . "-" . Modell::getNombreType(10)->numero;
                $dataInsertDemandeCp['type'] = 10;
                $dataInsertDemandeCp['etat'] = 0;
                $dataInsertDemandeCp['marque'] = $request->get('marque_mult');
                $dataInsertDemandeCp['nbPrise'] = $request->get('nbPrise_mult');
                $dataInsertDemandeCp['longueur'] = $request->get('longueur_mult');
                if ($request->get('parafoudre_mult')==0) {
                    $dataInsertDemandeCp['parafoudre'] = "non";
                }else {
                    $dataInsertDemandeCp['parafoudre'] = "oui";
                }

                if ($request->get('inter_mult')==0) {
                    $dataInsertDemandeCp['interrupteur'] = "non";
                }else {
                    $dataInsertDemandeCp['interrupteur'] = "oui";
                }
                $dataInsertDemandeCp['site'] = $request->get('site');
                $dataInsertDemandeCp['armoire'] = $request->get('armoire');
                $dataInsertDemandeCp['rayonnage'] = $request->get('rayonnage');
                if ($request->file('facture') != null) {
                    $nomObjet = Modell::getNomType(1)->nomType . "-" . Modell::getNombreType(1)->numero;
                    $pdf = $request->file('facture');
                    $pdfname = 'facture-' . $nomObjet . '.pdf';
                    $pdf->move('storage/facture', $pdfname);
                }
                Modell::creer($dataInsertDemandeCp);
                Modell::updateNumero(10);
                $dataNom[] = $dataInsertDemandeCp['nomObjet'];
            }
            $pdf = PDF::loadView('codeBarre',compact('dataNom'));
            $name = "etiquette" . date("Y-m-d-H-i") . ".pdf";




            if ($numb == 0) {
                return redirect('/accueil')->with('demenv', 'Votre objet n\'a pas été créé');
            }else {
                if ($request->get('etiq') == 1) {
                    //var_dump($dataNom);die;
                    //return view('codeBarre')->with('dataNom',$dataNom);
                    return $pdf->download($name);
                } else {
                    return redirect('/accueil')->with('emprunt', 'Vos objets ont été créés');
                }
            }

        } else if ($request->type == 11) {
            for ($i = 0; $i < $numb; $i++) {
                $dataInsertDemandeCp = array();
                $dataInsertDemandeCp['fournisseur'] = $request->get('fournisseur');
                $dataInsertDemandeCp['secteur'] = $request->get('secteur');
                $dataInsertDemandeCp['nomObjet'] = Modell::getNomType(11)->nomType . "-" . Modell::getNombreType(11)->numero;
                $dataInsertDemandeCp['type'] = 11;
                $dataInsertDemandeCp['vga'] = $request->get('vga');
                $dataInsertDemandeCp['usb'] = $request->get('usb');
                $dataInsertDemandeCp['ethernet'] = $request->get('usb');
                $dataInsertDemandeCp['hdmi'] = $request->get('hdmi');
                $dataInsertDemandeCp['etat'] = 0;
                $dataInsertDemandeCp['marque'] = $request->get('marque_vidp');
                $dataInsertDemandeCp['connectique'] = $request->get('conn_vidp');
                $dataInsertDemandeCp['resolution'] = $request->get('resolution_swt');
                $dataInsertDemandeCp['son'] = $request->get('son_vidp');
                if ($request->get('telec_vidp')==0) {
                    $dataInsertDemandeCp['telecommande'] = "non";
                }else {
                    $dataInsertDemandeCp['telecommande'] = "oui";
                }
                if ($request->get('focal_vidp')==0) {
                    $dataInsertDemandeCp['focal'] = "non";
                }else {
                    $dataInsertDemandeCp['focal'] = "oui";
                }
                $dataInsertDemandeCp['site'] = $request->get('site');
                $dataInsertDemandeCp['armoire'] = $request->get('armoire');
                $dataInsertDemandeCp['rayonnage'] = $request->get('rayonnage');
                if ($request->file('facture') != null) {
                    $nomObjet = Modell::getNomType(1)->nomType . "-" . Modell::getNombreType(1)->numero;
                    $pdf = $request->file('facture');
                    $pdfname = 'facture-' . $nomObjet . '.pdf';
                    $pdf->move('storage/facture', $pdfname);
                }
                Modell::creer($dataInsertDemandeCp);
                Modell::updateNumero(11);
                $dataNom[] = $dataInsertDemandeCp['nomObjet'];
            }
            $pdf = PDF::loadView('codeBarre',compact('dataNom'));
            $name = "etiquette" . date("Y-m-d-H-i") . ".pdf";




            if ($numb == 0) {
                return redirect('/accueil')->with('demenv', 'Votre objet n\'a pas été créé');
            }else {
                if ($request->get('etiq') == 1) {
                    //var_dump($dataNom);die;
                    //return view('codeBarre')->with('dataNom',$dataNom);
                    return $pdf->download($name);
                } else {
                    return redirect('/accueil')->with('emprunt', 'Vos objets ont été créés');
                }
            }

        } else if ($request->type == 12) {
            for ($i = 0; $i < $numb; $i++) {
                $dataInsertDemandeCp = array();
                $dataInsertDemandeCp['fournisseur'] = $request->get('fournisseur');
                $dataInsertDemandeCp['secteur'] = $request->get('secteur');
                $dataInsertDemandeCp['nomObjet'] = Modell::getNomType(12)->nomType . "-" . Modell::getNombreType(12)->numero;
                $dataInsertDemandeCp['type'] = 12;
                $dataInsertDemandeCp['etat'] = 0;
                $dataInsertDemandeCp['titre'] = $request->get('titre_atr');
                $dataInsertDemandeCp['descr'] = $request->get('desc_atr');
                $dataInsertDemandeCp['site'] = $request->get('site');
                $dataInsertDemandeCp['armoire'] = $request->get('armoire');
                $dataInsertDemandeCp['rayonnage'] = $request->get('rayonnage');
                if ($request->file('facture') != null) {
                    $nomObjet = Modell::getNomType(1)->nomType . "-" . Modell::getNombreType(1)->numero;
                    $pdf = $request->file('facture');
                    $pdfname = 'facture-' . $nomObjet . '.pdf';
                    $pdf->move('storage/facture', $pdfname);
                }
                Modell::creer($dataInsertDemandeCp);
                Modell::updateNumero(12);
                $dataNom[] = $dataInsertDemandeCp['nomObjet'];
            }
            $pdf = PDF::loadView('codeBarre',compact('dataNom'));
            $name = "etiquette" . date("Y-m-d-H-i") . ".pdf";




            if ($numb == 0) {
                return redirect('/accueil')->with('demenv', 'Votre objet n\'a pas été créé');
            }else {
                if ($request->get('etiq') == 1) {
                    //var_dump($dataNom);die;
                    //return view('codeBarre')->with('dataNom',$dataNom);
                    return $pdf->download($name);
                } else {
                    return redirect('/accueil')->with('emprunt', 'Vos objets ont été crés');
                }
            }

        } else {
            return redirect('/accueil')->with('demenv','Votre objet n\'a pas été créé');
        }
    }

    public function dlform($dataNom)
    {

        $pdf = PDF::loadView('codeBarre',compact('dataNom'));
        $name = "etiquette" . date("Y-m-d-H-i") . ".pdf";
        return $pdf->download($name);

    }
}
