<?php

namespace App\Http\Controllers;

use App\Grupo;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GrupoController extends Controller
{
    public function nuevoGrupo(Request $request)
    {
        $grupo = new Grupo([
            'nombre'    => $request->nombre,
            'normas'    => $request->normas,
            'codigo'    => Str::random(7),
        ]);        
        
        $grupo->save();        
        return response()->json(['Código de asignación' => $grupo->codigo], 201);
    }

    public function usuariosGrupo(Request $request){

        $grupo = \App\Grupo::find($request->grupoId);

        return $grupo->users;
    }
}
