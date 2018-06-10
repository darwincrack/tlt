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
use Entrust;


class SolicitudesArticulosModels
{

    static  public function listar($id=FALSE,$informatica=FALSE)
    {
        if(!$id){

            $data = DB::table('articulos');

                if(Entrust::hasRole(['informatica']))
                {
                    $data->where('solicitudes_articulos.autorizado', 1);

                }


            $data->join('ubicacion', 'articulos.id_ubicacion', '=', 'ubicacion.id')
            ->join('solicitudes_articulos', 'articulos.id', '=', 'solicitudes_articulos.id_articulo')
            ->join('tipo_acciones', 'solicitudes_articulos.id_tipo_acciones', '=', 'tipo_acciones.id')
            ->select( '*', 'articulos.id as idArticulo','articulos.nombre as nombre_articulo', 'ubicacion.nombre as nombre_ubicacion', 'solicitudes_articulos.id as idSolicitud','tipo_acciones.nombre as nombre_tipo_accion', DB::raw("DATE_FORMAT(solicitudes_articulos.created_at, '%d-%m-%Y %T') as fecha_solicitud"))
            ->orderBy('solicitudes_articulos.id','desc');

        return $data->get();
        }
        else
        {
            $data = DB::table('articulos')
            ->where('solicitudes_articulos.id', $id)
            ->join('ubicacion', 'articulos.id_ubicacion', '=', 'ubicacion.id')
            ->join('solicitudes_articulos', 'articulos.id', '=', 'solicitudes_articulos.id_articulo')
            ->join('tipo_acciones', 'solicitudes_articulos.id_tipo_acciones', '=', 'tipo_acciones.id')

             ->select( '*','articulos.id as idArticulo', 'articulos.nombre as nombre_articulo', 'ubicacion.nombre as nombre_ubicacion', 'solicitudes_articulos.id as idSolicitud','tipo_acciones.nombre as nombre_tipo_accion','solicitudes_articulos.created_at as fecha_solicitud')
            ->first();
        return $data;

        }
        

    }


    static public function insertar($id_articulo,$motivo,$id_tipo_acciones)
    {
        DB::table('solicitudes_articulos')->insert(
            ['id_articulo' => $id_articulo, 'motivo' => $motivo,  'id_tipo_acciones' => $id_tipo_acciones, 'status'=> 'en proceso', 'created_at' => DB::raw("now()"), 'creado_por'=>Auth::user()->id]
        );

    }





    static public function autorizarInformatica($id,$valor)
    {
        DB::table('solicitudes_articulos')
             ->where('id', $id)
            ->update( ['autorizado' => $valor, 'autorizado_por'=>Auth::user()->id,  'updated_at' => DB::raw("now()")]);

    }





    static public function show_cargo($id_cargo){


        $data = DB::table('solicitudes_articulos')
            ->where('id', $id_cargo)
            ->select('id','nombre', 'descripcion', 'activo')
            ->first();
        return $data;

    }


}