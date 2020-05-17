<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Emploi extends Model
{
    public function employers(){
        return $this->hasOne('App\Employer');
    }
    protected $fillable = [
        'fonction', 'date_debut', 'date_fin','salaire_base',
    ];

}
