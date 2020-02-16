<?php

namespace App\Http\Controllers;

use App\Dia;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DiaController extends Controller
{
    //Generar mes
    public function generarMes(Request $request){

        $tz = 'Europe/Madrid';
        
        //Primes día del mes indicado del año actual
        $fecha = Carbon::createFromDate(null, $request->mes, 1, $tz);
        $grupoId = $request->grupoId;

        do{
            if(!$fecha->isSaturday()&&!$fecha->isSunday()){

                $dia = new Dia([
                    'fecha' => $fecha,
                    'bloqueado' => false,
                    'grupo_id' => $grupoId,
                ]);
        
                $dia->save(); 

            }
            $fecha = $fecha->addDay();

        }while(!$fecha->isLastOfMonth());

        //se consultan los días que se han creado y se devuelven
        $dias = \App\Dia::where("grupo_id", $grupoId)->whereMonth('fecha', $request->mes)->get();

        return $dias;
    }


    //Planning
    public function generarPlanning(Request $request){

        $grupoId = $request->grupoId;

        //obtener diasGrupo
        $dias = \App\Dia::where("grupo_id", $grupoId)->whereMonth('fecha', $request->mes)->get();

        //obtener usuariosGrupo
        $grupo = \App\Grupo::find($grupoId);
        $usuarios = $grupo->users;

        $nUsuarios = count($usuarios);
        $contU = 0;

        //bucle dias
        foreach($dias as $dia){
            $dia->user()->associate($usuarios[$contU]);
            $dia->save();
            $contU++;
            if($contU==$nUsuarios){
                $contU=0;
            }
        }
               
        return $dias;
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