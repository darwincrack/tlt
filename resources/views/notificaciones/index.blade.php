@extends('layouts.template')



@push('css')
<link rel="stylesheet" href="{{ URL::asset('assets/css/plugins/dataTables/dataTables.min.css') }}">
@endpush

@section('title', 'Notificaciones')

@section('content')

    <div class="flash-message">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has('alert-' . $msg))

                <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
            @endif
        @endforeach
    </div> <!-- end .flash-message -->




    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped" id="users-table">

            <thead>
            <tr>
                <th>fecha</th>
                <th>mensaje </th>
                <th>Accion</th>

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
            "initComplete": function(settings, json) {
            noleidos();
        },
            processing: true,
            serverSide: true,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.13/i18n/Spanish.json"
            },
            ajax: 'notificaciones/data',
            "order": [[ 0, "desc" ]],
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
            columns: [
                {data: 'fecha', name: 'fecha'},
                {data: 'mensaje', name: 'mensaje'},
                {data: 'accion', name: 'accion'},


            ],
            pageLength: 25,
            responsive: true,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                { extend: 'copy'},
                {extend: 'csv'},
                {extend: 'excel', title: 'Notificaciones'},
                {extend: 'pdf', title: 'Notificaciones'},

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




$(document).ready(function() {

    $('#users-table tbody').on( 'click', '.mensajenotificacion', function (event) {
    url_base = $("#url_base").val();
        var row = $(this).closest("tr").get(0);
        var id_notificacion=$(row).find( ".mensajenotificacion" ).data("mensajenotificacion");
        var href=$(row).find( ".mensajenotificacion" ).data("link");



$.ajax({
    // la URL para la petición
    url : url_base+"/notificaciones/leido/"+id_notificacion,
 
    // la información a enviar
    // (también es posible utilizar una cadena de datos)
 
    // especifica si será una petición POST o GET
    type: 'GET',
 
 
    // código a ejecutar si la petición es satisfactoria;
    // la respuesta es pasada como argumento a la función
    success : function(data) {

       if ((data.errors)) {
          
                toastr.error("Ocurrio un error", "Error");
            

       }
        else{
                window.location.href = href;


        }


    },
 
    // código a ejecutar si la petición falla;
    // son pasados como argumentos a la función
    // el objeto de la petición en crudo y código de estatus de la petición
    error : function(xhr, status) {
        toastr.error("Disculpe, existió un problema", "Error");
    },
 
});



    });

});























function noleidos(){
   $("tr:has(.noleido)").css("background", "#dfdfdf");

}


</script>
@endpush