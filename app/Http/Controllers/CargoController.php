<?php

namespace App\Http\Controllers;



use App\models\CargoModels;
use App\models\LogsistemaModels;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use App\Http\Requests\Requests;
use Entrust;

class CargoController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        return view('cargo.index');
    }


    public function anyData()
    {

        $cargos =  cargoModels::listar();

        return Datatables::of($cargos)
            ->addColumn('action', function ($cargo) {
            
                if(Entrust::hasRole(['admin', 'operador']))
                {

                    return '<a href="cargo/editar/'.$cargo->id.'" class="btn btn-xs btn-primary editar"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
                }
                else
                {
                    return '-';
                }

            })


            ->editColumn('activo', function ($cargo) {
                if($cargo->activo=='1'){
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

        return view('cargo.add');
    }


    public function store(Request $request)
    {

        $nombre             =   $request->input("nombre");
        $descripcion        =   $request->input("descripcion");
        
        $this->validate($request, [
                'nombre' => 'required|max:50|unique:cargos',
            ]
            );


        cargoModels::insertar($nombre,$descripcion);
        LogsistemaModels::insertar('cargo','INSERT');

        $request->session()->flash('alert-success', 'cargo agregado con exito!!');

        return redirect('cargo');
    }



    public function editar($id_cargo)
    {


       $data_cargo         =  cargoModels::show_cargo($id_cargo);


        if ($data_cargo==""){
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


            cargoModels::editar($id_cargo,$nombre,$descripcion,$activo);
            LogsistemaModels::insertar('cargo','EDIT');
            $request->session()->flash('alert-success', 'cargo editado con exito!!');

            return redirect('cargo');
    }




}
