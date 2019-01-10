<?php
namespace App;

use DB;
use URL;
use Session;
use Illuminate\Database\Eloquent\Model;
use Mail;

class Modell extends Model
{

    public static function getTableUser()
    {
        return 'user';
    }

    public static function getTableEmprunt()
    {
        return 'emprunt';
    }

    public static function getTableType()
    {
        return 'type';
    }

    public static function getTableObjet()
    {
        return 'objet';
    }

    public static function getUser($login,$password){

        $user = DB::table(self::getTableUser())
            ->where('login', '=', $login)
            ->where('mdp', '=', $password)
            ->first();

        return $user;
    }

    public static function getName($login){
        $nom = DB::table(self::getTableUser())
            ->select('nom','prenom','idUser','login')
            ->where('login', '=', $login)
            ->first();
        return $nom;
    }

    public static function getEmprunt($idUser){
        $demande =DB::table(self::getTableEmprunt())
            ->select('*')
            ->where('idUser', '=', $idUser)
            ->get();
        return $demande;
    }

    public static function getType(){
        $type =DB::table(self::getTableType())
            ->select('*')
            ->get();
        return $type;
    }

    public static function getObjet($numType){
        $objet =DB::table(self::getTableObjet())
            ->select('*')
            ->where('type', '=', $numType)
            ->get();
        return $objet;
    }

}