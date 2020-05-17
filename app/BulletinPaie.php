<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BulletinPaie extends Model
{
    public function employer(){
        return $this->belongsTo('App\Employer');
    }
}
