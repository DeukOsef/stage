@extends('layouts.layoutConnect')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Nouvel emprunt</div>
                    <div class="card-body">
                        <form method="POST" action="{{url('/creer')}}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <label for="type" class="col-md-4 col-form-label text-md-right">Type</label>
                                <div class="col-md-6">
                                    <select name="type" id="type" class="form-control" required>
                                        <option >--Selectionnez un type--</option>
                                        @foreach($types as $type)
                                            <option value="{{ $type->numType }}">{{ $type->designation}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            {{-----------------------------------------------------------------------------------------------------------------------}}
                                                                        {{--UNITE CENTRAL--}}
                            {{-----------------------------------------------------------------------------------------------------------------------}}
                            <div id="form_uc" style="display: none">
                                <div class="form-group row">
                                    <label for="marque_uc" class="col-md-4 col-form-label text-md-right">marque </label>
                                    <div class="col-md-6">
                                        <input id="marque_uc" type="text" class="form-control" name="marque_uc" >
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="ram_uc" class="col-md-4 col-form-label text-md-right">ram </label>
                                    <div class="col-md-6">
                                        <input id="ram_uc" type="text" class="form-control" name="ram_uc" >
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="hddTaille_uc" class="col-md-4 col-form-label text-md-right">Taille du disque dur </label>
                                    <div class="col-md-6">
                                        <input id="hddTaille_uc" type="text" class="form-control" name="hddTaille_uc" >
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="hddVitesse_uc" class="col-md-4 col-form-label text-md-right">Vitesse du disque dur </label>
                                    <div class="col-md-6">
                                        <input id="hddVitesse_uc" type="text" class="form-control" name="hddVitesse_uc" >
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="OS_uc" class="col-md-4 col-form-label text-md-right">OS </label>
                                    <div class="col-md-6">
                                        <input id="OS_uc" type="text" class="form-control" name="OS_uc" >
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="cpu_uc" class="col-md-4 col-form-label text-md-right">Processeur </label>
                                    <div class="col-md-6">
                                        <input id="cpu_uc" type="text" class="form-control" name="cpu_uc" >
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="cgConn_uc" class="col-md-4 col-form-label text-md-right">Connectique de la carte graphique </label>
                                    <div class="col-md-6">
                                        <input id="cgConn_uc" type="text" class="form-control" name="cgConn_uc" >
                                    </div>
                                </div>
                            </div>

                            {{-----------------------------------------------------------------------------------------------------------------------}}
                                                                             {{--IMPRIMANTE--}}
                            {{-----------------------------------------------------------------------------------------------------------------------}}
                            <div id="form_imp" style="display: none">
                                <div class="form-group row">
                                    <label for="marque_imp" class="col-md-4 col-form-label text-md-right">Marque </label>
                                    <div class="col-md-6">
                                        <input id="marque_imp" type="text" class="form-control" name="marque_imp" >
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="couleur_imp" class="col-md-4 col-form-label text-md-right">Couleur/noir</label>
                                    <div class="col-md-6">
                                        <input id="couleur_imp" type="text" class="form-control" name="couleur_imp" >
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="laser_imp" class="col-md-4 col-form-label text-md-right">laser</label>
                                    <div class="col-md-6">
                                        <input id="laser_imp" type="text" class="form-control" name="laser_imp" >
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="conn_imp" class="col-md-4 col-form-label text-md-right">Connectiques </label>
                                    <div class="col-md-6">
                                        <input id="conn_imp" type="text" class="form-control" name="conn_imp" >
                                    </div>
                                </div>
                            </div>

                            {{-----------------------------------------------------------------------------------------------------------------------}}
                                                                        {{--TELEPHONE PORTABLE--}}
                            {{-----------------------------------------------------------------------------------------------------------------------}}
                            <div id="form_telp" style="display: none">
                                <div class="form-group row">
                                    <label for="marque_telp" class="col-md-4 col-form-label text-md-right">Marque </label>
                                    <div class="col-md-6">
                                        <input id="marque_telp" type="text" class="form-control" name="marque_telp" >
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="ram_telp" class="col-md-4 col-form-label text-md-right">ram </label>
                                    <div class="col-md-6">
                                        <input id="ram_telp" type="text" class="form-control" name="ram_telp" >
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="hddTaille_telp" class="col-md-4 col-form-label text-md-right">taille du stockage </label>
                                    <div class="col-md-6">
                                        <input id="hddTaille_telp" type="text" class="form-control" name="hddTaille_telp" >
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="resolution_telp" class="col-md-4 col-form-label text-md-right">Résolution </label>
                                    <div class="col-md-6">
                                        <input id="resolution_telp" type="text" class="form-control" name="resolution_telp" >
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="Ap_telp" class="col-md-4 col-form-label text-md-right">Appareil photo </label>
                                    <div class="col-md-6">
                                        <input id="Ap_telp" type="text" class="form-control" name="Ap_telp" >
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="typeChargeur_telp" class="col-md-4 col-form-label text-md-right">Type de chargeur </label>
                                    <div class="col-md-6">
                                        <input id="typeChargeur_telp" type="text" class="form-control" name="typeChargeur_telp" >
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="sim_telp" class="col-md-4 col-form-label text-md-right">Double sim </label>
                                    <div class="col-md-6">
                                        <input id="sim_telp" type="text" class="form-control" name="sim_telp" >
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="OS_telp" class="col-md-4 col-form-label text-md-right">OS </label>
                                    <div class="col-md-6">
                                        <input id="OS_telp" type="text" class="form-control" name="OS_telp" >
                                    </div>
                                </div>
                            </div>

                            {{-----------------------------------------------------------------------------------------------------------------------}}
                                                                            {{--TABLETTE--}}
                            {{-----------------------------------------------------------------------------------------------------------------------}}
                            <div id="form_tbt" style="display: none">
                                <div class="form-group row">
                                    <label for="marque_tbt" class="col-md-4 col-form-label text-md-right">Marque </label>
                                    <div class="col-md-6">
                                        <input id="marque_tbt" type="text" class="form-control" name="marque_tbt" >
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="ram_tbt" class="col-md-4 col-form-label text-md-right">ram </label>
                                    <div class="col-md-6">
                                        <input id="ram_tbt" type="text" class="form-control" name="ram_tbt" >
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="hddTaille_tbt" class="col-md-4 col-form-label text-md-right">taille du stockage </label>
                                    <div class="col-md-6">
                                        <input id="hddTaille_tbt" type="text" class="form-control" name="hddTaille_tbt" >
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="resolution_tbt" class="col-md-4 col-form-label text-md-right">resolution</label>
                                    <div class="col-md-6">
                                        <input id="resolution_tbt" type="text" class="form-control" name="resolution_tbt" >
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="Ap_tbt" class="col-md-4 col-form-label text-md-right">Appareil photo</label>
                                    <div class="col-md-6">
                                        <input id="Ap_tbt" type="text" class="form-control" name="Ap_tbt" >
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="typeChargeur_tbt" class="col-md-4 col-form-label text-md-right">Type de chargeur</label>
                                    <div class="col-md-6">
                                        <input id="typeChargeur_tbt" type="text" class="form-control" name="typeChargeur_tbt" >
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="OS_tbt" class="col-md-4 col-form-label text-md-right">OS</label>
                                    <div class="col-md-6">
                                        <input id="OS_tbt" type="text" class="form-control" name="OS_tbt" >
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="Conn_telp" class="col-md-4 col-form-label text-md-right">Connectiques</label>
                                    <div class="col-md-6">
                                        <input id="Conn_telp" type="text" class="form-control" name="Conn_telp" >
                                    </div>
                                </div>
                            </div>

                            {{-----------------------------------------------------------------------------------------------------------------------}}
                                                                            {{--ECRAN--}}
                            {{-----------------------------------------------------------------------------------------------------------------------}}
                            <div id="form_ecr" style="display: none">
                                <div class="form-group row">
                                    <label for="marque_ecr" class="col-md-4 col-form-label text-md-right">Marque</label>
                                    <div class="col-md-6">
                                        <input id="marque_ecr" type="text" class="form-control" name="marque_ecr" >
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="resolution_ecr" class="col-md-4 col-form-label text-md-right">Résolution</label>
                                    <div class="col-md-6">
                                        <input id="resolution_ecr" type="text" class="form-control" name="resolution_ecr" >
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="tdr_ecr" class="col-md-4 col-form-label text-md-right">Temps de réponse</label>
                                    <div class="col-md-6">
                                        <input id="tdr_ecr" type="text" class="form-control" name="tdr_ecr" >
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="conn_ecr" class="col-md-4 col-form-label text-md-right">Connectiques</label>
                                    <div class="col-md-6">
                                        <input id="conn_ecr" type="text" class="form-control" name="conn_ecr" >
                                    </div>
                                </div>
                            </div>

                            {{-----------------------------------------------------------------------------------------------------------------------}}
                                                                            {{--CLAVIER--}}
                            {{-----------------------------------------------------------------------------------------------------------------------}}
                            <div id="form_cla" style="display: none">
                                <div class="form-group row">
                                    <label for="marque_cla" class="col-md-4 col-form-label text-md-right">Marque</label>
                                    <div class="col-md-6">
                                        <input id="marque_cla" type="text" class="form-control" name="marque_cla" >
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="meca_cla" class="col-md-4 col-form-label text-md-right">Mécanique</label>
                                    <div class="col-md-6">
                                        <input id="meca_cla" type="text" class="form-control" name="meca_cla" >
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="conn_cla" class="col-md-4 col-form-label text-md-right">Connectiques</label>
                                    <div class="col-md-6">
                                        <input id="conn_cla" type="text" class="form-control" name="conn_cla" >
                                    </div>
                                </div>
                            </div>

                            {{-----------------------------------------------------------------------------------------------------------------------}}
                                                                        {{--ORDINATEUR PORTABLE--}}
                            {{-----------------------------------------------------------------------------------------------------------------------}}
                            <div id="form_pcp" style="display: none">
                                <div class="form-group row">
                                    <label for="marque_pcp" class="col-md-4 col-form-label text-md-right">marque</label>
                                    <div class="col-md-6">
                                        <input id="marque_pcp" type="text" class="form-control" name="marque_pcp" >
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="ram_pcp" class="col-md-4 col-form-label text-md-right">ram</label>
                                    <div class="col-md-6">
                                        <input id="ram_pcp" type="text" class="form-control" name="ram_pcp" >
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="hddTaille_pcp" class="col-md-4 col-form-label text-md-right">Taille du disque dur</label>
                                    <div class="col-md-6">
                                        <input id="hddTaille_pcp" type="text" class="form-control" name="hddTaille_pcp" >
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="hddVitesse_pcp" class="col-md-4 col-form-label text-md-right">Vitesse du disque dur</label>
                                    <div class="col-md-6">
                                        <input id="hddVitesse_pcp" type="text" class="form-control" name="hddVitesse_pcp" >
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="OS_pcp" class="col-md-4 col-form-label text-md-right">OS</label>
                                    <div class="col-md-6">
                                        <input id="OS_pcp" type="text" class="form-control" name="OS_pcp" >
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="cpu_pcp" class="col-md-4 col-form-label text-md-right">Processeur</label>
                                    <div class="col-md-6">
                                        <input id="cpu_pcp" type="text" class="form-control" name="cpu_pcp" >
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="cgConn_pcp" class="col-md-4 col-form-label text-md-right">Connectique de la carte graphique</label>
                                    <div class="col-md-6">
                                        <input id="cgConn_pcp" type="text" class="form-control" name="cgConn_pcp" >
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="resolution_pcp" class="col-md-4 col-form-label text-md-right">Résolution</label>
                                    <div class="col-md-6">
                                        <input id="resolution_pcp" type="text" class="form-control" name="resolution_pcp" >
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="tailleBatterie_pcp" class="col-md-4 col-form-label text-md-right">Taille de la batterie</label>
                                    <div class="col-md-6">
                                        <input id="tailleBatterie_pcp" type="text" class="form-control" name="tailleBatterie_pcp" >
                                    </div>
                                </div>
                            </div>

                            {{-----------------------------------------------------------------------------------------------------------------------}}
                                                                            {{--SWITCH--}}
                            {{-----------------------------------------------------------------------------------------------------------------------}}
                            <div id="form_swt" style="display: none">
                                <div class="form-group row">
                                    <label for="typePort_swt" class="col-md-4 col-form-label text-md-right">Type de port</label>
                                    <div class="col-md-6">
                                        <input id="typePort_swt" type="text" class="form-control" name="typePort_swt" >
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="nbPort_swt" class="col-md-4 col-form-label text-md-right">Nombre de port</label>
                                    <div class="col-md-6">
                                        <input id="nbPort_swt" type="text" class="form-control" name="nbPort_swt" >
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="debit_swt" class="col-md-4 col-form-label text-md-right">Débit</label>
                                    <div class="col-md-6">
                                        <input id="debit_swt" type="text" class="form-control" name="debit_swt" >
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="mann_swt" class="col-md-4 col-form-label text-md-right">Mannageable</label>
                                    <div class="col-md-6">
                                        <input id="mann_swt" type="text" class="form-control" name="mann_swt" >
                                    </div>
                                </div>
                            </div>

                            {{-----------------------------------------------------------------------------------------------------------------------}}
                                                                        {{--CABLE RESEAU--}}
                            {{-----------------------------------------------------------------------------------------------------------------------}}
                            <div id="form_cr" style="display: none">
                                <div class="form-group row">
                                    <label for="marque_cr" class="col-md-4 col-form-label text-md-right">Marque</label>
                                    <div class="col-md-6">
                                        <input id="marque_cr" type="text" class="form-control" name="marque_cr" >
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="cat_cr" class="col-md-4 col-form-label text-md-right">Catégorie</label>
                                    <div class="col-md-6">
                                        <input id="cat_cr" type="text" class="form-control" name="cat_cr" >
                                    </div>
                                </div>
                            </div>

                            {{-----------------------------------------------------------------------------------------------------------------------}}
                                                                        {{--MULTIPRISE--}}
                            {{-----------------------------------------------------------------------------------------------------------------------}}
                            <div id="form_mult" style="display: none">
                                <div class="form-group row">
                                    <label for="marque_mult" class="col-md-4 col-form-label text-md-right">Marque</label>
                                    <div class="col-md-6">
                                        <input id="marque_mult" type="text" class="form-control" name="marque_mult" >
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="nbPrise_mult" class="col-md-4 col-form-label text-md-right">Nombre de prise</label>
                                    <div class="col-md-6">
                                        <input id="nbPrise_mult" type="text" class="form-control" name="nbPrise_mult" >
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="parafoudre_mult" class="col-md-4 col-form-label text-md-right">Parafoudre</label>
                                    <div class="col-md-6">
                                        <input id="parafoudre_mult" type="text" class="form-control" name="parafoudre_mult" >
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inter_mult" class="col-md-4 col-form-label text-md-right">Interrupteur</label>
                                    <div class="col-md-6">
                                        <input id="inter_mult" type="text" class="form-control" name="inter_mult" >
                                    </div>
                                </div>
                            </div>

                            {{-----------------------------------------------------------------------------------------------------------------------}}
                                                                    {{--VIDEOPROJECTEUR--}}
                            {{-----------------------------------------------------------------------------------------------------------------------}}
                            <div id="form_vidp" style="display: none">
                                <div class="form-group row">
                                    <label for="marque_vidp" class="col-md-4 col-form-label text-md-right">Marque</label>
                                    <div class="col-md-6">
                                        <input id="marque_vidp" type="text" class="form-control" name="marque_vidp" >
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="conn_vidp" class="col-md-4 col-form-label text-md-right">Connectiques</label>
                                    <div class="col-md-6">
                                        <input id="conn_vidp" type="text" class="form-control" name="conn_vidp" >
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="resolution_swt" class="col-md-4 col-form-label text-md-right">Résolution</label>
                                    <div class="col-md-6">
                                        <input id="resolution_swt" type="text" class="form-control" name="resolution_swt" >
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="son_vidp" class="col-md-4 col-form-label text-md-right">Son</label>
                                    <div class="col-md-6">
                                        <input id="son_vidp" type="text" class="form-control" name="son_vidp" >
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="decibel_vidp" class="col-md-4 col-form-label text-md-right">decibel</label>
                                    <div class="col-md-6">
                                        <input id="decibel_vidp" type="text" class="form-control" name="decibel_vidp" >
                                    </div>
                                </div>
                            </div>

                            {{-----------------------------------------------------------------------------------------------------------------------}}
                                                                                {{--AUTRE--}}
                            {{-----------------------------------------------------------------------------------------------------------------------}}
                            <div id="form_atr" style="display: none">
                                <div class="form-group row">
                                    <label for="autre_atr" class="col-md-4 col-form-label text-md-right">Autre</label>
                                    <div class="col-md-6">
                                        <input id="autre_atr" type="text" class="form-control" name="autre_atr" >
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <label for="numb" class="col-md-4 col-form-label text-md-right">Nombre d'objet</label>
                                <div class="col-md-6">
                                    <input id="numb" type="text" class="form-control" style="color:#495057; background-color:#E9ECEF; border-color:#ced4da; outline:0; -webkit-box-shadow:none;box-shadow:none;" name="numb" value="1">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-5">
                                </div>
                                <div class="col-md-5 ">
                                    <button type="submit" class="btn btn-primary">
                                        Envoyer la demande
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#type').on('change', function(e) {
                e.preventDefault();
                var numType = $('#type').val();

                $("#form_uc").css('display', 'none');
                $("#form_imp").css('display', 'none');
                $("#form_telp").css('display', 'none');
                $("#form_tbt").css('display', 'none');
                $("#form_ecr").css('display', 'none');
                $("#form_cla").css('display', 'none');
                $("#form_pcp").css('display', 'none');
                $("#form_swt").css('display', 'none');
                $("#form_cr").css('display', 'none');
                $("#form_mult").css('display', 'none');
                $("#form_vidp").css('display', 'none');
                $("#form_atr").css('display', 'none');

                switch (numType) {
                    case "1":
                        $("#form_uc").css('display', 'block');
                        break;
                    case "2":
                        $("#form_imp").css('display', 'block');
                        break;
                    case "3":
                        $("#form_telp").css('display', 'block');
                        break;
                    case "4":
                        $("#form_tbt").css('display', 'block');
                        break;
                    case "5":
                        $("#form_ecr").css('display', 'block');
                        break;
                    case "6":
                        $("#form_cla").css('display', 'block');
                        break;
                    case "7":
                        $("#form_pcp").css('display', 'block');
                        break;
                    case "8":
                        $("#form_swt").css('display', 'block');
                        break;
                    case "9":
                        $("#form_cr").css('display', 'block');
                        break;
                    case "10":
                        $("#form_mult").css('display', 'block');
                        break;
                    case "11":
                        $("#form_vidp").css('display', 'block');
                        break;
                    case "12":
                        $("#form_atr").css('display', 'block');
                        break;

                }

            });
        });
    </script>
@endsection
