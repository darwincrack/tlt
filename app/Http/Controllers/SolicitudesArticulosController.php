<?php

namespace App\Http\Controllers;



use App\models\SolicitudesArticulosModels;

use App\models\LogsistemaModels;
use App\models\NotificacionesModels;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use App\Http\Requests\Requests;
use Entrust;
use Validator;
use Illuminate\Support\Facades\Input;
use Response;
use Mail;
use App\User;
use App\Funciones;


class SolicitudesArticulosController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }


    protected $rules =
    [
        'motivo' => 'required|min:2|max:300'    ];




    public function index()
    {

        /* $users = Funciones::userRoles("admin");
return $users[1]["email"];*/

        return view('solicitudesarticulos.index');
    }


    public function anyData()
    {

        $solicitudesarticulos =  SolicitudesArticulosModels::listar();

         $xx=Datatables::of($solicitudesarticulos)


            ->editColumn('nombre_tipo_accion', function ($solicitudesarticulos) {
                if($solicitudesarticulos->nombre_tipo_accion!=''){

                    if(strtolower($solicitudesarticulos->nombre_tipo_accion)=="editar"){
                        return "<label class='label label-primary grey'> ".$solicitudesarticulos->nombre_tipo_accion."</label>";
                    }
                    elseif(strtolower($solicitudesarticulos->nombre_tipo_accion)=="eliminar"){
                        return "<label class='label label-danger'>".$solicitudesarticulos->nombre_tipo_accion."</label>";

                    }


                    
                }
                return "";


            })


            ->editColumn('status', function ($solicitudesarticulos) {
                if($solicitudesarticulos->status!=''){

                    if(strtolower($solicitudesarticulos->status)=="procesado"){
                        return "<label class='label label-primary green'><i class='fa fa-check-circle'></i> ".$solicitudesarticulos->status."</label>";
                    }
                    else {
                        return $solicitudesarticulos->status;
                    }



                    
                }
                return "";


            })




            ->editColumn('ver_articulo', function ($solicitudesarticulos) {

                    if(trim($solicitudesarticulos->status)=="en proceso")
                    {

                         if(Entrust::hasRole(['admin','informatica']))
                            {
                                  return '<a href="articulos/editar/'.$solicitudesarticulos->idArticulo.'/'.$solicitudesarticulos->idSolicitud.'" class="btn btn-xs btn-primary editar"><i class="glyphicon glyphicon-edit"></i> Edit</a> 

                                  <a data-eliminar="'.$solicitudesarticulos->idArticulo.'" data-eliminarsolicitud="'.$solicitudesarticulos->idSolicitud.'" class="btn btn-xs btn-danger delete" title="Recuerde que al eliminar, borra permanentemente este articulo"><i class="glyphicon glyphicon-trash"></i> Eliminar</a>';

                
                            }
                            else{
                           return '<a href="articulos/editar/'.$solicitudesarticulos->idArticulo.'" class="btn btn-xs btn-primary editar"><i class="glyphicon glyphicon-eye"></i> Ver</a>';
                               
                            }





                    }
                    else
                    {

                           if(Entrust::hasRole(['admin']))
                                        {
                                              return '<a href="articulos/editar/'.$solicitudesarticulos->idArticulo.'/'.$solicitudesarticulos->idSolicitud.'" class="btn btn-xs btn-primary editar"><i class="glyphicon glyphicon-edit"></i> Edit</a> 

                                              <a data-eliminar="'.$solicitudesarticulos->idArticulo.'" data-eliminarsolicitud="'.$solicitudesarticulos->idSolicitud.'" class="btn btn-xs btn-danger delete" title="Recuerde que al eliminar, borra permanentemente este articulo"><i class="glyphicon glyphicon-trash"></i> Eliminar</a>';

                            
                                        }
                                        else{
                                       return '<a href="articulos/editar/'.$solicitudesarticulos->idArticulo.'" class="btn btn-xs btn-primary editar"><i class="glyphicon glyphicon-eye"></i> Ver</a>';
                                           
                                        }













                    }

   

              


            });


                if(Entrust::hasRole(['admin']))
                {
                    $xx->addColumn('autorizar_informatica', function ($solicitudesarticulos)  {

                           $xxx=($solicitudesarticulos->autorizado>=1)?'checked=':'null';
                              return " <input data-autorizarinformatica='".$solicitudesarticulos->idSolicitud."' class='autorizarinformatica' type='checkbox' value='' ".$xxx."> ";


                    });

                }



            return $xx->make(true);

    }




    public function store(Request $request)
    {


        $validator = Validator::make(Input::all(), $this->rules);
        if ($validator->fails()) {
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
        } else {
        
            $tipo_accion        =   $request->input("tipo_accion");
            $motivo             =   $request->input("motivo");
            $id_articulo        =   $request->input("id");

           $id_solicitudArticulo= SolicitudesArticulosModels::insertar($id_articulo,$motivo,$tipo_accion);

            NotificacionesModels::insertar("admin","Solicitud # ".$id_solicitudArticulo.", para <strong>editar o eliminar</strong> un Artículo", "solicitudesarticulos");

            LogsistemaModels::insertar('SOLICITUDES ARTICULOS','INSERT');




        $emails=array();
        $users = Funciones::userRoles("admin");

        foreach ($users  as $key => $value) {
            $emails[$key ]= $value["email"];
        }


        $data_solicitudesarticulos =  SolicitudesArticulosModels::listar($id_solicitudArticulo);

       


        Funciones::enviarMail("Solicitud # ".$id_solicitudArticulo.", para editar o eliminar un Artículo",$data_solicitudesarticulos,$emails,"emails.solicitudesarticulos");











            return response()->json($id_solicitudArticulo);
        }

    }










function autorizarInformatica($id,$valor)
{

       

           $post= SolicitudesArticulosModels::autorizarInformatica($id,$valor);
            LogsistemaModels::insertar('SOLICITUDES ARTICULOS','AUTORIZAR INFORMATíCA, ID SOLICITUD DE ARTICULO:'. $id);


            NotificacionesModels::insertar("informatica","Solicitud #".$id.", para <strong>editar o eliminar</strong> un Artículo", "solicitudesarticulos");


                if($valor==1)
                {
                        $emails=array();
                        $users = Funciones::userRoles("informatica");

                        foreach ($users  as $key => $value) {
                            $emails[$key ]= $value["email"];
                        }


                        $data_solicitudesarticulos =  SolicitudesArticulosModels::listar($id);

                        Funciones::enviarMail("Solicitud #".$id.", para editar o eliminar un Artículo",$data_solicitudesarticulos,$emails,"emails.solicitudesarticulos");

                }

            return response()->json($post);
       
}



}
