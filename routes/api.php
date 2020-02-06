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


    //USUARIOS
    Route::post('unirseAGrupo', 'UserController@unirseAGrupo');
    Route::get('gruposUsuario', 'UserController@gruposUsuario');