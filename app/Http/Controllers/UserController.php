<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    static function users()
    {

        $user = User::all();


        return response()->json(['user' => $user]);
    }

    public static function register(request $request)
    { // REQUEST ES LO QUE SE ENVIA ATRAVEZ DEL ENDPOINT 

        $validate = $request->validate([ //REALIZA LA VALIDACIÓN DE LOS CAMPOS
            'name' => 'required|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|min:8|string'
        ]);

        // if ($validate) {
        //     return response()->json($validate);
        // }

        $user = User::create(//CREACION DEL USUARIO
            [
                'name' =>  $request->name,
                'email' =>  $request->email,
                'password' => $request->password,
            ]
        );
        $token = $user->createToken('auth_token')->plainTextToken;// CREA EL TOKEN DE SEGURIDAD DE USO

        return response()->json(['message'=>'Usuario creado correctamente','usuario'=>$user,'token_app'=>$token],200);
    }
}
