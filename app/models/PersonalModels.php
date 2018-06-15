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

class PersonalModels
{

    static  public function listar($id=FALSE)
    {

        if(!$id){

            $data = DB::table('personal')
            ->where('personal.id_estado','!=', 4)
            ->join('cargos', 'personal.id_cargo', '=', 'cargos.id')
            ->join('departamentos', 'personal.id_departamento', '=', 'departamentos.id')
            ->join('ubicacion', 'personal.id_ubicacion', '=', 'ubicacion.id')
            ->orderBy('personal.id','desc')
            ->select('personal.id as idPersonal', 'personal.nombre', 'picture','nro_empleado', 'huella','id_ubicacion','id_cargo','id_departamento','cargos.nombre as cargo', 'departamentos.nombre as departamento', 'ubicacion.nombre as ubicacion','personal.picture' );

        return $data->get();
        }
        else
        {
            $data = DB::table('personal')
            ->where('personal.id', $id)
            ->where('personal.id_estado','!=', 4)
            ->join('cargos', 'personal.id_cargo', '=', 'cargos.id')
            ->join('departamentos', 'personal.id_departamento', '=', 'departamentos.id')
            ->join('ubicacion', 'personal.id_ubicacion', '=', 'ubicacion.id')
            ->select('personal.id as idPersonal', 'personal.nombre', 'picture','nro_empleado', 'huella','id_ubicacion','id_cargo','id_departamento','cargos.nombre as cargo', 'departamentos.nombre as departamento', 'ubicacion.nombre as ubicacion','personal.picture')
            ->first();
        return $data;

        }
        

    }

    static public function insertar($nro_empleado,$nombre,$departamento,$cargo,$ubicacion,$picture)
    {


        $lastInsertID= DB::table('personal')->insertGetId(
            [ 'nro_empleado' => $nro_empleado, 'nombre' => $nombre, 'id_ubicacion' => $ubicacion, 'id_cargo' => $cargo, 'id_departamento' => $departamento, 'picture'=>$picture,'id_estado' => 1, 'created_at' => DB::raw("now()"), 'creado_por'=>Auth::user()->id]
        );

    }


    static public function editar($id_personal,$nro_empleado,$nombre,$departamento,$cargo,$ubicacion,$picture)
    {
        DB::table('personal')
            ->where('id', $id_personal)
            ->update( ['nro_empleado' => $nro_empleado, 'nombre' => $nombre, 'id_ubicacion' => $ubicacion, 'id_cargo' => $cargo, 'id_departamento' => $departamento, 'picture'=>$picture,'updated_at' => DB::raw("now()"), 'actualizado_por'=>Auth::user()->id]);
    }






    static public function last_userID()
    {

        $result=DB::table('Userinfo')->max('Userid');
        return $result+1;
    }



        static public function delete($id_personal)
    {


                  DB::table('personal')
            ->where('id', $id_personal)
            ->update( [ 'id_estado' => 4, 'updated_at' => DB::raw("now()"), 'actualizado_por'=>Auth::user()->id]);

    }




}