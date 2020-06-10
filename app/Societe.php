<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Societe extends Model
{
    public function employers(){
        return $this->hasMany('App\Employer');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }

    protected $fillable = [
        'nom_societe', 'devise', 'adresse','GSM','email','pays','ville','code_postall','site_internet','user_id','description'
    ];
    use SoftDeletes;
}
