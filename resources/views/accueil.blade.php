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
                                <label class="col-sm-12 col-form-label text-md-center"style="color: red"><b><i class="fa fa-warning" style="font-size:24px;"></i><img src="icon/dgr.png">{{session('demenv')}}</b></label>
                            </div>
                        @endif
                            @if(session('emprunt'))
                            <div class="form-group row">
                                <label class="col-sm-12 col-form-label text-md-center"style="color: green"><b>{{session('emprunt')}}</b></label>
                            </div>
                        @endif
                        <div class="container">
                            <div class="row ">
                                <div class="col-md-8">
                                    <a type="button" class="btn btn-secondary btn-lg" style="width: 190px" href="{{url('/emprunter')}}">Retrait du stock</a>
                                </div>
                                <div class="col-md-4">
                                    <a type="button" class="btn btn-secondary btn-lg" style="width: 190px" href="{{url('/parametre')}}">parametrer</a>
                                </div>
                            </div>
                            <br>
                            <div class="row ">
                                <div class="col-md-8">
                                    <a type="button" class="btn btn-secondary btn-lg" style="width: 190px" href="{{url('/')}}">Cartographie</a>
                                </div>
                                <div class="col-md-4">
                                    <a type="button" class="btn btn-secondary btn-lg" style="width: 190px" href="{{url('/CreationObjet')}}">Entrer en stock</a>
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
                    <table class="table table-hover table-bordered table-striped datatable text-center" id="table" style="width:1000px; ">
                        <thead>
                        <tr>
                            <th>Objet</th>
                            <th>Créateur objet</th>
                            <th>Lié à</th>
                            <th class="text-center">Icone</th>
                            <th>date début d'emprunt</th>
                            <th>Site</th>
                            <th>Secteur</th>
                            <th class="text-center" width="250px">Action</th>
                        </tr>
                        </thead>
                    </table>
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
                            <label for="fonctionne" class="col-md-4 col-form-label text-md-right">Etat ?<br>(hors service si coché)</label>
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
                        <input type="hidden" value="" name="idObjet" id="idObjet">
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


    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">

        function openModal(idEmprunt, e){
            $("#idEmprunt").val(idEmprunt);
        }

        function openModalSup(idObjet, e){
            $("#idObjet").val(idObjet);
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
                            return "<p style='color: green'><strong>EN STOCK</strong></p>"
                        }else{
                            return data;
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

