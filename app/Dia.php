<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dia extends Model
{
    

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function grupo(){
        return $this->belongsTo('App\Grupo');
    }
}
