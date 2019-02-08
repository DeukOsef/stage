@extends('layouts.layoutConnect')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Création d'objet</div>
                    <div class="card-body">
                        @if(session('demenv'))
                            <div class="form-group row">
                                <label class="col-sm-12 col-form-label text-md-center"style="color: green"><b>{{session('demenv')}}</b></label>
                            </div>
                        @endif
                        <form method="POST" action="{{url('/creer')}}" enctype="multipart/form-data" id="formc">
                            @csrf
                            <div class="form-group row">
                                <label for="type" class="col-md-4 col-form-label text-md-right">Créateur d'objet</label>
                                <div class="col-md-6">
                                    <input id="fournisseur" type="text" class="form-control" style="color:#495057; background-color:#E9ECEF; border-color:#ced4da; outline:0; -webkit-box-shadow:none;box-shadow:none;" name="fournisseur" value="                           {{session()->get('client')->nom }} {{ session()->get('client')->prenom}}"readonly>
                                </div>

                            </div>

                            <div class="form-group row">
                                <label for="type" class="col-md-4 col-form-label text-md-right">Type</label>
                                <div class="col-md-6">
                                    <select name="type" id="type" class="form-control" required>
                                        <option >--Selectionnez un type--</option>
                                        @foreach($types as $type)
                                            <option value="{{ $type->numType }}">{{ $type->designation."(".$type->nomType.")"}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" id="vga" value="">
                            <input type="hidden" id="hdmi" value="">
                            <input type="hidden" id="usb" value="">
                            <input type="hidden" id="ethernet" value="">
                                {{-----------------------------------------------------------------------------------------------------------------------}}
                                {{--UNITE CENTRAL--}}
                                {{-----------------------------------------------------------------------------------------------------------------------}}
                                <div id="form_uc" style="display: none">
                                <div class="form-group row">
                                    <label for="marque_uc" class="col-md-4 col-form-label text-md-right">marque </label>
                                    <div class="col-md-6">
                                        <select name="marque_uc" id="marque_uc" class="form-control" >
                                            <option >--Selectionnez une marque--</option>
                                            <option value="Lenovo">Lenovo</option>
                                            <option value="Asus">Asus</option>
                                            <option value="Dell">Dell</option>
                                            <option value="Hp">Hp</option>
                                            <option value="Acer">Acer</option>
                                            <option value="Apple">Apple</option>
                                            <option value="Msi">Msi</option>
                                            <option value="Razer">Razer</option>
                                            <option value="Samsung">Samsung</option>
                                            <option value="Microsoft">Microsoft</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="ram_uc" class="col-md-4 col-form-label text-md-right">RAM (MgHz) </label>
                                    <div class="col-md-6">
                                        <input id="ram_uc" type="text" class="form-control" name="ram_uc" >
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="hddTaille_uc" class="col-md-4 col-form-label text-md-right">Taille du disque dur (Go)</label>
                                    <div class="col-md-6">
                                        <input id="hddTaille_uc" type="text" class="form-control" name="hddTaille_uc" >
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="hddVitesse_uc" class="col-md-4 col-form-label text-md-right">Vitesse du disque dur (Rpm)</label>
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
                                    <label for="cpu_uc" class="col-md-4 col-form-label text-md-right">Nombre de coeur </label>
                                    <div class="col-md-6">
                                        <select name="cpu_uc" id="cpu_uc" class="form-control" >
                                            @for($i=0;$i<21;$i++)
                                                <option value="{{$i}}">{{$i}}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="marqueProc_uc" class="col-md-4 col-form-label text-md-right">Marque processeur</label>
                                    <div class="col-md-6">
                                        <select name="marqueProc_uc" id="marqueProc_uc" class="form-control" >
                                            <option >--Selectionnez une marque--</option>
                                            <option value="Intel">Intel</option>
                                            <option value="Amd">Amd</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="nomProc_uc" class="col-md-4 col-form-label text-md-right">Nom Processeur </label>
                                    <div class="col-md-6">
                                        <input id="nomProc_uc" type="text" class="form-control" name="nomProc_uc" >
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="puiProc_uc" class="col-md-4 col-form-label text-md-right">Puissance processeur(MgHz) </label>
                                    <div class="col-md-6">
                                        <input id="puiProc_uc" type="text" class="form-control" name="puiProc_uc" >
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="conn_uc" class="col-md-4 col-form-label text-md-right">Connectique </label>
                                    <div class="col-md-6" style="margin: auto;">
                                        <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#modalConnectique">Ajouter</button>

                                    {{--<div class="col-md-6">--}}
                                    {{--<input id="cgConn_uc" type="text" class="form-control" name="cgConn_uc" >--}}
                                    {{--</div>--}}
                                    </div>
                                </div>
                            </div>

                                {{-----------------------------------------------------------------------------------------------------------------------}}
                                {{--IMPRIMANTE--}}
                                {{-----------------------------------------------------------------------------------------------------------------------}}
                                <div id="form_imp" style="display: none">
                                    <div class="form-group row">
                                        <label for="marque_imp" class="col-md-4 col-form-label text-md-right">marque </label>
                                        <div class="col-md-6">
                                            <select name="marque_imp" id="marque_imp" class="form-control" >
                                                <option >--Selectionnez une marque--</option>
                                                <option value="Brother">Brother</option>
                                                <option value="Epson">Epson</option>
                                                <option value="Canon">Canon</option>
                                                <option value="Hp">Hp</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="couleur_imp" class="col-md-4 col-form-label text-md-right">Couleur </label>
                                        <div class="col-md-6">
                                            <input id="couleur_imp" type="checkbox" class="form-control" name="couleur_imp" value="1">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="laser_imp" class="col-md-4 col-form-label text-md-right">Type d'impression</label>
                                        <div class="col-md-6">
                                            <select name="laser_imp" id="laser_imp" class="form-control" >
                                                <option >--Selectionnez un type d'impression--</option>
                                                <option value="laser">Laser</option>
                                                <option value="Matriciel">Matriciel</option>
                                                <option value="jet d'encre">jet d'encre</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="Conn_imp" class="col-md-4 col-form-label text-md-right">Connectiques </label>
                                        <div class="col-md-6" style="margin: auto;">
                                            <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#modalConnectique">Ajouter</button>
                                            {{--<div class="col-md-6">--}}
                                        {{--<input id="cgConn_uc" type="text" class="form-control" name="cgConn_uc" >--}}
                                        {{--</div>--}}
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
                                            <select name="marque_telp" id="marque_telp" class="form-control" >
                                                <option >--Selectionnez une marque--</option>
                                                <option value="Google">Google</option>
                                                <option value="Samsung">Samsung</option>
                                                <option value="OnePlus">OnePlus</option>
                                                <option value="Huawei">Huawei</option>
                                                <option value="Apple">Apple</option>
                                                <option value="Honor">Honor</option>
                                                <option value="Xiamoi">Xiamoi</option>
                                                <option value="Lg">Lg</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="ram_telp" class="col-md-4 col-form-label text-md-right">RAM (Go)</label>
                                        <div class="col-md-6">
                                            <input id="ram_telp" type="text" class="form-control" name="ram_telp" >
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="hddTaille_telp" class="col-md-4 col-form-label text-md-right">Taille du stockage </label>
                                        <div class="col-md-6">
                                            <input id="hddTaille_telp" type="text" class="form-control" name="hddTaille_telp" >
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="resolution_telp" class="col-md-4 col-form-label text-md-right">Résolution écran  </label>
                                        <div class="col-md-6">
                                            <input id="resolution_telp" type="text" class="form-control" name="resolution_telp" >
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="Ap_telp" class="col-md-4 col-form-label text-md-right">Appareil photo (Mpx) </label>
                                        <div class="col-md-6">
                                            <input id="Ap_telp" type="text" class="form-control" name="Ap_telp" >
                                        </div>
                                    </div>

                                    <div class="row">
                                        <label for="ApAv_telp" class="col-md-4 col-form-label text-md-right">Appareil photo avant ?</label>
                                        <div class="col-md-6">
                                            <input id="ApAv_telp" type="checkbox" class="form-control" name="ApAv_telp" value="1">
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <label for="ApAr_telp" class="col-md-4 col-form-label text-md-right">Appareil photo arrière ?</label>
                                        <div class="col-md-6">
                                            <input id="ApAr_telp" type="checkbox" class="form-control" name="ApAr_telp" value="1">
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
                                            <input id="sim_telp" type="checkbox" class="form-control" name="sim_telp" value="1">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="typeSim_telp" class="col-md-4 col-form-label text-md-right">Type sim</label>
                                        <div class="col-md-6">
                                            <select name="typeSim_telp" id="typeSim_telp" class="form-control" >
                                                <option >--Selectionnez un type--</option>
                                                <option value="standard">Standard</option>
                                                <option value="Nano">Nano</option>
                                                <option value="Micro">Micro</option>
                                            </select>
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
                                            <select name="marque_tbt" id="marque_tbt" class="form-control" >
                                                <option >--Selectionnez une marque--</option>
                                                <option value="Google">Google</option>
                                                <option value="Samsung">Samsung</option>
                                                <option value="Apple">Apple</option>
                                                <option value="Sony">Sony</option>
                                                <option value="Amazon">Amazon</option>
                                                <option value="Archos">Archos</option>
                                            </select>
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
                                        <label for="Ap_tbt" class="col-md-4 col-form-label text-md-right">Appareil photo (Mpx)</label>
                                        <div class="col-md-6">
                                            <input id="Ap_tbt" type="text" class="form-control" name="Ap_tbt" >
                                        </div>
                                    </div>

                                    <div class="row">
                                        <label for="ApAv_tbt" class="col-md-4 col-form-label text-md-right">Appareil photo avant ?</label>
                                        <div class="col-md-6">
                                            <input id="ApAv_tbt" type="checkbox" class="form-control" name="ApAv_tbt" value="1">
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <label for="ApAr_tbt" class="col-md-4 col-form-label text-md-right">Appareil photo arrière ?</label>
                                        <div class="col-md-6">
                                            <input id="ApAr_tbt" type="checkbox" class="form-control" name="ApAr_tbt" value="1">
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
                                        <label for="Conn_telp" class="col-md-4 col-form-label text-md-right">Connectiques </label>
                                        <div class="col-md-6" style="margin: auto;">
                                            <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#modalConnectique">Ajouter</button>
                                        {{--<div class="col-md-6">--}}
                                        {{--<input id="cgConn_uc" type="text" class="form-control" name="cgConn_uc" >--}}
                                        {{--</div>--}}
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
                                            <select name="marque_ecr" id="marque_ecr" class="form-control" >
                                                <option >--Selectionnez une marque--</option>
                                                <option value="Dell">Dell</option>
                                                <option value="Samsung">Samsung</option>
                                                <option value="Asus">Asus</option>
                                                <option value="BenQ">BenQ</option>
                                                <option value="Liyama">Liyama</option>
                                                <option value="Lg">Lg</option>
                                            </select>
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
                                        <label for="Conn_telp" class="col-md-4 col-form-label text-md-right">Connectiques </label>
                                        <div class="col-md-6" style="margin: auto;">
                                            <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#modalConnectique">Ajouter</button>
                                        {{--<div class="col-md-6">--}}
                                        {{--<input id="cgConn_uc" type="text" class="form-control" name="cgConn_uc" >--}}
                                        {{--</div>--}}
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
                                            <select name="marque_cla" id="marque_cla" class="form-control" >
                                                <option >--Selectionnez une marque--</option>
                                                <option value="Logitech">Logitech</option>
                                                <option value="Samsung">Samsung</option>
                                                <option value="Asus">Asus</option>
                                                <option value="Lenovo">Lenovo</option>
                                                <option value="Corsair">Corsair</option>
                                                <option value="SteelSeries">SteelSeries</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="meca_cla" class="col-md-4 col-form-label text-md-right">Mécanique</label>
                                        <div class="col-md-6">
                                            <input id="meca_cla" type="checkbox" class="form-control" name="meca_cla" value="1">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="Conn_cla" class="col-md-4 col-form-label text-md-right">Connectiques </label>
                                        <div class="col-md-6" style="margin: auto;">
                                            <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#modalConnectique">Ajouter</button>
                                            {{--<div class="col-md-6">--}}
                                            {{--<input id="cgConn_uc" type="text" class="form-control" name="cgConn_uc" >--}}
                                            {{--</div>--}}
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
                                            <select name="marque_pcp" id="marque_pcp" class="form-control" >
                                                <option >--Selectionnez une marque--</option>
                                                <option value="Lenovo">Lenovo</option>
                                                <option value="Asus">Asus</option>
                                                <option value="Dell">Dell</option>
                                                <option value="Hp">Hp</option>
                                                <option value="Acer">Acer</option>
                                                <option value="Apple">Apple</option>
                                                <option value="Msi">Msi</option>
                                                <option value="Razer">Razer</option>
                                                <option value="Samsung">Samsung</option>
                                                <option value="Microsoft">Microsoft</option>
                                            </select>
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
                                            <select name="cpu_pcp" id="cpu_pcp" class="form-control" >
                                                <option >--Selectionnez une marque--</option>
                                                @for($i=1;$i<21;$i++)
                                                    <option value="{{$i}}">{{$i}}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="marque_pcp" class="col-md-4 col-form-label text-md-right">marque</label>
                                        <div class="col-md-6">
                                            <select name="marque_pcp" id="marque_pcp" class="form-control" >
                                                <option >--Selectionnez une marque--</option>
                                                <option value="Intel">Intel</option>
                                                <option value="Amd">Amd</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="nomProc_pcp" class="col-md-4 col-form-label text-md-right">Nom Processeur </label>
                                        <div class="col-md-6">
                                            <input id="nomProc_pcp" type="text" class="form-control" name="nomProc_pcp" >
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="puiProc_pcp" class="col-md-4 col-form-label text-md-right">Puissance processeur(MgHz) </label>
                                        <div class="col-md-6">
                                            <input id="puiProc_pcp" type="text" class="form-control" name="puiProc_pcp" >
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="Conn_pcp" class="col-md-4 col-form-label text-md-right">Connectiques </label>
                                        <div class="col-md-6" style="margin: auto;">
                                            <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#modalConnectique">Ajouter</button>
                                            {{--<div class="col-md-6">--}}
                                            {{--<input id="cgConn_uc" type="text" class="form-control" name="cgConn_uc" >--}}
                                            {{--</div>--}}
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
                                        <label for="nbPort_swt" class="col-md-4 col-form-label text-md-right">Nombre de port</label>
                                        <div class="col-md-6">
                                            <input id="nbPort_swt" type="text" class="form-control" name="nbPort_swt" >
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="debit_swt" class="col-md-4 col-form-label text-md-right">Débit (Mpbs)</label>
                                        <div class="col-md-6">
                                            <input id="debit_swt" type="text" class="form-control" name="debit_swt" >
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="mann_swt" class="col-md-4 col-form-label text-md-right">Mannageable</label>
                                        <div class="col-md-6">
                                            <input id="mann_swt" type="checkbox" class="form-control" name="mann_swt" value="1">
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
                                        <label for="longueur_cr" class="col-md-4 col-form-label text-md-right">Longueur(M)</label>
                                        <div class="col-md-6">
                                            <input id="longueur_cr" type="text" class="form-control" name="longueur_cr" >
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="cat_cr" class="col-md-4 col-form-label text-md-right">Catégorie</label>
                                        <div class="col-md-6">
                                            <select name="cat_cr" id="cat_cr" class="form-control" >
                                                <option >--Selectionnez une categorie--</option>
                                                <option value="CAT5e">CAT5e</option>
                                                <option value="CAT6">CAT6</option>
                                                <option value="CAT6a">CAT6a</option>
                                                <option value="CAT7">CAT7</option>
                                                <option value="CAT7a">CAT7a</option>
                                            </select>
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
                                            <select name="cpu_pcp" id="cpu_pcp" class="form-control" >
                                                <option >--Selectionnez une marque--</option>
                                                @for($i=2;$i<11;$i++)
                                                    <option value="{{$i}}">{{$i}}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="longueur_mult" class="col-md-4 col-form-label text-md-right">Longueur(M)</label>
                                        <div class="col-md-6">
                                            <input id="longueur_mult" type="text" class="form-control" name="longueur_mult" >
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="parafoudre_mult" class="col-md-4 col-form-label text-md-right">Parafoudre</label>
                                        <div class="col-md-6">
                                            <input id="parafoudre_mult" type="checkbox" class="form-control" name="parafoudre_mult" value="1">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inter_mult" class="col-md-4 col-form-label text-md-right">Interrupteur</label>
                                        <div class="col-md-6">
                                            <input id="inter_mult" type="checkbox" class="form-control" name="inter_mult" value="1">
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
                                            <select name="marque_vidp" id="marque_vidp" class="form-control" >
                                                <option >--Selectionnez une categorie--</option>
                                                <option value="Optoma">Optoma</option>
                                                <option value="BenQ">BenQ</option>
                                                <option value="Epson">Epson</option>
                                                <option value="Sony">Sony</option>
                                                <option value="Acer">Acer</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="Conn_vidp" class="col-md-4 col-form-label text-md-right">Connectiques </label>
                                        <div class="col-md-6" style="margin: auto;">
                                            <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#modalConnectique">Ajouter</button>
                                            {{--<div class="col-md-6">--}}
                                            {{--<input id="cgConn_uc" type="text" class="form-control" name="cgConn_uc" >--}}
                                            {{--</div>--}}
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="resolution_vidp" class="col-md-4 col-form-label text-md-right">Résolution</label>
                                        <div class="col-md-6">
                                            <input id="resolution_vidp" type="text" class="form-control" name="resolution_vidp" >
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="son_vidp" class="col-md-4 col-form-label text-md-right">Son</label>
                                        <div class="col-md-6">
                                            <input id="son_vidp" type="text" class="form-control" name="son_vidp" >
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="telec_vidp" class="col-md-4 col-form-label text-md-right">Telecommande</label>
                                        <div class="col-md-6">
                                            <input id="telec_vidp" type="checkbox" class="form-control" name="telec_vidp" value="1">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="focal_vidp" class="col-md-4 col-form-label text-md-right">Focal court</label>
                                        <div class="col-md-6">
                                            <input id="focal_vidp" type="checkbox" class="form-control" name="focal_vidp" value="1">
                                        </div>
                                    </div>
                                </div>

                                {{-----------------------------------------------------------------------------------------------------------------------}}
                                {{--AUTRE--}}
                                {{-----------------------------------------------------------------------------------------------------------------------}}
                                <div id="form_atr" style="display: none">

                                    <div class="form-group row">
                                        <label for="titre_atr" class="col-md-4 col-form-label text-md-right">Titre</label>
                                        <div class="col-md-6">
                                            <input id="titre_atr" type="text" class="form-control" name="titre_atr" >
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="desc_atr" class="col-md-4 col-form-label text-md-right">Déscriptif</label>
                                        <div class="col-md-6">
                                            <textarea class="form-control" rows="4" cols="50" name="desc_atr" form="formc">Entrez votre déscriptif</textarea>
                                        </div>
                                    </div>

                                </div>

                                <div class="form-group row">
                                    <label for="cpu_uc" class="col-md-4 col-form-label text-md-right">Armoire </label>
                                    <div class="col-md-6">
                                        <select name="armoire" id="armoire" class="form-control" >
                                            <option >--Selectionnez une armoire--</option>
                                            @for($i=1;$i<21;$i++)
                                                <option value="{{$i}}">{{$i}}</option>
                                            @endfor
                                        </select>
                                        <select name="rayonnage" id="rayonnage" class="form-control" >
                                            <option >--Selectionnez un rayon--</option>
                                            @for($i=1;$i<21;$i++)
                                                <option value="{{$i}}">{{$i}}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="site" class="col-md-4 col-form-label text-md-right">Localisation</label>
                                    <div class="col-md-6">
                                        <select name="site" id="site" class="form-control" required>
                                            <option >--Selectionnez un site--</option>
                                            @foreach($sites as $site)
                                                <option value="{{ $site->idSite }}">{{ $site->nomSite}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="secteur" class="col-md-4 col-form-label text-md-right">Secteur</label>
                                    <div class="col-md-6">
                                        <select name="secteur" id="secteur" class="form-control" required>

                                            @foreach($secteurs as $secteur)
                                                <option value="{{ $secteur->idSecteur }}">{{ $secteur->nomSecteur}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <label for="fature" class="col-md-4 col-form-label text-md-right">Facture</label>
                                    <div class="col-md-6">
                                        <input id="facture" type="file" class="btn " name="facture" value="Choisir un fichier" accept=".pdf">
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <label for="numb" class="col-md-4 col-form-label text-md-right">Nombre d'objet</label>
                                    <div class="col-md-6">
                                        <input id="numb" type="text" class="form-control" style="color:#495057; background-color:#E9ECEF; border-color:#ced4da; outline:0; -webkit-box-shadow:none;box-shadow:none;" name="numb" value="1">
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <label for="etiq" class="col-md-4 col-form-label text-md-right">Génerer étiquette ?</label>
                                    <div class="col-md-6">
                                        <input id="etiq" type="checkbox" class="form-control" name="etiq" value="1">
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-5">
                                    </div>
                                    <div class="col-md-5 ">
                                        <button type="submit" class="btn btn-primary">
                                            Créer
                                        </button>
                                    </div>
                                </div>
                        </form>
                    </div>
                    <a href="{{url('/accueil')}}" class="btn btn-xs btn-primary" > Retour a l'accueil</a>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalConnectique">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title">Choisir</h2>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-md-5">
                            <label for="vgam" class="col-md-8 col-form-label text-md-right">VGA</label>
                            <select name="vgam" id="vgam" class="form-control" >
                                @for($i = 0 ; $i < 6 ; $i++)
                                    <option value="{{$i}}">{{$i}}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-5 ">
                            <label for="hdmim" class="col-md-8 col-form-label text-md-right">HDMI</label>
                            <select name="hdmim" id="hdmim" class="form-control" >
                                @for($i = 0 ; $i < 6 ; $i++)
                                    <option value="{{$i}}">{{$i}}</option>
                                @endfor
                            </select>
                        </div>

                        <div class="col-md-5">
                            <label for="usbm" class="col-md-8 col-form-label text-md-right">USB</label>
                            <select name="usbm" id="usbm" class="form-control" >
                                @for($i = 0 ; $i < 6 ; $i++)
                                    <option value="{{$i}}">{{$i}}</option>
                                @endfor

                            </select>
                        </div>
                        <div class="col-md-5 ">
                            <label for="ethernetm" class="col-md-8 col-form-label text-md-right">Ethernet</label>
                            <select name="ethernetm" id="ethernetm" class="form-control" >
                                @for($i = 0 ; $i < 6 ; $i++)
                                    <option value="{{$i}}">{{$i}}</option>
                                @endfor
                            </select>
                        </div>
                        <br>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="button" id="selecConnect">
                                Confirmer
                            </button>
                        </div>
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
    <script>
        $(document).ready(function() {
            $("#selecConnect").on('click', function(e){
                e.preventDefault();
                $("#vga").val($("#vgam").val());
                $("#hdmi").val($("#hdmim").val());
                $("#usb").val($("#usbm").val());
                $("#ethernet").val($("#ethernetm").val());
                $('#modalConnectique').modal('hide');
            });
        });
    </script>
@endsection
