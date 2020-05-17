<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banque extends Model
{
    public function employers(){
        return $this->hasOne('App\Employer');
    }
    protected $fillable = [
        'nom_banque','rib','adresse','tele'
    ];
}
