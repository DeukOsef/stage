@extends('layouts.layoutConnect')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
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
                            <div class="row">
                                <div class="col-md-4"></div>
                                <div class="col-md-6">
                                    <a type="button" class="btn btn-secondary btn-lg" style="width: 190px" href="{{url('/creerUser')}}">Créer un utilisateur</a>
                                </div>
                            </div>
                        </div>

                        <br>
                        <div class="col-md-8">
                        <div class="row">
                            <table class="table table-hover table-bordered table-striped datatable text-center" >
                                <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>Login</th>
                                    <th>profil</th>
                                    <th>poste</th>
                                    <th >Site</th>
                                    <th>Secteur</th>
                                    <th style="width: 300px">Action</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">

        // function openModal(idEmprunt, e) {
        //     $("#idEmprunt").val(idEmprunt);
        // }
        $(document).ready(function() {
            $.noConflict();
            $.fn.dataTable.ext.errMode = 'throw';
            $('.datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('getAllUsers') }}',
                columns: [
                    {data: 'nom', name: 'nom'},
                    {data: 'prenom', name: 'prenom'},
                    {data: 'login', name: 'login'},
                    {data: 'profil', name: 'profil',orderable: false, searchable: false},
                    {data: 'poste', name: 'poste'},
                    {data: 'site', name: 'site'},
                    {data: 'secteur', name: 'secteur'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });
        });


    </script>
@endsection

