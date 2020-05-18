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
    protected $fillable = [
        'employer_id', 'date_embauche', 'conget_type_id'
    ];
}
