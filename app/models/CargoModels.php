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


class CargoModels
{

    static  public function listar()
    {
        $data = DB::table('cargos')
            ->select('id','nombre', 'descripcion', 'activo');
        return $data;

    }


    static public function insertar($nombre,$descripcion)
    {
        DB::table('cargos')->insert(
            ['nombre' => $nombre, 'descripcion' => $descripcion,  'activo' => '1', 'created_at' => DB::raw("now()"), 'creado_por'=>Auth::user()->id]
        );

    }



    static public function editar($id_cargo,$nombre,$descripcion,$activo)
    {
        DB::table('cargos')
             ->where('id', $id_cargo)
            ->update( ['nombre' => $nombre, 'descripcion' => $descripcion,  'activo' => $activo,  'updated_at' => DB::raw("now()")]);

    }



    static public function show_cargo($id_cargo){


        $data = DB::table('cargos')
            ->where('id', $id_cargo)
            ->select('id','nombre', 'descripcion', 'activo')
            ->first();
        return $data;

    }


}