@extends('layouts.layoutConnect')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Connection</div>
                    <div class="card-body">
                        VOUS ETES CONNECTES
                        <div class="row justify-content" style="height: 750px; margin-top: 30px" >
                            <div class="col-md-1"></div>
                            <div class="col-md-7">
                                <div class="row">
                                    <table class="table table-hover table-bordered table-striped datatable">
                                        <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Nom</th>
                                            <th>Prenom</th>
                                            <th>Date Debut</th>
                                            <th>Date Fin</th>
                                            <th>id Objet</th>
                                            <th>type</th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
