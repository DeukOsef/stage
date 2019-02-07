@extends('layouts.layoutConnect')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card" id="card">
                    <div id="testt" class="card-header">Nouvel emprunt</div>
                    <div id="formm" class="card-body" style="border: solid #DFDFDF">
                        {{--<form method="POST" action="{{url('/emprunt')}}" enctype="multipart/form-data">--}}
                            @csrf
                            @if(session('demenv'))
                                <div class="form-group row">
                                    <label class="col-sm-12 col-form-label text-md-center"style="color: red"><b>{{session('demenv')}}</b></label>
                                </div>
                            @endif

                            {{--AUTOCOMPLETE AJAX--}}
                            {{--<div class="form-group row">--}}
                                {{--<label for="name" class="col-md-4 col-form-label text-md-right">Agent</label>--}}
                                {{--<div class="col-md-6">--}}
                                    {{--<input id="name" class="ui-autocomplete-input" autocomplete="off" role="textbox" name="name" aria-autocomplete="list" aria-haspopup="true">--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            {{--DROPDOWN WITH SEARCH--}}
                            <div class="form-group row">
                                <label for="idUser" class="col-md-4 col-form-label text-md-right">Agent</label>
                                <div class="col-md-6">
                                    <input list="listUser" name="idUser" id="idUser" class="form-control" required>
                                    <datalist id="listUser">
                                        @foreach($noms as $test)
                                        <option data-value="{{ $test->idUser }}" value="{{ $test->prenom." ".$test->nom}}">{{ $test->prenom." ".$test->nom}}</option>
                                        @endforeach
                                    </datalist>
                                    {{--<select name="idUser" id="idUser" class="form-control" required>--}}
                                        {{--@foreach($noms as $test)--}}
                                            {{--<option value="{{ $test->idUser }}">{{ $test->prenom." ".$test->nom}}</option>--}}
                                        {{--@endforeach--}}
                                    {{--</select>--}}
                                </div>
                            </div>

                            <div class="row">
                                <label for="codeB"  class="col-md-4 col-form-label text-md-right">Code barre</label>
                                <div class="col-md-6">
                                    <input id="codeB" type="text" class="form-control" style="color:#495057; background-color:#E9ECEF; border-color:#ced4da; outline:0; -webkit-box-shadow:none;box-shadow:none;" name="codeB" value="">
                                </div>
                                <div class="col-md-2">
                                    <a onclick="openModalInfo(event)" id="infoObjet" data-toggle="modal" data-target="#modalInfoObjet" style="display: none;" ><i class="fa fa-info-circle" style="font-size:24px;"></i></a>
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
                                    <button id="submit" type="submit" class="btn btn-primary">
                                        Envoyer la demande
                                    </button>
                                </div>
                            </div>
                        {{--</form>--}}
                    </div>
                </div>
            </div>
        </div>
        <div id="ccc"></div>


        <div class="modal fade" id="modalInfoObjet">
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

    <script>



        function openModalInfo(){
            var codeB = $("#codeB").val();
            $.ajax({
                url: "{{url('/infoWithCodeB')}}",
                type: 'POST',
                data: 'codeB='+ codeB + '&_token=' + "{{ csrf_token() }}",
                success: function (htmlll) {
                    $('#info').html(htmlll);
                }
            });
        }

        $(document).ready(function() {

            $('#codeB').on('change', function(e) {
                var codeB = $("#codeB").val();
                if(codeB.length != 0){
                    $("#infoObjet").show();
                }else{
                    $("#infoObjet").css('display', 'none');
                }
            });

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

            var data = {};
            $("#listUser option").each(function(i,el) {
                data[$(el).data("value")] = $(el).val();
            });
            console.log(data, $("#listUser option").val());


            $('#submit').click(function(e)
            {
                e.preventDefault();
                var value = $('#idUser').val();
                var idUser = $('#listUser [value="' + value + '"]').data('value');
                var objet = $('#objet').val();
                var dateDeb = $('#dateDeb').val();
                var codeB = $('#codeB').val();

                $.ajax({
                    url: "{{url('/emprunt')}}",
                    type: 'POST',
                    data: '&idUser=' + idUser + '&objet=' + objet + '&dateDeb=' + dateDeb + '&codeB=' + codeB + '&_token=' + "{{ csrf_token() }}",
                    success: function (html) { // code_html contient le HTML renvoyé
                        window.location.href = "{{url('/accueilbis')}}";
                    }
                });
            });

            {{--$('#name').on('keyup', function(e) {--}}
                {{--e.preventDefault();--}}
                {{--var name = $('#name').val();--}}
                {{--if(name.length > 4){--}}
                    {{--$.ajax({--}}
                        {{--url: "{{url('/getName')}}",--}}
                        {{--type: 'POST',--}}
                        {{--data: 'name=' + name + '&_token=' + "{{ csrf_token() }}",--}}
                        {{--success: function (html) { // code_html contient le HTML renvoyé--}}
                            {{--$('#name').val(html);--}}
                        {{--}--}}
                    {{--});--}}
                {{--}--}}

            {{--});--}}




        });
    </script>
@endsection