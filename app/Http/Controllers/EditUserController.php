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

class EditUserController extends BaseController
{

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function renderEditUser(Request $request,$id){
        $user = Modell::getUserById($id);
        return view('editUser')->with('user',$user);
    }


    public function editUser(Request $request){
        $idUser = $request->get('idUser');
        $profil = $request->get('profil');
        $poste = $request->get('poste');
        $num = $request->get('num');
        Modell::updateUser($idUser,$profil,$poste,$num);
        return  redirect('/utilisateur')->with('emprunt', 'UTILISATEUR MODIFIE');
    }



}
