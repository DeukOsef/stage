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
        return view('accueil');
    }





    public function getEmprunt(){
        $demandes = Modell::getEmprunt(session()->get('client')->idUser);

        return DataTables::of($demandes)
            ->make(true);
    }

}