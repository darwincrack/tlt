<?php

namespace App\Http\Controllers;



use App\models\ubicacionModels;
use App\models\LogsistemaModels;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use App\Http\Requests\Requests;
use Entrust;

class UbicacionController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        return view('ubicacion.index');
    }


    public function anyData()
    {

        $ubicacions =  ubicacionModels::listar();

        return Datatables::of($ubicacions)
            ->addColumn('action', function ($ubicacion) {
            
                if(Entrust::hasRole(['admin', 'operador']))
                {

                    return '<a href="ubicacion/editar/'.$ubicacion->id.'" class="btn btn-xs btn-primary editar"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
                }
                else
                {
                    return '-';
                }

            })


            ->editColumn('activo', function ($ubicacion) {
                if($ubicacion->activo=='1'){
                    return 'SI';
                }
                else{
                    return 'NO';
                }

            })



            ->make(true);

    }

    public function add()
    {

        return view('ubicacion.add');
    }


    public function store(Request $request)
    {

        $nombre             =   $request->input("nombre");
        $descripcion        =   $request->input("descripcion");

        $this->validate($request, [
                'nombre' => 'required|max:50|unique:ubicacion',
            ]
            );


        ubicacionModels::insertar($nombre,$descripcion);
        LogsistemaModels::insertar('ubicacion','INSERT');

        $request->session()->flash('alert-success', 'ubicación agregada con exito!!');

        return redirect('ubicacion');
    }



    public function editar($id_ubicacion)
    {


       $data_ubicacion         =  ubicacionModels::show_ubicacion($id_ubicacion);


        if ($data_ubicacion==""){
            return redirect('ubicacion');
        }
        return view('ubicacion.editar', ['id_ubicacion'=>$id_ubicacion, 'data_ubicacion' =>$data_ubicacion]);


    }



    public function store_editar(Request $request)
    {

            $nombre                 =   $request->input("nombre");
            $descripcion            =   $request->input("descripcion");
            $activo                 =   $request->input("activo");
            $id_ubicacion               =   $request->input("id_ubicacion");


            ubicacionModels::editar($id_ubicacion,$nombre,$descripcion,$activo);
            LogsistemaModels::insertar('ubicacion','EDIT');
            $request->session()->flash('alert-success', 'ubicacion editada con exito!!');

            return redirect('ubicacion');
    }




}
