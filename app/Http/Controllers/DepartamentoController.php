<?php

namespace App\Http\Controllers;



use App\models\DepartamentoModels;
use App\models\LogsistemaModels;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use App\Http\Requests\Requests;
use Entrust;

class DepartamentoController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        return view('departamento.index');
    }


    public function anyData()
    {

        $departamentos =  departamentoModels::listar();

        return Datatables::of($departamentos)
            ->addColumn('action', function ($departamento) {
            
                if(Entrust::hasRole(['admin', 'operador']))
                {

                    return '<a href="departamento/editar/'.$departamento->id.'" class="btn btn-xs btn-primary editar"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
                }
                else
                {
                    return '-';
                }

            })


            ->editColumn('activo', function ($departamento) {
                if($departamento->activo=='1'){
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

        return view('departamento.add');
    }


    public function store(Request $request)
    {

        $nombre             =   $request->input("nombre");
        $descripcion        =   $request->input("descripcion");

        $this->validate($request, [
                'nombre' => 'required|max:50|unique:departamentos',
            ]
            );


        departamentoModels::insertar($nombre,$descripcion);
        LogsistemaModels::insertar('departamento','INSERT');

        $request->session()->flash('alert-success', 'departamento agregada con exito!!');

        return redirect('departamento');
    }



    public function editar($id_departamento)
    {


       $data_departamento         =  departamentoModels::show_departamento($id_departamento);


        if (count($data_departamento)==0){
            return redirect('departamento');
        }
        return view('departamento.editar', ['id_departamento'=>$id_departamento, 'data_departamento' =>$data_departamento]);


    }



    public function store_editar(Request $request)
    {

            $nombre                 =   $request->input("nombre");
            $descripcion            =   $request->input("descripcion");
            $activo                 =   $request->input("activo");
            $id_departamento               =   $request->input("id_departamento");


            departamentoModels::editar($id_departamento,$nombre,$descripcion,$activo);
            LogsistemaModels::insertar('departamento','EDIT');
            $request->session()->flash('alert-success', 'departamento editado con exito!!');

            return redirect('departamento');
    }




}
