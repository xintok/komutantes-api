<?php

namespace App\Http\Controllers;

use App\User;
use App\Grupo;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //usuarioId - identificador único del usuario 
    //codigo - codigo aleatorio que representa al grupo públicamente
    public function unirseAGrupo(Request $request){

        $usuario = \App\User::find($request->usuarioId);
        $grupo = \App\Grupo::where('codigo',$request->codigo)->first();

        if($usuario == null || $grupo == null){
            return response()->json(['message' => 'Error al unirse al grupo'], 500);
        }else{
            $usuario->grupos()->attach($grupo);
            return response()->json(['message' => 'Usuario unido al grupo'], 201);
        }

    }

    public function gruposUsuario(Request $request){

        $usuario = \App\User::find($request->usuarioId);

        return $usuario->grupos;
    }

  
}
