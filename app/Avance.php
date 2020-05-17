<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Avance extends Model
{
    public function employer(){
        return $this->belongsTo('App\Employer');
    }
}
