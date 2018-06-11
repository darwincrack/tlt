<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title></title>

  <style type="text/css">
  </style>    
</head>
<body style="">
  <center>
    <table width="400px" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td  valign="top" width="40%"><strong>Nombre:</strong></td>
            <td  valign="top" width="60%">{{$data->nombre_articulo}}</td>
        </tr>
        <tr>
            <td  valign="top" width="40%"><strong>Cod. de barra:</strong></td>
            <td  valign="top" width="60%">{{$data->codigo_barra}}</td>
        </tr>
        <tr>
            <td  valign="top" width="40%"><strong>Motivo: </strong></td>
            <td  valign="top" width="60%">{{$data->motivo}}</td>
        </tr>
        <tr>
            <td  valign="top" width="40%"><strong>Tipo de Acción:</strong></td>
            <td  valign="top" width="60%">{{strtoupper($data->nombre_tipo_accion)}}</td>
        </tr>
         <tr>
            <td colspan="2"  valign="top" width="100%"><center><strong> <a style="text-align: center" href="{{ url('solicitudesarticulos') }}">VER AQUI</a></strong></center></td>
           
        </tr>
    </table>
  </center>
</body>
</html>