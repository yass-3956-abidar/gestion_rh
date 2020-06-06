<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactModel extends Model
{

    protected $fillable = [
        'id_employer', 'nom', 'email', 'subject', 'id_societe',
    ];
    public function employer()
    {
        return $this->belongsTo('App\Employer');
    }
}
