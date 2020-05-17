<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departement extends Model
{
    public function employers()
    {
        return $this->hasMany('App\Employer');
    }
    protected $fillable = [
        'nom_dep'
    ];
}
