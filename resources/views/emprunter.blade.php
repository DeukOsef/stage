@extends('layouts.layoutConnect')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Nouvel emprunt</div>
                    <div class="card-body">
                        <form method="POST" action="{{url('/emprunt')}}" enctype="multipart/form-data">
                            @csrf
                            @if(session('demenv'))
                                <div class="form-group row">
                                    <label class="col-sm-12 col-form-label text-md-center"style="color: red"><b>{{session('demenv')}}</b></label>
                                </div>
                            @endif

                            <div class="form-group row">

                                <input id="idUser" type="hidden" name="idUser" value="{{session()->get('client')->idUser }}">
                                <label for="nom" class="col-sm-3 col-form-label text-md-right"></label>

                                <div class="col-md-3">
                                    <input id="prenom" type="text" class="form-control" style="color:#495057; background-color:#E9ECEF; border-color:#ced4da; outline:0; -webkit-box-shadow:none;box-shadow:none;" name="prenom" value="{{ session()->get('client')->prenom }}" readonly>
                                </div>
                                <div class="col-md-3">
                                    <input id="nom" type="text" class="form-control" style="color:#495057; background-color:#E9ECEF; border-color:#ced4da; outline:0; -webkit-box-shadow:none;box-shadow:none;" name="nom" value="{{session()->get('client')->nom }}"readonly>
                                </div>
                            </div>

                            <div class="row">
                                <label for="codeB" class="col-md-4 col-form-label text-md-right">Code barre</label>
                                <div class="col-md-6">
                                    <input id="codeB" type="text" class="form-control" style="color:#495057; background-color:#E9ECEF; border-color:#ced4da; outline:0; -webkit-box-shadow:none;box-shadow:none;" name="codeB" value="">
                                </div>
                            </div>
                            <br>
                            <div class="form-group row">
                                <label for="dateDeb" class="col-md-4 col-form-label text-md-right">date debut</label>

                                <div class="col-md-6">
                                    <input id="dateDeb" type="date" class="form-control" name="dateDeb" value="<?php echo date("Y-m-d");?>" required>
                                </div>
                            </div>
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
                            <div class="form-group row">
                                <label for="objet" class="col-md-4 col-form-label text-md-right">Objet</label>
                                <div class="col-md-6">
                                    <select name="objet" id="objet" class="form-control" required>
                                        <option >--Selectionnez un objet--</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-12 offset-md-4">
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

                $.ajax({
                    url: "{{url('/loadObjet')}}",
                    type: 'POST',
                    data: 'numType=' + numType + '&_token=' + "{{ csrf_token() }}",
                    success: function (html) { // code_html contient le HTML renvoyé
                        $('#objet').html(html);
                    }
                });

            });
        });
    </script>
@endsection
