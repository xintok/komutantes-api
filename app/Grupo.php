<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    

    public function users() {
        return $this->belongsToMany('App\User');
    }

    public function dias(){
        return $this->hasMany('App\Dia');
    }

}
