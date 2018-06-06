@extends('layouts.template')



    @push('boton_accion')
    <a href="{{ url('/articulos/add') }}" class="btn btn-primary">
        <span class="glyphicon glyphicon-plus"></span>
        Nuevo Articulos
    </a>
    @endpush



@push('css')
<style>
    .label-primary.green, .badge-primary.green {
    background-color: #1ab394;
    color: #FFFFFF;
}


</style>


<link rel="stylesheet" href="{{ URL::asset('assets/css/plugins/dataTables/dataTables.min.css') }}">
@endpush

@section('title', 'Articulos')

@section('content')

    <div class="flash-message">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has('alert-' . $msg))

                <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
            @endif
        @endforeach
    </div> <!-- end .flash-message -->




    <div class="table-responsive">
    <table class="table table-bordered table-hover table-striped table-center" id="users-table">

        <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Modelo</th>
            <th>Serial</th>
            <th>Marca</th>
            <th>Cod de barras</th>
            <th>Ubicación</th>
            <th>Estado</th>
            <th>Acción</th>

        </tr>
        </thead>
    </table>

    </div>
@stop

@push('scripts')


<script src="{{ URL::asset('assets/js/plugins/dataTables/datatables.min.js') }}"></script>
<script>
    $(function() {
        $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.13/i18n/Spanish.json"
            },
            ajax: 'articulos/data',
            "order": [[ 0, "desc" ]],
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
            columns: [
                {data: 'idArticulo', name: 'idArticulo'},
                {data: 'nombre_articulo', name: 'nombre_articulo'},      
                {data: 'modelo', name: 'modelo'},
                {data: 'serial', name: 'serial'},
                {data: 'marca', name: 'marca'},
                {data: 'codigo_barra', name: 'codigo_barra'},
                 {data: 'nombre_ubicacion', name: 'nombre_ubicacion'},
                 {data: 'nombre_estado', name: 'nombre_estado'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ],
            pageLength: 25,
            responsive: true,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                { extend: 'copy', exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
                }},
                {extend: 'csv', exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
                }},
                {extend: 'excel', title: 'Reporte de Articulos', exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
                }},
                {extend: 'pdf', title: 'Reporte de Articulos',  exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
                }},

                {extend: 'print',
                    customize: function (win){
                        $(win.document.body).addClass('white-bg');
                        $(win.document.body).css('font-size', '10px');

                        $(win.document.body).find('table')
                                .addClass('compact')
                                .css('font-size', 'inherit');
                    }
                }
            ]
        });
    });




$( window ).load(function() {
 $('div.dataTables_filter input').focus();
});
</script>

@endpush