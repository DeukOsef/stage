@extends('layouts.layoutConnect')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Connection</div>
                    <div class="card-body">
                        <form method="POST" action="{{url('/update')}}">
                            @csrf

                            <input id="idUser" type="hidden" class="form-control" name="idUser" value="{{$user->idUser}}" readonly>
                            <div class="form-group row">
                                <label for="nom" class="col-sm-4 col-form-label text-md-right">Nom</label>

                                <div class="col-md-6">
                                    <input id="nom" type="text" class="form-control" name="nom" value="{{$user->nom}}" readonly>
                                </div>
                            </div>
                                <div class="form-group row">
                                <label for="prenom" class="col-sm-4 col-form-label text-md-right">Prenom</label>

                                <div class="col-md-6">
                                    <input id="prenom" type="text" class="form-control" name="prenom" value="{{$user->prenom}}" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="login" class="col-sm-4 col-form-label text-md-right">Login</label>

                                <div class="col-md-6">
                                    <input id="login" type="text" class="form-control" name="login" value="{{$user->login}}" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="profil" class="col-sm-4 col-form-label text-md-right">Profil</label>

                                <div class="col-md-6">

                                        <select name="profil" id="profil" class="form-control" >
                                            <option value="1">Administrateur</option>
                                            <option value="2">Utilisateur</option>
                                        </select>

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="poste" class="col-sm-4 col-form-label text-md-right">Poste</label>

                                <div class="col-md-6">
                                    <input id="poste" type="text" class="form-control" name="poste" value="{{$user->poste}}" >
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="num" class="col-sm-4 col-form-label text-md-right">Téléphone</label>

                                <div class="col-md-6">
                                    <input id="num" type="text" class="form-control" name="num" value="{{$user->num}}" >
                                </div>
                            </div>




                            <div class="form-group row mb-0">
                                <div class="col-md-12 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        actualiser
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
