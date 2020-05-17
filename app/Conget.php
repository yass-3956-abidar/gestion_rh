<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conget extends Model
{
    public function employer()
    {
        return $this->belongsTo('App\Employer');
    }
    public function congetType()
    {
        return $this->belongsTo('App\CongetType');
    }
}
