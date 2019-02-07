@extends('layouts.layoutConnect')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Liste des objets</div>
                    <div class="card-body">

                        <div class="row justify-content" style="height: 750px; margin-top: 30px" >
                            <div class="col-md-1"></div>
                            <div class="col-md-7">
                                <div class="row">
                                    <table class="table table-hover table-bordered table-striped datatable" style="width:650px">
                                        <thead>
                                        <tr>
                                            <th>Objet</th>
                                            <th>Lié à</th>
                                            <th class="text-center">date début d'emprunt</th>
                                            <th>Icone</th>
                                            <th>site</th>
                                            <th class="text-center" width="140px">Imprimer une nouvelle étiquette</th>
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
    </div>
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $.noConflict();
            $('.datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('getEmpruntAll') }}',
                columns: [
                    {data: 'nomObjet', name: 'nomObjet'},
                    {data: 'emprunterPar', name: 'emprunterPar'},
                    {data: 'Icone', name: 'Icone',
                        render: function( data, type, full, meta ) {
                            return "<img src=" + data + "/>";
                        }},
                    {data: 'dateDeb', name: 'dateDeb'},
                    {data: 'site', name: 'site'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });
        });
    </script>
@endsection
