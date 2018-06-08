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

class ArticulosModels
{

    static  public function listar($id=FALSE)
    {

        if(!$id){

            $data = DB::table('articulos')

            ->join('ubicacion', 'articulos.id_ubicacion', '=', 'ubicacion.id')
             ->join('estados', 'articulos.id_estado', '=', 'estados.id')
            ->select( '*', 'articulos.id as idArticulo','articulos.nombre as nombre_articulo', 'ubicacion.nombre as nombre_ubicacion','estados.nombre as nombre_estado')
            ->orderBy('articulos.id','desc');

        return $data->get();
        }
        else
        {
            $data = DB::table('articulos')
            ->where('articulos.id', $id)
            ->join('ubicacion', 'articulos.id_ubicacion', '=', 'ubicacion.id')

             ->join('estados', 'articulos.id_estado', '=', 'estados.id')
             ->select( '*','articulos.id as idArticulo', 'articulos.nombre as nombre_articulo', 'ubicacion.nombre as nombre_ubicacion','estados.nombre as nombre_estado')
            ->first();
        return $data;

        }
        

    }

    static public function insertar($nombre,$modelo,$serial,$marca,$codigo_barra,$descripcion,$observacion, $costo_bs,$costo_dolar, $fecha_adquisicion,$calidad_prestamo,$donado,$nro_factura,$costo_actual_bs,$costo_actual_dolar,$ubicacion,$estado )
    {


        $lastInsertID= DB::table('articulos')->insertGetId(
            [ 'nombre' => $nombre, 'modelo' => $modelo, 'serial' => $serial, 'marca' => $marca, 'codigo_barra' => $codigo_barra, 'descripcion' => $descripcion, 'observacion' => $observacion, 'costo_bs' => $costo_bs, 'costo_dolar' => $costo_dolar, 'fecha_adquisicion' => $fecha_adquisicion, 'calidad_prestamo' => $calidad_prestamo, 'donado' => $donado, 'nro_factura' => $nro_factura,'costo_actual_bs' => $costo_actual_bs,'costo_actual_dolar' => $costo_actual_dolar,'id_ubicacion' => $ubicacion,'id_estado' => $estado, 'created_at' => DB::raw("now()"), 'creado_por'=>Auth::user()->id]
        );

    }


    static public function editar($id_articulo,$nombre,$modelo,$serial,$marca,$codigo_barra,$descripcion,$observacion, $costo_bs,$costo_dolar, $fecha_adquisicion,$calidad_prestamo,$donado,$nro_factura,$costo_actual_bs,$costo_actual_dolar,$ubicacion,$estado )
    {
        DB::table('articulos')
            ->where('id', $id_articulo)
            ->update( [ 'nombre' => $nombre, 'modelo' => $modelo, 'serial' => $serial, 'marca' => $marca, 'codigo_barra' => $codigo_barra, 'descripcion' => $descripcion, 'observacion' => $observacion, 'costo_bs' => $costo_bs, 'costo_dolar' => $costo_dolar, 'fecha_adquisicion' => $fecha_adquisicion, 'calidad_prestamo' => $calidad_prestamo, 'donado' => $donado, 'nro_factura' => $nro_factura,'costo_actual_bs' => $costo_actual_bs,'costo_actual_dolar' => $costo_actual_dolar,'id_ubicacion' => $ubicacion, 'id_estado' => $estado, 'updated_at' => DB::raw("now()"), 'creado_por'=>Auth::user()->id]);
    }




    static public function show_personal($id_procedencia){

        $data = DB::table('procedencia')
            ->where('procedencia.id_procedencia', $id_procedencia)
            ->join('ciudad', 'procedencia.id_ciudad', '=', 'ciudad.id_ciudad')
            ->join('tipo_procedencia', 'procedencia.id_tipo_procedencia', '=', 'tipo_procedencia.id_tipo_procedencia')
            ->select('procedencia.id_procedencia as id_procedencia', 'procedencia.nombre AS nombre_procedencia', 'tipo_procedencia.nombre AS nombre_tipo_procedencia' , 'tipo_procedencia.id_tipo_procedencia AS id_tipo_procedencia','ciudad.nombre AS nombre_ciudad' ,'ciudad.id_ciudad AS id_ciudad','procedencia.fecha_alquiler','procedencia.activo','motivo', 'alquilado')
            ->first();
        return $data;

    }


    static public function delete($id_articulo)
    {
        DB::table('articulos')
                ->where('id', $id_articulo)
                ->delete();
    }


    static public function last_userID()
    {

        $result=DB::table('Userinfo')->max('Userid');
        return $result+1;
    }




}