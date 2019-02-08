@extends('layouts.layoutConnect')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Connection</div>
                    <div class="card-body">
                        <form method="POST" action="{{url('/create')}}">
                            @csrf

                            <div class="form-group row">
                                <label for="nom" class="col-sm-4 col-form-label text-md-right">Nom</label>

                                <div class="col-md-6">
                                    <input id="nom" type="text" class="form-control" name="nom" value="" required >
                                </div>
                            </div>
                                <div class="form-group row">
                                <label for="prenom" class="col-sm-4 col-form-label text-md-right">Prenom</label>

                                <div class="col-md-6">
                                    <input id="prenom" type="text" class="form-control" name="prenom" value="" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="login" class="col-sm-4 col-form-label text-md-right">Login</label>

                                <div class="col-md-6">
                                    <input id="login" type="text" class="form-control" name="login" value="" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-sm-4 col-form-label text-md-right">Mot de passe</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" value="" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="matricule" class="col-sm-4 col-form-label text-md-right">Matricule</label>

                                <div class="col-md-6">
                                    <input id="matricule" type="text" class="form-control" name="matricule" value="" required maxlength="11">
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
                                    <input id="poste" type="text" class="form-control" name="poste" value="" required >
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="num" class="col-sm-4 col-form-label text-md-right">Téléphone</label>

                                <div class="col-md-6">
                                    <input id="num" type="text" class="form-control" name="num" value="" required maxlength="10">
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
