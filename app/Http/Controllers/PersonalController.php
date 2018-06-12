<?php

namespace App\Http\Controllers;

use App\models\PersonalModels;

use App\models\ListaModels;
use App\models\LogsistemaModels;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use DB;
use Input;
use Illuminate\Support\Facades\Response;
use Entrust;

class PersonalController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(Request $request)
    {
        ConfiguracionController::set_session($request);

        return view('personal.index');
    }


    public function anyData()
    {

        $personal  =  PersonalModels::listar();

        return Datatables::of($personal)


            
            ->addColumn('action', function ($personal)  {

                if(Entrust::hasRole(['admin', 'inventario']))
                {
                      return '<a href="personal/editar/'.$personal->idPersonal.'" class="btn btn-xs btn-primary editar"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
                }
                else{
                    return '-';
                }
                  

            })


                        ->addColumn('horario', function ($personal)  {


                      return '<a href="horario/'.$personal->idPersonal.'" class="btn btn-xs btn-primary editar"><i class="fa fa-clock-o" aria-hidden="true"></i> Ver</a>';


                  

            })




         /*   ->editColumn('huella1', function ($personal) {
                if($personal->huella1!=''){

                    return "<span class='badge badge-success'><i class='fa fa-check' aria-hidden='true'></i></span>";
                }
                return "";


            })*/


           /* ->editColumn('huella2', function ($personal) {
                if($personal->huella2!=''){

                    return "<span class='badge badge-success'><i class='fa fa-check' aria-hidden='true'></i></span>";
                }
                return "";


            })*/







            ->make(true);

    }


    public function add()
    {


        $data_departamentos          =  ListaModels::departamentos();
        $data_cargos                 =  ListaModels::cargos();
        $data_ubicaciones            =  ListaModels::ubicaciones();

         return view('personal.add', ['data_departamentos' => $data_departamentos,'data_cargos' => $data_cargos, 'data_ubicaciones' => $data_ubicaciones]);






    }




    public function editar($id_personal)
    {

        $data_personal         =  PersonalModels::listar($id_personal);

        if ($data_personal==""){
            return redirect('personal');
        }


        $data_departamentos          =  ListaModels::departamentos();
        $data_cargos                 =  ListaModels::cargos();
        $data_ubicaciones            =  ListaModels::ubicaciones();

        
        return view('personal.editar', ['id_personal' =>$id_personal,'data_departamentos' => $data_departamentos, 'data_cargos' => $data_cargos, 'data_ubicaciones' => $data_ubicaciones, 'data_personal' => $data_personal]);


    }


    public function store(Request $request)
    {

            $this->validate($request, [
                'nombre' => 'required|max:50',
                'nro_empleado' => 'required|numeric|unique:personal',
            ]
            );




        $nro_empleado             =   $request->input("nro_empleado");
        $nombre                   =   $request->input("nombre");
        $departamento             =   $request->input("departamento");
        $cargo                    =   $request->input("cargo");
        $ubicacion                =   $request->input("ubicacion");
        $namafoto                 =    "";

              if($request->input("namafoto")){
                  $encoded_data = $request->input("namafoto");
                    $binary_data = base64_decode( $encoded_data );
 
                    // save to server (beware of permissions // set ke 775 atau 777)
                    $namafoto = uniqid().".png";
                    $result = file_put_contents( 'assets/img/personal/'.$namafoto, $binary_data );
                    if (!$result) die("Could not save image!  Check file permissions.");

            }


        PersonalModels::insertar($nro_empleado,$nombre,$departamento,$cargo,$ubicacion,$namafoto);
        LogsistemaModels::insertar('PERSONAL','INSERT');

        $request->session()->flash('alert-success', 'Personal agregado con exito!!');

        return redirect('personal');
    }



    public function store_editar(Request $request)
    {


            $this->validate($request, [
                'nombre' => 'required|max:50',

            ]);


        $id_personal              =   $request->input("id_personal");
        $nro_empleado             =   $request->input("nro_empleado");
        $nombre                   =   $request->input("nombre");
        $departamento             =   $request->input("departamento");
        $cargo                    =   $request->input("cargo");
        $ubicacion                =   $request->input("ubicacion");
        $namafoto                =   $request->input("fotoactual");

              if($request->input("namafoto")){
                  $encoded_data = $request->input("namafoto");
                    $binary_data = base64_decode( $encoded_data );
 
                    // save to server (beware of permissions // set ke 775 atau 777)
                    $namafoto = uniqid().".png";
                    $result = file_put_contents( 'assets/img/personal/'.$namafoto, $binary_data );
                    if (!$result) die("Could not save image!  Check file permissions.");

            }
  




        PersonalModels::editar($id_personal,$nro_empleado,$nombre,$departamento,$cargo,$ubicacion,$namafoto);
        LogsistemaModels::insertar('PERSONAL','EDIT');
        $request->session()->flash('alert-success', 'Personal editado con exito!!');

        return redirect('personal');
    }






    public function guardarfoto(Request $request)
    {

            if($request->input("namafoto")){
                  $encoded_data = $request->input("namafoto");
                    $binary_data = base64_decode( $encoded_data );
 
                    // save to server (beware of permissions // set ke 775 atau 777)
                    $namafoto = "darwinnn.png";
                    $result = file_put_contents( '/'.$namafoto, $binary_data );
                    if (!$result) die("Could not save image!  Check file permissions.");
                }
    }


















}
