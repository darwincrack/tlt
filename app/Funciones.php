<?php
/**
 * Created by PhpStorm.
 * User: desarrollo
 * Date: 20/12/2016
 * Time: 17:20
 */

namespace App;
use App\User;
use Mail;

class Funciones
{

    static  public function userRoles($rol)
    {
      return $users = User::whereHas('roles', function ($query) use ($rol){
            $query->where('name', '=', $rol);
        })->get();



    }




    static  public function enviarMail($asunto,$data,$emails,$vista)
    {
             Mail::send($vista, ['data' => $data], function ($message) use ($emails, $asunto)
            {

            $message->subject($asunto);

            $message->from('sistema@localhost.com', 'Sistema');

            $message->to($emails);

        });
    }



}