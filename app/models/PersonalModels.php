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

            ->join('cargos', 'personal.id_cargo', '=', 'cargos.id')
            ->join('departamentos', 'personal.id_departamento', '=', 'departamentos.id')
            ->join('ubicacion', 'personal.id_ubicacion', '=', 'ubicacion.id')
            ->orderBy('personal.id','desc')
            ->select('personal.id as idPersonal', 'personal.nombre', 'picture','nro_empleado', 'huella','id_ubicacion','id_cargo','id_departamento','cargos.nombre as cargo', 'departamentos.nombre as departamento', 'ubicacion.nombre as ubicacion' );

        return $data->get();
        }
        else
        {
            $data = DB::table('personal')
            ->where('personal.id', $id)

            ->join('cargos', 'personal.id_cargo', '=', 'cargos.id')
            ->join('departamentos', 'personal.id_departamento', '=', 'departamentos.id')
            ->join('ubicacion', 'personal.id_ubicacion', '=', 'ubicacion.id')
            ->select('personal.id as idPersonal', 'personal.nombre', 'picture','nro_empleado', 'huella','id_ubicacion','id_cargo','id_departamento','cargos.nombre as cargo', 'departamentos.nombre as departamento', 'ubicacion.nombre as ubicacion')
            ->first();
        return $data;

        }
        

    }

    static public function insertar($nro_empleado,$nombre,$departamento,$cargo,$ubicacion)
    {


        $lastInsertID= DB::table('personal')->insertGetId(
            [ 'nro_empleado' => $nro_empleado, 'nombre' => $nombre, 'id_ubicacion' => $ubicacion, 'id_cargo' => $cargo, 'id_departamento' => $departamento]
        );

    }


    static public function editar($id_personal,$nro_empleado,$nombre,$departamento,$cargo,$ubicacion)
    {
        DB::table('personal')
            ->where('id', $id_personal)
            ->update( ['nro_empleado' => $nro_empleado, 'nombre' => $nombre, 'id_ubicacion' => $ubicacion, 'id_cargo' => $cargo, 'id_departamento' => $departamento]);
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

    static public function last_userID()
    {

        $result=DB::table('Userinfo')->max('Userid');
        return $result+1;
    }




}