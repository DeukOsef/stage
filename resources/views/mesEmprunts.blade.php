@extends('layouts.layoutConnect')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Connection</div>
                    <div class="card-body">

                        <div class="row justify-content" style="height: 750px; margin-top: 30px" >
                            <div class="col-md-1"></div>
                            <div class="col-md-7">
                                <div class="row">
                                    <table class="table table-hover table-bordered table-striped datatable" style="width:650px">
                                        <thead>
                                        <tr>
                                            <th>idEmprunt</th>
                                            <th>Objet</th>
                                            <th>Emprunté par</th>
                                            <th>date du debut de l'emprunt</th>
                                            <th>Date de fin de l'emprunt</th>
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
    </div>

    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {

            $.noConflict();
            $('.datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('getEmprunt') }}',
                columns: [
                    {data: 'idEmprunt', name: 'idEmprunt'},
                    {data: 'nomObjet', name: 'nomObjet'},
                    {data: 'prenom', name: 'prenom'},
                    {data: 'dateDeb', name: 'dateDeb'},
                    {data: 'dateFin', name: 'dateFin'},
                    {data: 'etat', name: 'etat'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                    ]
            });
        });
    </script>
@endsection
