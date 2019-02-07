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
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginController extends BaseController
{

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function renderLogin(Request $request){
        return view('login');
    }

    public function connexion(Request $request){

        $login = $request->get('login');
        $password = $request->get('password');

        $user = Modell::getUser($login,$password);
        $passd=$user->mdp;

        if (Hash::check($password,$passd)){
            Session::put('client',Modell::getName($login));
            return redirect('/accueil');
        }else{
            return redirect('/')->with('errPwd','Login ou mot de passe eronné');
        }

    }

    public function logout(){

        Session::forget('client');
        redirect('/');
        return 'ok';
    }

}
