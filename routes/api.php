<?php

use Illuminate\Http\Request;

//AUTENTICACIÓN
Route::group(['prefix' => 'auth'], function () {
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
  
    Route::group(['middleware' => 'auth:api'], function() {
        Route::get('logout', 'AuthController@logout');
    });  
});

    //GRUPOS
    Route::post('nuevoGrupo', 'GrupoController@nuevoGrupo');
    Route::post('usuariosGrupo', 'GrupoController@usuariosGrupo');

    //USUARIOS
    Route::post('unirseAGrupo', 'UserController@unirseAGrupo');
    Route::get('gruposUsuario', 'UserController@gruposUsuario');

    //DIAS
    Route::get('asignarUsuario', 'DiaController@asignarUsuario');
    Route::get('quitarUsuario', 'DiaController@quitarUsuario');
    Route::get('bloquearDia', 'DiaController@bloquearDia');
    Route::get('desbloquearDia', 'DiaController@desbloquearDia');
    Route::get('diasGrupo', 'DiaController@diasGrupo');
