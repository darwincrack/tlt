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


class UbicacionModels
{

    static  public function listar()
    {
        $data = DB::table('ubicacion')
            ->select('id','nombre', 'descripcion', 'activo');
        return $data;

    }


    static public function insertar($nombre,$descripcion)
    {
        DB::table('ubicacion')->insert(
            ['nombre' => $nombre, 'descripcion' => $descripcion,  'activo' => '1', 'created_at' => DB::raw("now()"), 'creado_por'=>Auth::user()->id]
        );

    }



    static public function editar($id_ubicacion,$nombre,$descripcion,$activo)
    {
        DB::table('ubicacion')
             ->where('id', $id_ubicacion)
            ->update( ['nombre' => $nombre, 'descripcion' => $descripcion,  'activo' => $activo,  'updated_at' => DB::raw("now()")]);

    }



    static public function show_ubicacion($id_ubicacion){


        $data = DB::table('ubicacion')
            ->where('id', $id_ubicacion)
            ->select('id','nombre', 'descripcion', 'activo')
            ->first();
        return $data;

    }


}