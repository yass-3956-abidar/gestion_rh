<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Presence extends Model
{
    protected $fillable = [
        'employers_id', 'presences_id'
    ];
    public function employers()
    {
        return $this->belongsToMany('App\Employer');
    }
}
