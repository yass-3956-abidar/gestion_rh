<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BulletinPaie extends Model
{
    public function employer(){
        return $this->belongsTo('App\Employer');
    }
    use SoftDeletes;
}
