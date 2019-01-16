@extends('layouts.layoutConnect')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Accueil</div>
                    <div class="card-body">
                        @if(session('demenv'))
                            <div class="form-group row">
                                <label class="col-sm-12 col-form-label text-md-center"style="color: green"><b>{{session('demenv')}}</b></label>
                            </div>
                        @endif
                        <div class="container">
                            <div class="row ">
                                <div class="col-md-8">
                                    <a type="button" class="btn btn-secondary btn-lg" style="width: 190px" href="{{url('/emprunter')}}">Emprunter</a>
                                </div>
                                <div class="col-md-4">
                                    <a type="button" class="btn btn-secondary btn-lg" style="width: 190px" href="{{url('/mesEmprunts')}}">Mes emprunts</a>
                                </div>
                            </div>
                            <br>
                            <div class="row ">
                                <div class="col-md-8">
                                    <a type="button" class="btn btn-secondary btn-lg" style="width: 190px" href="{{url('/listeObjets')}}">Liste des objets</a>
                                </div>
                                <div class="col-md-4">
                                    <a type="button" class="btn btn-secondary btn-lg" style="width: 190px" href="{{url('/CreationObjet')}}">Créer un Objet</a>
                                </div>
                            </div>
                            <br>
                            <div class="row ">
                                <div class="col-md-4">
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

