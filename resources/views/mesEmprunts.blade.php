@extends('layouts.layoutConnect')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Connection</div>
                    <div class="card-body">

                        <div class="row justify-content" style="margin-top: 30px" >
                            <div class="col-md-12">
                                <div class="row">
                                    <table class="table table-hover table-bordered table-striped datatable text-center" style="width: 1100px">
                                        <thead>
                                        <tr>
                                            <th>nomObjet</th>
                                            <th>Icone</th>
                                            <th>Site</th>
                                            <th>Agent</th>
                                            <th>dateDeb</th>
                                            <th>DateFin</th>
                                            <th>Etat</th>
                                            <th>Rendre</th>
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
    </div>

    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">

        function openModal(idEmprunt, e){
            $("#idEmprunt").val(idEmprunt);
        }

        $(document).ready(function() {



            $.noConflict();
            $('.datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('getEmprunt') }}',
                columns: [
                    {data: 'nomObjet', name: 'nomObjet'},
                    {data: 'Icone', name: 'Icone',
                        render: function( data) {
                            return "<img src=" + data + "/>";
                        }},
                    {data: 'Site', name: 'Site'},
                    {data: 'prenom',
                        render: function( data, type, row ) {
                            return row['prenom'] +' '+ row['nom'];
                        }},
                    {data: 'dateDeb', name: 'dateDeb'},
                    {data: 'dateFin', name: 'dateFin'},
                    {data: 'etat', name: 'etat'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                    ]
            });
        });
    </script>
@endsection
