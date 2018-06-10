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


.onoffswitch-inner:before {
    content: "SI";

}


.onoffswitch-inner:after {
    content: "NO";

}

</style>
<link rel="stylesheet" href="{{ URL::asset('assets/css/plugins/toastr/toastr.min.css') }}">

<link rel="stylesheet" href="{{ URL::asset('assets/css/plugins/dataTables/dataTables.min.css') }}">
@endpush

@section('title', 'Solicitudes Artículos')

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
            <th>Cod de barras</th>
            <th>Motivo</th>
            <th>Fecha de Solicitud</th>
            <th>Tipo de Solicitud</th>
            <th>Estado</th>
            <th>Acción</th>
            @role(['admin']) 
              <th>Autorizar Informatica</th>
            @endrole

        </tr>
        </thead>
    </table>

    </div>




                            <div class="modal inmodal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content animated bounceInRight">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <i class="fa fa-shopping-cart modal-icon"></i>
                                            <h4 class="modal-title">Editar o Eliminar</h4>
                                            <small class="font-bold">Solicitar al administrador del sistema la edición o eliminar de algún artículo</small>
                                        </div>
                                        <div class="modal-body">
                                        <label for="tipo de solicitud">Tipo de solicitud:</label>
                                            <select class="form-control" class="form-control m-b" name="tipo_accion" id="tipo_accion" >
                                                <option value="1">Editar</option>
                                                <option value="2">Eliminar</option>

                                            </select>

                                            <div class="form-group">
                                                  <label for="comment">Motivo:</label>
                                                  <textarea  id="motivo" class="form-control" rows="5" ></textarea>
                                            </div>
                                                    
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-white" data-dismiss="modal">Cerrar</button>
                                            <button type="button" id="guardar" class="btn btn-primary">Guardar</button>

                                            <input type="hidden" id="idx" value="">
                                        </div>
                                    </div>
                                </div>
                            </div>





@stop

@push('scripts')


<script src="{{ URL::asset('assets/js/plugins/toastr/toastr.min.js') }}"></script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script src="{{ URL::asset('assets/js/plugins/dataTables/datatables.min.js') }}"></script>
<script>
    $(function() {
        $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.13/i18n/Spanish.json"
            },
            ajax: 'solicitudesarticulos/data',
            "order": [[ 0, "desc" ]],
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
            columns: [
                {data: 'idSolicitud', name: 'idSolicitud'},
                {data: 'nombre_articulo', name: 'nombre_articulo'},    
                {data: 'codigo_barra', name: 'codigo_barra'},
                {data: 'motivo', name: 'motivo', "width": "27%"},
                {data: 'fecha_solicitud', name: 'fecha_solicitud'},


                {data: 'nombre_tipo_accion', name: 'nombre_tipo_accion', "width": "3%"},
                {data: 'status', name: 'status'},
                {data: 'ver_articulo', name: 'ver_articulo', orderable: false, searchable: false, "width": "14%"}
                @role(['admin']) 
                ,{data: 'autorizar_informatica', name: 'autorizar_informatica', orderable: false, searchable: false, "width": "3%"}
                @endrole


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











$(document).ready(function() {
var table = $('#users-table').DataTable();
 
    $('#users-table tbody').on( 'click', '.delete', function (event) {
event.preventDefault();


swal({
  title: "Estas seguro?",
  text: "Una vez que se elimine, no podra recuperar este articulo",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
    if (willDelete) {

   var row = $(this).closest("tr").get(0);
            var id=$(row).find( ".delete" ).data("eliminar");
            var sa=$(row).find( ".delete" ).data("eliminarsolicitud");
            $.get("articulos/delete/"+id+"/"+sa, function(data, status){
            swal("Eliminado con exito!!", {
            icon: "success",
            }).then((e) => {
                if (e) {
                    location.reload();
                }

            });


                
            });


    }
         

});






    });






    $('#users-table tbody').on( 'click', '.eliminaredit', function (event) {

        var row = $(this).closest("tr").get(0);
        var id=$(row).find( ".eliminaredit" ).data("eliminaredit");
        $("#idx").val(id);
        console.log($("#idx").val());
    });



    $('#users-table tbody').on( 'click', '.onoffswitch-checkbox', function (event) {
        var valor = 0;
        var row = $(this).closest("tr").get(0);
        var id=$(row).find( ".onoffswitch-checkbox" ).data("autorizarinformatica");
        var valor =$(row).val();



        if( $(row).find( ".onoffswitch-checkbox" ).prop('checked') ) {
            valor = 1;
        }
        else{
            valor = '0';

        }



    toasterOptions();


$.ajax({
    // la URL para la petición
    url : 'solicitudesarticulos/autorizarinformatica/'+id+"/"+valor,
 
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
            toastr.success("Petición enviada satisfactoriamente", "Exito!!");


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














$('.modal-footer').on('click', '#guardar', function() {
    toasterOptions();


$.ajax({
    // la URL para la petición
    url : 'solicitudesarticulos/add',
 
    // la información a enviar
    // (también es posible utilizar una cadena de datos)
    data: {
            '_token': $('input[name=_token]').val(),
            'tipo_accion': $('#tipo_accion').val(),
            'motivo': $('#motivo').val(),
            'id': $('#idx').val(),
         },
 
    // especifica si será una petición POST o GET
    type: 'POST',
 
 
    // código a ejecutar si la petición es satisfactoria;
    // la respuesta es pasada como argumento a la función
    success : function(data) {

       if ((data.errors)) {
            if (data.errors.motivo) {
                toastr.error(data.errors.motivo, "Error");
            }

       }
        else{
            toastr.success("Notificación enviada satisfactoriamente", "Exito!!");
            $('#myModal').modal('hide');
        }











       /* $('<h1/>').text(json.title).appendTo('body');
        $('<div class="content"/>')
            .html(json.html).appendTo('body');*/
    },
 
    // código a ejecutar si la petición falla;
    // son pasados como argumentos a la función
    // el objeto de la petición en crudo y código de estatus de la petición
    error : function(xhr, status) {
        toastr.error("Disculpe, existió un problema", "Error");
    },
 
    // código a ejecutar sin importar si la petición falló o no
   /* complete : function(xhr, status) {
        alert('Petición realizada');
    }*/
});






});







function toasterOptions() {
    toastr.options = {
  "closeButton": true,
  "debug": false,
  "progressBar": true,
  "preventDuplicates": false,
  "positionClass": "toast-top-right",
  "onclick": null,
  "showDuration": "400",
  "hideDuration": "1000",
  "timeOut": "7000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
    };
};













 
});



</script>

@endpush