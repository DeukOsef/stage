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

class MesEmpruntsController extends BaseController
{

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function renderMesEmprunts(Request $request){
        return view('MesEmprunts');
    }





    public function getEmprunt(){
        $demandes = Modell::getEmprunt(session()->get('client')->idUser);

        return DataTables::of($demandes)

            ->addColumn('etat', function ($demandes) {
            if($demandes->etat== 1){
                return 'emprunté';
            }else if ($demandes->etat == 2){
                return 'Rendu';
            }
        })
            ->addColumn('action', function ($demandes) {
                if($demandes->etat== 1){
                    return '<a href="'.url('rendreEmprunt').'/'.$demandes->idEmprunt.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Rendre</a>';}
            })
            ->make(true);
    }

    public function rendreEmprunt($id){
        Modell::rendreEmprunt($id);


        return redirect('/mesEmprunts')->with('deldem','L\'emprunt est terminé, veuuillez ranger l\'objet a son emplacement');
    }


}
