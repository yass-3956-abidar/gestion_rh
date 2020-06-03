<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employer extends Model
{


    use SoftDeletes;

    protected $fillable = [
        'cin', 'nom_employer', 'prenom', 'email', 'date_naissance', 'situationFami', 'sexe', 'Num_cnss', 'nbr_enfant', 'Num_Icmr', 'salaire', 'image', 'emploi_id', 'banque_id', 'departement_id', 'societe_id',
    ];
    public function congets()
    {
        return $this->hasMany('App\Conget');
    }
    //employer has many contrat
    public function contats()
    {
        return $this->hasOne('App\Contrat');
    }
    public function avances()
    {
        return $this->hasMany('App\Avance');
    }


    public function emplois()
    {
        return $this->belongsTo('App\Emploi');
    }
    public function societes()
    {
        return $this->hasMany('App\Societe');
    }
    public function departements()
    {
        return $this->hasMany('App\Departement');
    }
    public function banques()
    {
        return $this->hasMany('App\Banque');
    }

    public function primes()
    {
        return $this->hasMany('App\Prime');
    }
    public function bulletinpaies()
    {
        return $this->hasMany('App\BulletinPaie');
    }
    public function presences()
    {
        return $this->hasMany('App\Presence');
    }
    public function heursups()
    {
        return $this->hasMany('App\HeurSup');
    }
}
