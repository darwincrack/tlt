@extends('layouts.template')



    @push('boton_accion')
    <a href="{{ url('/personal/add') }}" class="btn btn-primary">
        <span class="glyphicon glyphicon-plus"></span>
        Nuevo Personal
    </a>
    @endpush



@push('css')
<link rel="stylesheet" href="{{ URL::asset('assets/css/plugins/dataTables/dataTables.min.css') }}">
@endpush

@section('title', 'Personal')

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
            <th>Nro empleado</th>
            <th>ubicación</th>
            <th>Departamento</th>
            <th>Cargo</th>
            <th>Action</th>
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
            ajax: 'personal/data',
            "order": [[ 0, "desc" ]],
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
            columns: [
                {data: 'idPersonal', name: 'idPersonal'},
                {data: 'nombre', name: 'nombre'},      
                {data: 'nro_empleado', name: 'nro_empleado'},
                {data: 'ubicacion', name: 'ubicacion'},
                {data: 'departamento', name: 'departamento'},
                {data: 'cargo', name: 'cargo'},
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
                {extend: 'excel', title: 'Reporte de Personal', exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
                }},
                {extend: 'pdf', title: 'Reporte de Personal',  exportOptions: {
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

</script>

@endpush