<?php
/**
 * Created by PhpStorm.
 * User: desarrollo
 * Date: 20/12/2016
 * Time: 17:20
 */

namespace App\models;

use DB;
use Auth;


class NotificacionesModels
{

    static  public function listar($rol=FALSE)
    {
       if($rol)
       {
            $data = DB::table('notificaciones')
            ->where('rol', $rol)
            ->where('leido', 0)
              ->select( '*',  DB::raw("DATE_FORMAT(created_at, '%d-%m-%Y %T') as fecha"));
            return $data->get();
       }
       else{
            $data = DB::table('notificaciones')
              ->select( '*',  DB::raw("DATE_FORMAT(created_at, '%d-%m-%Y %T') as fecha"));
            return $data;
       }
        

    }


    static public function insertar($rol,$mensaje,$url)

    {

// rol del que esta logueado 
// Auth::user()->roles->first()->name

        DB::table('notificaciones')->insert(
            ['rol' => $rol, 'mensaje' => $mensaje, 'url' => $url, 'created_at' => DB::raw("now()"), 'leido'=>0]
        );

    }



        static  public function count()
    {

              $data = DB::table('notificaciones')
            ->where('rol', Auth::user()->roles->first()->name)
            ->where('leido', 0)
        ->select( DB::raw("count(*) as total"));

              
            return $data->get();



    }


        static public function leido($id_notificacion)
    {
        DB::table('notificaciones')
             ->where('id', $id_notificacion)
            ->update( ['leido' => 1, 'leido_por'=>Auth::user()->id, 'fecha_leido' =>DB::raw("now()") ]);

    }


}