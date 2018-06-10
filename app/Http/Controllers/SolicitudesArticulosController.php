<?php

namespace App\Http\Controllers;



use App\models\SolicitudesArticulosModels;
use App\models\LogsistemaModels;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use App\Http\Requests\Requests;
use Entrust;
use Validator;
use Illuminate\Support\Facades\Input;
use Response;

class SolicitudesArticulosController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }


    protected $rules =
    [
        'motivo' => 'required|min:2|max:50'    ];




    public function index()
    {
        return view('solicitudesarticulos.index');
    }


    public function anyData()
    {

        $solicitudesarticulos =  SolicitudesArticulosModels::listar();

         $xx=Datatables::of($solicitudesarticulos)


            ->editColumn('nombre_tipo_accion', function ($solicitudesarticulos) {
                if($solicitudesarticulos->nombre_tipo_accion!=''){

                    if(strtolower($solicitudesarticulos->nombre_tipo_accion)=="editar"){
                        return "<label class='label label-primary green'> ".$solicitudesarticulos->nombre_tipo_accion."</label>";
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



                if(Entrust::hasRole(['admin','informatica']))
                {
                      return '<a href="articulos/editar/'.$solicitudesarticulos->idArticulo.'/'.$solicitudesarticulos->idSolicitud.'" class="btn btn-xs btn-primary editar"><i class="glyphicon glyphicon-edit"></i> Edit</a> 

                      <a data-eliminar="'.$solicitudesarticulos->idArticulo.'" data-eliminarsolicitud="'.$solicitudesarticulos->idSolicitud.'" class="btn btn-xs btn-danger delete" title="Recuerde que al eliminar, borra permanentemente este articulo"><i class="glyphicon glyphicon-trash"></i> Eliminar</a>';

    
                }
                else{
               return '<a href="articulos/editar/'.$solicitudesarticulos->idArticulo.'" class="btn btn-xs btn-primary editar"><i class="glyphicon glyphicon-eye"></i> Ver</a>';
                   
                }

              


            });


                if(Entrust::hasRole(['admin']))
                {
                    $xx->addColumn('autorizar_informatica', function ($solicitudesarticulos)  {

                           $xxx=($solicitudesarticulos->autorizado>=1)?'checked=':'null';
                              return "  <div class='switch'>
                                <div class='onoffswitch'>
                                    <input type='checkbox' data-autorizarinformatica='".$solicitudesarticulos->idSolicitud."'    class='onoffswitch-checkbox' id='calidad_prestamo_".$solicitudesarticulos->idSolicitud."' name='calidad_prestamo' value='1' ".$xxx." >
                                    <label class='onoffswitch-label' for='calidad_prestamo_".$solicitudesarticulos->idSolicitud."'>
                                        <span class='onoffswitch-inner'></span>
                                        <span class='onoffswitch-switch'></span>
                                    </label>
                                </div>
                            </div>";


                    });

                }



            return $xx->make(true);

    }

    public function add()
    {

        return view('cargo.add');
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

           $post= SolicitudesArticulosModels::insertar($id_articulo,$motivo,$tipo_accion);
            LogsistemaModels::insertar('SOLICITUDES ARTICULOS','INSERT');
            return response()->json($post);
        }

    }



    public function editar($id_cargo)
    {


       $data_cargo         =  SolicitudesArticulosModels::show_cargo($id_cargo);


        if (count($data_cargo)==0){
            return redirect('cargo');
        }
        return view('cargo.editar', ['id_cargo'=>$id_cargo, 'data_cargo' =>$data_cargo]);


    }



    public function store_editar(Request $request)
    {

            $nombre                 =   $request->input("nombre");
            $descripcion            =   $request->input("descripcion");
            $activo                 =   $request->input("activo");
            $id_cargo               =   $request->input("id_cargo");


            SolicitudesArticulosModels::editar($id_cargo,$nombre,$descripcion,$activo);
            LogsistemaModels::insertar('cargo','EDIT');
            $request->session()->flash('alert-success', 'cargo editado con exito!!');

            return redirect('cargo');
    }



function autorizarInformatica($id,$valor)
{

       

           $post= SolicitudesArticulosModels::autorizarInformatica($id,$valor);
            LogsistemaModels::insertar('SOLICITUDES ARTICULOS','AUTORIZAR INFORMATíCA, ID SOLICITUD DE ARTICULO:'. $id);
            return response()->json($post);
       
}



}
