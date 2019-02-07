@extends('layouts.layoutConnect')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Paramètre</div>
                    <div class="card-body">
                        <form method="POST" action="{{url('/parametrage')}}">
                            @csrf
                            <h5 class="card-title text-center">quantité Minimum avant alerte message</h5>
                            <br>
                            <div class="form-group row">
                                <label for="limite1" class="col-sm-4 col-form-label text-md-right">Unité central</label>
                                <div class="col-md-6">
                                    <input id="limite1" type="text" class="form-control" name="limite1" value="{{ $limite1->limite }}" required autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="limite2" class="col-sm-4 col-form-label text-md-right">Imprimante</label>
                                <div class="col-md-6">
                                    <input id="limite2" type="text" class="form-control" name="limite2" value="{{ $limite2->limite }}" required autofocus>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="limite3" class="col-sm-4 col-form-label text-md-right">Téléphone portable</label>
                                <div class="col-md-6">
                                    <input id="limite3" type="text" class="form-control" name="limite3" value="{{ $limite3->limite }}" required autofocus>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="limite4" class="col-sm-4 col-form-label text-md-right">Tablette</label>
                                <div class="col-md-6">
                                    <input id="limite4" type="text" class="form-control" name="limite4" value="{{ $limite4->limite }}" required autofocus>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="limite5" class="col-sm-4 col-form-label text-md-right">Ecran</label>
                                <div class="col-md-6">
                                    <input id="limite5" type="text" class="form-control" name="limite5" value="{{ $limite5->limite }}" required autofocus>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="limite6" class="col-sm-4 col-form-label text-md-right">Clavier</label>
                                <div class="col-md-6">
                                    <input id="limite6" type="text" class="form-control" name="limite6" value="{{ $limite6->limite }}" required autofocus>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="limite7" class="col-sm-4 col-form-label text-md-right">Pc portable</label>
                                <div class="col-md-6">
                                    <input id="limite7" type="text" class="form-control" name="limite7" value="{{ $limite7->limite }}" required autofocus>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="limite8" class="col-sm-4 col-form-label text-md-right">Switch</label>
                                <div class="col-md-6">
                                    <input id="limite8" type="text" class="form-control" name="limite8" value="{{ $limite8->limite }}" required autofocus>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="limite9" class="col-sm-4 col-form-label text-md-right">Cable réseau</label>
                                <div class="col-md-6">
                                    <input id="limite9" type="text" class="form-control" name="limite9" value="{{ $limite9->limite }}" required autofocus>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="limite10" class="col-sm-4 col-form-label text-md-right">Multiprise</label>
                                <div class="col-md-6">
                                    <input id="limite10" type="text" class="form-control" name="limite10" value="{{ $limite10->limite }}" required autofocus>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="limite11" class="col-sm-4 col-form-label text-md-right">VideoProjecteur</label>
                                <div class="col-md-6">
                                    <input id="limite11" type="text" class="form-control" name="limite11" value="{{ $limite11->limite }}" required autofocus>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="limite12" class="col-sm-4 col-form-label text-md-right">Autre</label>
                                <div class="col-md-6">
                                    <input id="limite12" type="text" class="form-control" name="limite12" value="{{ $limite12->limite }}" required autofocus>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-12 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Valider les paramètres
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
