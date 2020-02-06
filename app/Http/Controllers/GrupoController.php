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
        return response()->json(['message' => 'Grupo creado'], 201);
    }
}
