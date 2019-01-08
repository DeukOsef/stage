<?php

namespace App\Http\Controllers;

use App\Client;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use DB;
use Illuminate\Support\Facades\Session;

class LoginController extends BaseController
{

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function renderLogin(Request $request){
        return view('login');
    }

    public function connexion(Request $request){

        $email = $request->get('email');
        $password = $request->get('password');

        $user = Client::getUser($email,$password);

        if ($user && $user->admin == 1){
            Session::put('client',Client::getName($email));
            return redirect('/admin');

        }else if ($user && $user->admin == 0){
            Session::put('client',Client::getName($email));
            return redirect('/user');

        }else{
            return redirect('/')->with('errPwd','Adresse mail ou mot de passe eronné');
        }

    }

}
