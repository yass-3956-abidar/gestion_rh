<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
        'employer_id', 'date_embauche', 'contra_type_id'
    ];
    use SoftDeletes;
}
