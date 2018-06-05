<?php

namespace App\Http\Controllers;



use App\models\JustificativoModels;
use App\models\LogsistemaModels;
use App\models\ListaModels;

use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use App\Http\Requests\Requests;
use Entrust;

class JustificativoController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        return view('justificativos.index');
    }



    public function anyData()
    {

        $justificativos  =  JustificativoModels::listar();

        return Datatables::of($justificativos)



            ->addColumn('pdf', function ($justificativos)  {

                    return '<a href="../justificativos/ver/'.$justificativos->Lsh.'" class="btn btn-xs btn-primary" title="Ver Justificativo"><i class="fa fa-file-pdf-o"></i> ver</a>';

            })

            ->addColumn('delete', function ($justificativos)  {

                if(Entrust::hasRole(['admin', 'operador']))
                {
                    return '<a href="../justificativos/delete/'.$justificativos->Lsh.'" class="btn btn-xs btn-danger delete"><i class="glyphicon glyphicon-trash"></i> Eliminar</a>';
                }
                else{
                    return '<i class="fa fa-lock" aria-hidden="true"></i>';
                }


            })


            ->editColumn('tipo_falta', function ($personal) {
                //  return $personal->tipo_falta.'xxx';



                switch ($personal->tipo_falta)
                {
                    case 1:
                        return "<span class='falta falta-primary' >ENTRADA A TIEMPO</span>";
                        break;

                    case 2:
                        return "<span class='falta falta-danger' >TARDIA</span>";
                        break;
                    case 3:
                        return "<span class='falta  falta-danger' >FALTA MARCA ENTRADA</span>";
                        break;
                    case 4:
                        return "<span class='falta falta-primary' >SALIDA ALMUERZO</span>";
                        break;
                    case 5:
                        return "<span class='falta falta-danger' >ENTRADA TARDE DEL ALMUERZO</span>";
                        break;
                    case 6:
                        return "<span class='falta falta-primary' >SALIDA A TIEMPO</span>";
                        break;
                    case 7:
                        return "<span class='falta falta-danger' >SALIDA PREVIA</span>";
                        break;
                    case 8:
                        return "<span class='falta  falta-danger' >FALTA MARCA SALIDA</span>";
                    case 9:


                        return "<span class='falta'data-toggle='popover' data-placement='auto top' data-content='MARCAJE FUERA DE TODOS LOS RANGOS o no posee horario cargado para esta fecha' data-original-title='' title=''>hora fuera de todos los rangos</span>";
                    case 10:
                        return "<span class='falta falta-primary' >ENTRADA ALMUERZO</span>";

                    case 11:
                        return "<span class='falta falta-warning' >AUSENCIA</span>";

                    default:
                        return "???";

                }


            })



            ->make(true);

    }





    public function add($id_usuario,$name,$tipo_falta,$hora_marcaje,$fecha)
    {

        $tiposJustificativos =  ListaModels::tiposJustificativos();
        return view('justificativos.add',['id_usuario'=>$id_usuario, 'name'=>$name,'tipo_falta' =>$tipo_falta,'fecha' =>$fecha,'hora_marcaje' =>$hora_marcaje,'tiposJustificativos'=>$tiposJustificativos]);
    }


    public function store(Request $request)
    {

        $Userid             =   $request->input("Userid");
        $fecha              =   $request->input("fecha");
        $hora               =   $request->input("hora");
        $tipo_falta         =   $request->input("tipo_falta");
        $tipojustificativo  =   $request->input("tipojustificativo");
        $motivo             =   $request->input("motivo");
       


        JustificativoModels::insertar($Userid,$fecha,$hora,$tipo_falta,$tipojustificativo,$motivo);
        LogsistemaModels::insertar('JUSTIFICATIVO','INSERT');
        $request->session()->flash('alert-success', 'Justificativo agregado con exito!!');

        return redirect('reportes');
    }



    public function delete($id_justificativo,Request $request)
    {

        JustificativoModels::delete($id_justificativo);
        LogsistemaModels::insertar('JUSTIFICATIVO','ELIMINAR');

        $request->session()->flash('alert-success', 'Justificativo eliminado con exito!!');


        return redirect('reportes/justificativos');


    }

}
