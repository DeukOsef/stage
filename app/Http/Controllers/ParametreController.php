<?php

namespace App\Http\Controllers;

use App\Model;
use App\Modell;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use DB;
use Illuminate\Support\Facades\Session;

class ParametreController extends BaseController
{

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function renderParametre(Request $request){
        $limite1 = Modell::getLimite(1);
        $limite2 = Modell::getLimite(2);
        $limite3 = Modell::getLimite(3);
        $limite4 = Modell::getLimite(4);
        $limite5 = Modell::getLimite(5);
        $limite6 = Modell::getLimite(6);
        $limite7 = Modell::getLimite(7);
        $limite8 = Modell::getLimite(8);
        $limite9 = Modell::getLimite(9);
        $limite10 = Modell::getLimite(10);
        $limite11 = Modell::getLimite(11);
        $limite12 = Modell::getLimite(12);
        return view('parametre')->with('limite1',$limite1)->with('limite2',$limite2)->with('limite3',$limite3)->with('limite4',$limite4)->with('limite5',$limite5)->with('limite6',$limite6)->with('limite7',$limite7)->with('limite8',$limite8)->with('limite9',$limite9)->with('limite10',$limite10)->with('limite11',$limite11)->with('limite12',$limite12);
    }

    public function parametrage(Request $request){

        $limite1= $request->get('limite1');
        $type= 1;
        Modell::updateLimite($limite1,$type);
        $limite2= $request->get('limite2');
        $type= 2;
        Modell::updateLimite($limite2,$type);
        $limite3= $request->get('limite3');
        $type= 3;
        Modell::updateLimite($limite3,$type);
        $limite4= $request->get('limite4');
        $type= 4;
        Modell::updateLimite($limite4,$type);
        $limite5= $request->get('limite5');
        $type= 5;
        Modell::updateLimite($limite5,$type);
        $limite6= $request->get('limite6');
        $type= 6;
        Modell::updateLimite($limite6,$type);
        $limite7= $request->get('limite7');
        $type= 7;
        Modell::updateLimite($limite7,$type);
        $limite8= $request->get('limite8');
        $type= 8;
        Modell::updateLimite($limite8,$type);
        $limite9= $request->get('limite9');
        $type= 9;
        Modell::updateLimite($limite9,$type);
        $limite10= $request->get('limite10');
        $type= 10;
        Modell::updateLimite($limite10,$type);
        $limite11= $request->get('limite11');
        $type= 11;
        Modell::updateLimite($limite11,$type);
        $limite12 = $request->get('limite12');
        $type= 12;
        Modell::updateLimite($limite12,$type);




            return redirect('/accueil')->with('errPwd','Paramètres mis a jour');

    }

}
