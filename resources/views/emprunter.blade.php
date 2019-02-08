@extends('layouts.layoutConnect')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card" id="card">
                    <div id="testt" class="card-header">Nouvel emprunt</div>
                    <div id="formm" class="card-body" style="border: solid #DFDFDF">
                        <form method="POST" action="{{url('/emprunt')}}" enctype="multipart/form-data">
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
                                <label for="codeB"  class="col-md-4 col-form-label text-md-right">Code barre 1</label>
                                <div class="col-md-6">
                                    <input id="codeB" type="text" class="form-control"  name="codeB" value="">
                                </div>
                                <div class="col-md-2">
                                    <a onclick="openModalInfo(event)" id="infoObjet" data-toggle="modal" data-target="#modalInfoObjet" style="display: none;" ><i class="fa fa-info-circle" style="font-size:24px;"></i></a>
                                </div>
                            </div>

                        <div class="row">
                            <label for="codeB1"  class="col-md-4 col-form-label text-md-right">Code barre 2</label>
                            <div class="col-md-6">
                                <input id="codeB1" type="text" class="form-control"  name="codeB1" value="">
                            </div>
                            <div class="col-md-2">
                                <a onclick="openModalInfo1(event)" id="infoObjet1" data-toggle="modal" data-target="#modalInfoObjet1" style="display: none;" ><i class="fa fa-info-circle" style="font-size:24px;"></i></a>
                            </div>
                        </div>

                        <div class="row">
                            <label for="codeB2"  class="col-md-4 col-form-label text-md-right">Code barre 3</label>
                            <div class="col-md-6">
                                <input id="codeB2" type="text" class="form-control"  name="codeB2" value="">
                            </div>
                            <div class="col-md-2">
                                <a onclick="openModalInfo2(event)" id="infoObjet2" data-toggle="modal" data-target="#modalInfoObjet2" style="display: none;" ><i class="fa fa-info-circle" style="font-size:24px;"></i></a>
                            </div>
                        </div>

                        <div class="row">
                            <label for="codeB3"  class="col-md-4 col-form-label text-md-right">Code barre 4</label>
                            <div class="col-md-6">
                                <input id="codeB3" type="text" class="form-control" name="codeB3" value="">
                            </div>
                            <div class="col-md-2">
                                <a onclick="openModalInfo3(event)" id="infoObjet3" data-toggle="modal" data-target="#modalInfoObjet3" style="display: none;" ><i class="fa fa-info-circle" style="font-size:24px;"></i></a>
                            </div>
                        </div>

                        <div class="row">
                            <label for="codeB4"  class="col-md-4 col-form-label text-md-right">Code barre 5</label>
                            <div class="col-md-6">
                                <input id="codeB4" type="text" class="form-control" name="codeB4" value="">
                            </div>
                            <div class="col-md-2">
                                <a onclick="openModalInfo4(event)" id="infoObjet4" data-toggle="modal" data-target="#modalInfoObjet4" style="display: none;" ><i class="fa fa-info-circle" style="font-size:24px;"></i></a>
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
                        </form>
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


    <div class="modal fade" id="modalInfoObjet1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title">Caractéristique d'un objet</h2>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="info1">
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>


    <div class="modal fade" id="modalInfoObjet2">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title">Caractéristique d'un objet</h2>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="info2">
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>


    <div class="modal fade" id="modalInfoObjet3">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title">Caractéristique d'un objet</h2>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="info3">
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>


    <div class="modal fade" id="modalInfoObjet4">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title">Caractéristique d'un objet</h2>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="info4">
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

        function openModalInfo1(){
            var codeB1 = $("#codeB1").val();
            $.ajax({
                url: "{{url('/infoWithCodeB')}}",
                type: 'POST',
                data: 'codeB='+ codeB1 + '&_token=' + "{{ csrf_token() }}",
                success: function (htmlll1) {
                    $('#info1').html(htmlll1);
                }
            });
        }


        function openModalInfo2(){
            var codeB2 = $("#codeB2").val();
            $.ajax({
                url: "{{url('/infoWithCodeB')}}",
                type: 'POST',
                data: 'codeB='+ codeB2 + '&_token=' + "{{ csrf_token() }}",
                success: function (htmlll2) {
                    $('#info2').html(htmlll2);
                }
            });
        }


        function openModalInfo3(){
            var codeB3 = $("#codeB3").val();
            $.ajax({
                url: "{{url('/infoWithCodeB')}}",
                type: 'POST',
                data: 'codeB='+ codeB3 + '&_token=' + "{{ csrf_token() }}",
                success: function (htmlll3) {
                    $('#info3').html(htmlll3);
                }
            });
        }

        function openModalInfo4(){
            var codeB4 = $("#codeB4").val();
            $.ajax({
                url: "{{url('/infoWithCodeB')}}",
                type: 'POST',
                data: 'codeB='+ codeB4 + '&_token=' + "{{ csrf_token() }}",
                success: function (htmlll4) {
                    $('#info4').html(htmlll4);
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

            $('#codeB1').on('change', function(e) {
                var codeB1 = $("#codeB1").val();
                if(codeB1.length != 0){
                    $("#infoObjet1").show();
                }else{
                    $("#infoObjet1").css('display', 'none');
                }
            });

            $('#codeB2').on('change', function(e) {
                var codeB2 = $("#codeB2").val();
                if(codeB2.length != 0){
                    $("#infoObjet2").show();
                }else{
                    $("#infoObjet2").css('display', 'none');
                }
            });

            $('#codeB3').on('change', function(e) {
                var codeB3 = $("#codeB3").val();
                if(codeB3.length != 0){
                    $("#infoObjet3").show();
                }else{
                    $("#infoObjet3").css('display', 'none');
                }
            });

            $('#codeB4').on('change', function(e) {
                var codeB4 = $("#codeB4").val();
                if(codeB4.length != 0){
                    $("#infoObjet4").show();
                }else{
                    $("#infoObjet4").css('display', 'none');
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


            $('#testttt').click(function(e)
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