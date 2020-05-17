<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contrat extends Model
{
    public function employer()
    {
        return $this->belongsTo('App\Employer');
    }
    public function Contrattypes()
    {
        return $this->belongsTo('App\ContratType');
    }
}
