$( document ).ready(function() {
  // Handler for .ready() called.
url_base = $("#url_base").val();

setInterval(IniciarNotificaciones, 20000);
setInterval(ListaNotificaciones, 20000);


IniciarNotificaciones();
 ListaNotificaciones();


function IniciarNotificaciones() {
    $.getJSON(url_base+"/notificaciones/count", function(result){
        $.each(result, function(i, field){
        	if(field.total==0){
        		$("#count_notificaciones").css("display","none");
        	}
        	else{
        		 $("#count_notificaciones").html(field.total);
        		 $("#count_notificaciones").css("display","block");

        	}
        });
    });
}



function ListaNotificaciones() {
var text="";
$("#lista_notificaciones").empty();
    $.getJSON(url_base+"/notificaciones/listar", function(result){
        $.each(result, function(i, field){
		
		text = "<li class='divider'></li>";
		text += "<li class=leido_"+field.leido+"><a href='"+url_base+"/"+field.url+"' class='mensaje' data-mensaje='"+field.id+"'>";
		text += "<div class='dropdown-messages-box'>";
		text += "<div class='media-body'>";
		text += field.mensaje+"<br>";
		text += "<small class='text-muted'>"+field.fecha+"</small>";
		text += "</div>"; 
		text += "</div>";
		text += "</a>";
		text += "</li>";

		$("#lista_notificaciones").append(text);
        });


if(result.length >0){
		text = "<li class='divider'></li>";
		text += "<li>";
		text += " <div class='text-center link-block'>";
		text += "<a href='"+url_base+"/notificaciones'>";
		text += "<i class='fa fa-envelope'></i>";
		text += "<strong>Ver todos los mensajes</strong>";
		text += "</a></div></li>";

		$("#lista_notificaciones").append(text);
}
    });
}





   $('#lista_notificaciones').on( 'click', '.mensaje', function (event) {


   	event.preventDefault();

   	var id_notificacion=$(this).data("mensaje");

   	var href = $(this).attr('href');


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