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

class ListeObjetsController extends BaseController
{

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function renderListeObjets(Request $request){
        return view('listeObjets');
    }





    public function getEmpruntAll(){
        $demandes = Modell::getEmpruntAll();

        return DataTables::of($demandes)
            ->addColumn('action', function ($demandes) {
                    return '<a href="'.url('rimprimer').'/'.$demandes->idObjet.'" class="btn btn-xs btn-primary "> Imprimer</a>';}
            )
            ->make(true);
    }

}
