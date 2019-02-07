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

class AccueilController extends BaseController
{

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function renderAccueil(Request $request){
        $demandes = Modell::getEmpruntAll();
        return view('accueil')->with('demandes',$demandes);
    }

    public function renderAccueilBis(Request $request){
        return redirect('/accueil')->with('emprunt', 'Votre emprunt a été accordé');
    }

}
