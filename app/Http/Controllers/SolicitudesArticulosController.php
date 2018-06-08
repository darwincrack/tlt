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

        $cargos =  SolicitudesArticulosModels::listar();

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




}
