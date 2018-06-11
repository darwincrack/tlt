<?php

namespace App\Http\Controllers;



use App\models\NotificacionesModels;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use App\Http\Requests\Requests;
use Entrust;
use Auth;

class NotificacionesController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        return view('notificaciones.index');
    }


    public function anyData()
    {
        $notificaciones =  NotificacionesModels::listar();
        return Datatables::of($notificaciones)

            ->addColumn('accion', function ($notificaciones) {

                if($notificaciones->leido==0)
                {
                    return '<a data-link="'.$notificaciones->url.'" class="btn btn-xs btn-primary mensajenotificacion" data-mensajenotificacion="'.$notificaciones->id.'"><i class="fa fa-eye"></i> Ver</a>';
                } 
                else{

                     return '<a href="'.$notificaciones->url.'" class="btn btn-xs btn-primary"><i class="fa fa-eye"></i> Ver</a>';
                }


              

            })

            ->editColumn('fecha', function ($notificaciones) {

                if($notificaciones->leido==0)
                {
                   return "<span class='noleido'>".$notificaciones->fecha."</span>";
                } 
                return $notificaciones->fecha;

            })


            ->make(true);
    }

    public function count()
    {
         $notificaciones =  NotificacionesModels::count();
         return json_encode($notificaciones);
    }

    public function listar()
    {
         $notificaciones =  NotificacionesModels::listar(Auth::user()->roles->first()->name);
         return json_encode($notificaciones);
    }


       public function leido($id_notificacion)
    {


       $data         =  NotificacionesModels::leido($id_notificacion);

        return response()->json($data);




    }


}
