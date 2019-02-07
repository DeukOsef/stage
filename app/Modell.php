<?php
namespace App;

use DB;
use Illuminate\Support\Facades\Hash;
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
    public static function getTableHistorique()
    {
        return 'historique';
    }

    public static function getTableSite()
    {
        return 'site';
    }

    public static function getTableType()
    {
        return 'type';
    }

    public static function getTableObjet()
    {
        return 'objet';
    }
    public static function getTableSecteur()
    {
        return 'secteur';
        return 'secteur';
    }

    public static function getUser($login){

        $user = DB::table(self::getTableUser())
            ->select('*')
            ->where('login', '=', $login)
            ->first();

        return $user;
    }

    public static function updatepass($login){

        $dataUpdate = array();
        $dataUpdate['mdp'] = Hash::make('azerty');

        DB::table('user')
            ->where(self::getTableUser() . '.login', '=', $login)
            ->update($dataUpdate);

        return 1;

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
            ->where('etat', '=', 0)
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
        $dataInsertDemandeCp['etat']="1";
        $dataInsertDemandeCp['nomObjet']= Modell::getNomObjet($objet)->nomObjet;

        DB::table('emprunt')->insert($dataInsertDemandeCp);


        $dataUpdate = array();
        $dataUpdate['emprunterPar'] = $nom.' '.$prenom;
        $dataUpdate['dateDeb'] = $dateDeb;
        $dataUpdate['etat']="1";

        DB::table('objet')
            ->where(self::getTableObjet() . '.idObjet', '=', $objet)
            ->update($dataUpdate);

        return 1;
    }

    public static function getNomType($idType){
        $type =DB::table(self::getTableType())
            ->select('nomType')
            ->where('numType', '=', $idType)
            ->first();
        return $type;
    }

//    public static function getEmpruntAll()
//    {
//        $listeObjets =DB::table(self::getTableObjet())
//            ->select('idObjet','nomObjet','emprunterPar','dateDeb','type','site')
//            ->get();
//
//
//        return $listeObjets;
//    }

    public static function getEmpruntAll()
    {
        $listeObjets =DB::table(self::getTableObjet())
            ->select(self::getTableObjet().'.*',self::getTableEmprunt().'.idEmprunt',self::getTableEmprunt().'.dateFin',self::getTableEmprunt().'.etat')
            ->leftjoin(self::getTableEmprunt(), self::getTableObjet().'.idObjet','=',self::getTableEmprunt().'.idObjet')
//            ->where('','=','')
            ->distinct()
            ->get();
        return $listeObjets;
    }

    public static function rendreEmprunt($id,$commentaire){
        $dataUpdate = array();
        $dataUpdate['etat'] = 2;
        $dataUpdate['commentaire'] = $commentaire;
        $dataUpdate['dateFin'] = date("Y-m-d");

        DB::table('emprunt')
            ->where(self::getTableEmprunt() . '.idEmprunt', '=', $id)
            ->update($dataUpdate);


        return 1;
    }

    public static function creer($dataInsertDemandeCp)
    {
        DB::table('objet')->insert($dataInsertDemandeCp);
        return 1;
    }

    public static function updateNumero($idType)
    {
        $dataUpdate = array();
        $dataUpdate['numero'] = Modell::getNombreType($idType)->numero+1;

        DB::table('type')
            ->where(self::getTableType() . '.numType', '=', $idType)
            ->update($dataUpdate);

        return 1;
    }

    public static function getNombreType($idType){
        $type =DB::table(self::getTableType())
            ->select('numero')
            ->where('numType', '=', $idType)
            ->first();
        return $type;
    }
//$check->limite
//self::getTableType().'.limite',
    public static function checkManque(){
        $type =DB::table(self::getTableType())
            ->select(self::getTableType().'.designation',self::getTableType().'.limite',\Illuminate\Support\Facades\DB::raw('count(objet.nomObjet) as nb'))
            ->join(self::getTableObjet(), self::getTableType().'.numType','=',self::getTableObjet().'.type')
            ->where('etat', '=', '0')
            ->groupBy('designation','limite')
            ->get();
        return $type;
    }

    public static function getNomObjet($id){
        $nomObjet =DB::table(self::getTableObjet())
            ->select('nomObjet')
            ->where('idObjet', '=', $id)
            ->first();
        return $nomObjet;
    }

    public static function getNomSite($id){
        $nomSite =DB::table(self::getTableSite())
            ->select('nomSite')
            ->where('idSite', '=', $id)
            ->first();
        return $nomSite;
    }
    public static function getSite(){
        $site =DB::table(self::getTableSite())
            ->select('*')
            ->get();
        return $site;
    }

    public static function deleteObjet($id){
        $nomObjet =DB::table(self::getTableObjet())
            ->select('*')
            ->where('idObjet', '=', $id)
            ->delete();
        return $nomObjet;
    }

    public static function getUnObjet($nomObjet){
        $nomObjet =DB::table(self::getTableObjet())
            ->select('idObjet')
            ->where('nomObjet', '=', $nomObjet)
            ->first();
        return $nomObjet;
    }

    public static function getTypeById($idObjet){
        $type =DB::table(self::getTableObjet())
            ->select('type')
            ->where('idObjet', '=', $idObjet)
            ->first();
        return $type;
    }

    public static function getSiteByIdObjet($idObjet){
        $type =DB::table(self::getTableObjet())
            ->select('site')
            ->where('idObjet', '=', $idObjet)
            ->first();
        return $type;
    }

    public static function getLimite($id){
        $type =DB::table(self::getTableType())
            ->select('*')
            ->where('numType', '=', $id)
            ->first();
        return $type;
    }

    public static function updateLimite($limite,$type){
        $dataUpdate = array();
        $dataUpdate['limite'] = $limite;


        DB::table('type')
            ->where(self::getTableType() . '.numType', '=', $type)
            ->update($dataUpdate);
        return $type;
    }

    public static function getObjetByIdEmprunt($idEmprunt){
        $type =DB::table(self::getTableEmprunt())
            ->select('idObjet')
            ->where('idEmprunt', '=', $idEmprunt)
            ->first();
        return $type;
    }

    public static function updateObjet($idObjet,$fonctionne){
        $dataUpdate = array();
        $dataUpdate['etat'] = 0;
        $dataUpdate['fonctionne'] = $fonctionne;
        $dataUpdate['emprunterPar'] = null;
        $dataUpdate['dateDeb'] = null;


        DB::table('objet')
            ->where(self::getTableObjet() . '.idObjet', '=', $idObjet)
            ->update($dataUpdate);
        return 1;
    }
        public static function getEmpruntFini($id)
        {
            $type = DB::table(self::getTableEmprunt())
                ->select('*')
                ->where('idEmprunt', '=', $id)
                ->first();
            return $type;
        }

    public static function insertEmpruntFini($emprunt)
    {
        DB::table('historique')->insert($emprunt);
        return 1;
    }

    public static function deleteEmpruntFini($id){
        $nomObjet =DB::table(self::getTableEmprunt())
            ->select('*')
            ->where('idEmprunt', '=', $id)
            ->delete();
        return 1;
    }

    public static function getAllNoms()
    {
        $type = DB::table(self::getTableUser())
            ->select('nom','prenom','idUser')
            ->get();
        return $type;
    }

    public static function getNomById($idUser)
    {
        $type = DB::table(self::getTableUser())
            ->select('nom')
            ->where('idUser','=',$idUser)
            ->first();
        return $type;
    }

    public static function getPreomById($idUser)
    {
        $type = DB::table(self::getTableUser())
            ->select('prenom')
            ->where('idUser','=',$idUser)
            ->first();
        return $type;
    }

    public static function getSecteurs(){
        $secteurs =DB::table(self::getTableSecteur())
            ->select('*')
            ->get();
        return $secteurs;
    }

    public static function getNomSecteur($id){
        $nomSite =DB::table(self::getTableSecteur())
            ->select('nomSecteur')
            ->where('idSecteur', '=', $id)
            ->first();
        return $nomSite;
    }
    public static function getInfo($id){
        $infos=DB::table(self::getTableObjet())
            ->select('*')
            ->where('idObjet', '=', $id)
            ->get();
        return $infos->toArray();
    }

    public static function getInfoWithCodeB($codeB){
        $infos=DB::table(self::getTableObjet())
            ->select('*')
            ->where('nomObjet', '=', $codeB)
            ->get();
        return $infos->toArray();
    }

    public static function getNames($name){
        $type = DB::table(self::getTableUser())
            ->select('nom','prenom','idUser')
            ->where('nom','LIKE','%'.$name.'%')
            ->get();
        return $type;
    }

    public static function getHistoriqueByNom($id){
        $type = DB::table(self::getTableHistorique())
            ->select('*')
            ->where('nomObjet','=',$id)
            ->get();
        return $type;
    }

    public static function getHistoriqueById($id){
        $type = DB::table(self::getTableHistorique())
            ->select('*')
            ->where('idObjet','=',$id)
            ->get();
        return $type;
    }
}







