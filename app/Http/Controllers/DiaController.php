<?php

namespace App\Http\Controllers;

use App\Dia;
use Illuminate\Http\Request;

class DiaController extends Controller
{
    //Generar mes
    public function generarMes(Request $request){

        //obtener todo los días del mes

        //bucle dias

            //añadir grupo al día
            //guardar dia
        
        //fin bucle

        //retunr dias
    }


    //Planning
    public function generarPlanning(Request $request){

        //obtener diasGrupo
        //obtener usuariosGrupo

        //bucle dias

            
        


    }

    //Bloquear día
    public function bloquearDia(Request $request){

        $dia = $this->obtenerDia($request->grupoId, $request->fecha);

        $dia->bloqueado=true;

        $dia->save();
        return response()->json(['message' => 'Día bloqueado'], 201);
    }

    //Desbloquear día
    public function desbloquearDia(Request $request){

        $dia = $this->obtenerDia($request->grupoId, $request->fecha);

        $dia->bloqueado=false;

        $dia->save();
        return response()->json(['message' => 'Día desbloqueado'], 201);
    }

    //Ver mes //Obtener días de grupo
    public function diasGrupo(Request $request){

        $dias = \App\Dia::where("grupo_id", $request->grupoId)->whereMonth('fecha', $request->mes)->get();

        return $dias;
    }

    //Asignar usuario
    public function asignarUsuario(Request $request){

        $dia = $this->obtenerDia($request->grupoId, $request->fecha);
        $usuario = \App\User::find($request->usuarioId);

        $dia->user()->associate($usuario);

        $dia->save();
        return response()->json(['message' => 'Usuario asignado'], 201);
    }

    //Quitar usuario
    public function quitarUsuario(Request $request){

        $dia = $this->obtenerDia($request->grupoId, $request->fecha);

        $dia->user()->disociate();

        $dia->save();
        return response()->json(['message' => 'Día sin asignación'], 201);
    }

    //Obtener dia
    private function obtenerDia($grupo,$fecha){

        $dia = \App\Dia::where("grupo_id",$grupo)->where("fecha",$fecha)->first();

        return $dia;
    }

}