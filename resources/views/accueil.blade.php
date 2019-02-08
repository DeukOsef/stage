@extends('layouts.layoutConnect')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class=" alert-danger" id="manque">
                    </div>


                </div>
                <div class="card-header">Accueil</div>
                <div class="card-body">
                    @if(session('demenv'))
                        <div class="form-group row">
                            <label class="col-sm-12 col-form-label text-md-center"style="color: red ;font-size:20px;"><b><i class="fa fa-warning" style="font-size:24px;"></i>  <img src="icon/dgr.png">  {{session('demenv')}}</b></label>
                        </div>
                    @endif
                    @if(session('emprunt'))
                        <div class="form-group row">
                            <label class="col-sm-12 col-form-label text-md-center"style="color: green; font-size: 20px"><b>{{session('emprunt')}}</b></label>
                        </div>
                    @endif



                    <div class="container">
                        <div class="row ">
                            <div class="col-md-8">
                                <a type="button" class="btn btn-secondary btn-lg" style="width: 190px" href="{{url('/emprunter')}}">Retrait du stock</a>
                            </div>
                            <div class="col-md-4">
                                <a type="button" class="btn btn-secondary btn-lg" style="width: 190px" href="{{url('/accueil')}}">Cartographie</a>
                            </div>
                        </div>
                        <br>


                        @if(session()->get('client')->profil ==1)
                            <div class="row ">
                                <div class="col-md-8">
                                    <a type="button" class="btn btn-secondary btn-lg" style="width: 190px" href="{{url('/parametre')}}">Parametrer</a>
                                </div>
                                <div class="col-md-4">
                                    <a type="button" class="btn btn-secondary btn-lg" style="width: 190px" href="{{url('/CreationObjet')}}">Entrer en stock</a>
                                </div>
                            </div>
                        <br>
                            <div class="row ">
                                <div class="col-md-8">
                                    <a type="button" class="btn btn-secondary btn-lg" style="width: 190px" href="{{url('/utilisateur')}}">Utilisateurs</a>
                                </div>

                            </div>


                        @endif
                    </div>


                </div>
            </div>
        </div>




        <div class="modal fade" id="modalRendre">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title">Rendre un objet</h2>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{url('/rendreEmprunt/{id}')}}" enctype="multipart/form-data" id="formc">
                            @csrf
                            <input type="hidden" value="" name="idEmprunt" id="idEmprunt">
                            <div class="form-group row">
                                <label for="commentaire" class="col-md-4 col-form-label text-md-right">Commentaire </label>
                                <div class="col-md-6">
                                    <input id="commentaire" type="text" class="form-control" name="commentaire" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="fonctionne" class="col-md-4 col-form-label text-md-right">Etat ?<br>(coché si hors service)</label>
                                <div class="col-md-6">
                                    <input id="fonctionne" type="checkbox" class="form-control" name="fonctionne" value="1">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-5">
                                </div>
                                <div class="col-md-5 ">
                                    <button type="submit" class="btn btn-primary">
                                        Rendre
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalSup">
            <div class="modal-dialog" >
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title">Supprimer un objet</h2>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{url('/supprimer/{id}')}}" enctype="multipart/form-data" id="formc">
                            @csrf
                            <input type="hidden" value="" name="idObjet" id="idObjet" class="idObjet">
                            <div class="row">
                                <div class="col-md-5">
                                </div>
                                <div class="col-md-5 ">
                                    <button type="submit" class="btn btn-primary">
                                        Supprimer
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="modalEmprunter">
            <div class="modal-dialog" >
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title">Emprunter un objet</h2>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{url('/emprunter/{id}')}}" enctype="multipart/form-data" id="formc">
                            @csrf

                            <input type="hidden" value="" name="idObjet" id="idObjet" class="idObjet">
                            <input type="hidden" value="{{session()->get('client')->idUser}}" name="idUser" id="idUser">
                            <input type="hidden" value="<?php echo date("Y-m-d");?>" name="dateDeb" id="dateDeb">
                            <input type="hidden" value="<?php echo date("Y-m-d");?>" name="dateDeb" id="dateDeb">
                            <div class="row">
                                <div class="col-md-5">
                                </div>
                                <div class="col-md-5 ">
                                    <button type="submit" class="btn btn-primary">
                                        Emprunter
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>





        <div class="modal fade" id="modalInfo">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title">Caractéristique d'un objet</h2>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="info">
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="row justify-content" style="height: 1750px; margin-top: 30px" >
        <div class="col-md-1"></div>

        <div class="col-md-7">
            <div class="row">
                <table class="table table-hover table-bordered table-striped datatable text-center" style="width:1500px; ">
                    <thead>
                    <tr>
                        <th>Objet</th>
                        <th>Créateur objet</th>
                        <th>Lié à</th>
                        <th>Armoire</th>
                        <th>Rayon</th>
                        <th class="text-center">Icone</th>
                        <th>Date début d'emprunt</th>
                        <th>Site</th>
                        <th>Secteur</th>
                        <th class="text-center" width="300px">Action</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>


    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">

        function openModal(idEmprunt, e){
            $("#idEmprunt").val(idEmprunt);
        }

        function openModalSup(idObjet, e){
            $(".idObjet").val(idObjet);
        }


        function openModalInfo(idObjet){
            $.ajax({
                url: "{{url('/info')}}",
                type: 'POST',
                data: 'idObjet='+ idObjet + '&_token=' + "{{ csrf_token() }}",
                success: function (htmlll) {
                    $('#info').html(htmlll);
                }
            });
        }


        $(document).ready(function() {
            $.noConflict();
            $.ajax({
                url: "{{url('/checkManque')}}",
                type: 'get',
                success: function (htmll) { // code_html contient le HTML renvoyé
                    $('#manque').html(htmll);
                }
            });
            $.fn.dataTable.ext.errMode = 'throw';
            $('.datatable').DataTable({

                processing: true,
                serverSide: true,
                ajax: '{{ route('getEmpruntAll') }}',
                columns: [
                    {data: 'nomObjet', name: 'nomObjet'},
                    {data: 'fournisseur', name: 'fournisseur'},
                    {data: 'emprunterPar', name: 'emprunterPar',
                        render: function (data) {
                            if (data == null){
                                return "<p style='color: green'><strong>EN STOCK</strong></p>";
                            }else{
                                return data;
                            }

                        }},
                    {data: 'armoire', name: 'armoire',
                        render: function (data, type, row ) {
                            if (data.emprunterPar == null){
                                console.log(data);
                                return data.armoire;
                            }else{
                                return "";
                            }
                        }},
                    {data: 'rayonnage', name: 'rayonnage',
                        render: function (data) {
                            if (data.emprunterPar == null){
                                return data.rayonnage;
                            }else{
                                return "";
                            }
                        }},
                    {data: 'Icone', name: 'Icone',
                        render: function( data, type, row ) {
                            var idObjet = row['idObjet'];
                            return '<a data="'+data+ '" onclick="openModalInfo('+idObjet+ ',event)" id="test"  data-toggle="modal" data-target="#modalInfo"><img src="icon/' + data + '.png"/></a>';
                        }},
                    {data: 'dateDeb', name: 'dateDeb' },
                    {data: 'site', name: 'site'},
                    {data: 'secteur', name: 'secteur'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });
        });


    </script>
@endsection

