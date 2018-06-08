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


class SolicitudesArticulosModels
{

    static  public function listar()
    {
        $data = DB::table('solicitudes_articulos')
            ->select('id','nombre', 'descripcion', 'activo');
        return $data;

    }


    static public function insertar($id_articulo,$motivo,$tipo_accion)
    {
        DB::table('solicitudes_articulos')->insert(
            ['id_articulo' => $id_articulo, 'motivo' => $motivo,  'tipo_accion' => $tipo_accion, 'procesado'=> 0, 'created_at' => DB::raw("now()"), 'creado_por'=>Auth::user()->id]
        );

    }



    static public function editar($id_cargo,$nombre,$descripcion,$activo)
    {
        DB::table('solicitudes_articulos')
             ->where('id', $id_cargo)
            ->update( ['nombre' => $nombre, 'descripcion' => $descripcion,  'activo' => $activo,  'updated_at' => DB::raw("now()")]);

    }



    static public function show_cargo($id_cargo){


        $data = DB::table('solicitudes_articulos')
            ->where('id', $id_cargo)
            ->select('id','nombre', 'descripcion', 'activo')
            ->first();
        return $data;

    }


}