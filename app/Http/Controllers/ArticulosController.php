<?php

namespace App\Http\Controllers;

use App\models\ArticulosModels;

use App\models\ListaModels;
use App\models\LogsistemaModels;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use DB;
use Input;
use Illuminate\Support\Facades\Response;
use Entrust;

class ArticulosController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(Request $request)
    {
        ConfiguracionController::set_session($request);

        return view('articulos.index');
    }


    public function anyData()
    {

        $articulos  =  ArticulosModels::listar();

        return Datatables::of($articulos)


            
            ->addColumn('action', function ($articulos)  {

                if(Entrust::hasRole(['admin']))
                {
                      return '<a href="articulos/editar/'.$articulos->idArticulo.'" class="btn btn-xs btn-primary editar"><i class="glyphicon glyphicon-edit"></i> Edit</a> 

                      <a data-eliminar="'.$articulos->idArticulo.'" class="btn btn-xs btn-danger delete" title="Recuerde que al eliminar, borra permanentemente este articulo"><i class="glyphicon glyphicon-trash"></i> Eliminar</a>';

    




                }
                else{
                return"<button data-eliminaredit='".$articulos->idArticulo."'  type'button' class='btn btn-primary eliminaredit' data-toggle='modal' data-target='#myModal'><i class='glyphicon glyphicon-edit'></i>editar o eliminar</button>";
                   
                }
                  

            })

            ->editColumn('nombre_estado', function ($articulos) {
                if($articulos->nombre_estado!=''){

                    if($articulos->nombre_estado=="activo"){
                        return "<label class='label label-primary green'>".$articulos->nombre_estado."</label>";
                    }
                    elseif($articulos->nombre_estado=="dañado"){
                        return "<label class='label label-danger'>".$articulos->nombre_estado."</label>";

                    }


                    
                }
                return "";


            })



            ->make(true);

    }


    public function add()
    {

        $data_ubicaciones            =  ListaModels::ubicaciones();
        $data_estados                =  ListaModels::estados();

         return view('articulos.add', ['data_ubicaciones' => $data_ubicaciones,'data_estados' => $data_estados]);

    }





    public function editar($id_articulo)
    {

        $data_articulo         =  ArticulosModels::listar($id_articulo);

        if (count($data_articulo)==0){
            return redirect('articulos');
        }

        $data_ubicaciones            =  ListaModels::ubicaciones();
        $data_estados                =  ListaModels::estados();


        
        return view('articulos.editar', ['id_articulo' =>$id_articulo,'data_ubicaciones' => $data_ubicaciones, 'data_articulo' => $data_articulo,'data_estados' => $data_estados]);


    }


    public function store(Request $request)
    {
            $this->validate($request, [
                'nombre' => 'required|max:50',
                'fecha_adquisicion' => 'date_format:"d-m-Y"',
                'codigo_barra' => 'required|unique:articulos',
                'serial' => 'required|unique:articulos',
                'costo_bs' => 'numeric',
                'costo_dolar' => 'numeric',
                'costo_actual_bs' => 'numeric',
                'costo_actual_dolar' => 'numeric',
            ]
            );


        $nombre             =   $request->input("nombre");
        $modelo             =   $request->input("modelo");
        $serial             =   $request->input("serial");
        $marca              =   $request->input("marca");
        $codigo_barra       =   $request->input("codigo_barra");
        $descripcion        =   $request->input("descripcion");
        $observacion        =   $request->input("observacion");
        $costo_bs           =   $request->input("costo_bs");
        $costo_dolar        =   $request->input("costo_dolar");
        $fecha_adquisicion  =   date('Y-m-d', strtotime($request->input("fecha_adquisicion")));
        $calidad_prestamo   =   $request->input("calidad_prestamo");
        $donado             =   $request->input("donado");
        $nro_factura        =   $request->input("nro_factura");
        $costo_actual_bs    =   $request->input("costo_actual_bs");
        $costo_actual_dolar =   $request->input("costo_actual_dolar");
        $ubicacion          =   $request->input("ubicacion");
        $estado             =   $request->input("estados");



        if( $costo_bs ==""){
            $costo_bs = NULL;  
        }

        if( $costo_dolar ==""){
            $costo_dolar = NULL;  
        }

        if( $costo_actual_bs ==""){
            $costo_actual_bs = NULL;  
        }

        if( $costo_actual_dolar ==""){
            $costo_actual_dolar = NULL;  
        }



                if(Entrust::hasRole(['seguridad','inventario','informatica']))
                {
                        $costo_bs           =   NULL;
                        $costo_dolar        =   NULL;
                        $fecha_adquisicion  =   NULL;
                        $calidad_prestamo   =   NULL;
                        $donado             =   NULL;
                        $nro_factura        =   NULL;
                        $costo_actual_bs    =   NULL;
                        $costo_actual_dolar =   NULL;
                }




        ArticulosModels::insertar($nombre,$modelo,$serial,$marca,$codigo_barra,$descripcion,$observacion, $costo_bs,$costo_dolar, $fecha_adquisicion,$calidad_prestamo,$donado,$nro_factura,$costo_actual_bs,$costo_actual_dolar,$ubicacion,$estado );

        LogsistemaModels::insertar('ARTICULOS','INSERT');

        $request->session()->flash('alert-success', 'Articulo ['.$nombre.'] agregado con exito!!');

        return redirect('articulos');
    }



    public function store_editar(Request $request)
    {




            $this->validate($request, [
                'nombre' => 'required|max:50',
                'fecha_adquisicion' => 'date_format:"d-m-Y"',
                'codigo_barra' => 'required',
                'serial' => 'required',
                'costo_bs' => 'numeric',
                'costo_dolar' => 'numeric',
                'costo_actual_bs' => 'numeric',
                'costo_actual_dolar' => 'numeric',
            ]
            );

        $id_articulo        =   $request->input("id_articulo");
        $nombre             =   $request->input("nombre");
        $modelo             =   $request->input("modelo");
        $serial             =   $request->input("serial");
        $marca              =   $request->input("marca");
        $codigo_barra       =   $request->input("codigo_barra");
        $descripcion        =   $request->input("descripcion");
        $observacion        =   $request->input("observacion");
        $costo_bs           =   $request->input("costo_bs");
        $costo_dolar        =   $request->input("costo_dolar");
        $fecha_adquisicion  =   date('Y-m-d', strtotime($request->input("fecha_adquisicion")));
        $calidad_prestamo   =   $request->input("calidad_prestamo");
        $donado             =   $request->input("donado");
        $nro_factura        =   $request->input("nro_factura");
        $costo_actual_bs    =   $request->input("costo_actual_bs");
        $costo_actual_dolar =   $request->input("costo_actual_dolar");
        $ubicacion          =   $request->input("ubicacion");
        $estado             =   $request->input("estado");



        if( $costo_bs ==""){
            $costo_bs = NULL;  
        }

        if( $costo_dolar ==""){
            $costo_dolar = NULL;  
        }

        if( $costo_actual_bs ==""){
            $costo_actual_bs = NULL;  
        }

        if( $costo_actual_dolar ==""){
            $costo_actual_dolar = NULL;  
        }


        ArticulosModels::editar($id_articulo,$nombre,$modelo,$serial,$marca,$codigo_barra,$descripcion,$observacion, $costo_bs,$costo_dolar, $fecha_adquisicion,$calidad_prestamo,$donado,$nro_factura,$costo_actual_bs,$costo_actual_dolar,$ubicacion,$estado );
        LogsistemaModels::insertar('ARTICULOS','EDIT');
        $request->session()->flash('alert-success', 'Articulo ['.$nombre.'] editado con exito!!');

        return redirect('articulos');
    }














    public function eliminar($id_articulo,Request $request)
    {
        ArticulosModels::delete($id_articulo);
        LogsistemaModels::insertar('ARTICULOS','DELETE',$id_articulo);
        $request->session()->flash('alert-success', 'Articulo eliminado con exito!!');
        return redirect('articulos');
    }









}
