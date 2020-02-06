<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    protected $fillable = [
        'nombre', 'normas', 'codigo',
    ];

    public function users() {
        return $this->belongsToMany('App\User');
    }

    public function dias(){
        return $this->hasMany('App\Dia');
    }

}
