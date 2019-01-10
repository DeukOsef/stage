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

    public static function emprunt($idUser, $nom, $prenom, $dateDeb, $objet){
        $dataInsertDemandeCp = array();
        $dataInsertDemandeCp['idUser'] = $idUser;
        $dataInsertDemandeCp['nom'] =$nom;
        $dataInsertDemandeCp['prenom'] = $prenom;
        $dataInsertDemandeCp['dateDeb'] = $dateDeb;
        $dataInsertDemandeCp['idObjet'] = $objet;
        $dataInsertDemandeCp['nomObjet']=Modell::getNomType($objet)->nomType.'-'.$objet;

        DB::table('emprunt')->insert($dataInsertDemandeCp);



        return 1;
    }

    public static function getNomType($idType){
        $type =DB::table(self::getTableType())
            ->select('nomType')
            ->where('numType', '=', $idType)
            ->first();
        return $type;
    }
}