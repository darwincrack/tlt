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


class DepartamentoModels
{

    static  public function listar()
    {
        $data = DB::table('departamentos')
            ->select('id','nombre', 'descripcion', 'activo');
        return $data;

    }


    static public function insertar($nombre,$descripcion)
    {
        DB::table('departamentos')->insert(
            ['nombre' => $nombre, 'descripcion' => $descripcion,  'activo' => '1', 'created_at' => DB::raw("now()"), 'creado_por'=>Auth::user()->id]
        );

    }



    static public function editar($id_departamento,$nombre,$descripcion,$activo)
    {
        DB::table('departamentos')
             ->where('id', $id_departamento)
            ->update( ['nombre' => $nombre, 'descripcion' => $descripcion,  'activo' => $activo,  'updated_at' => DB::raw("now()")]);

    }



    static public function show_departamento($id_departamento){


        $data = DB::table('departamentos')
            ->where('id', $id_departamento)
            ->select('id','nombre', 'descripcion', 'activo')
            ->first();
        return $data;

    }


}