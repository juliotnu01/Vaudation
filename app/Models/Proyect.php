<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proyect extends Model
{
    protected $table = 'proyect';
    protected $guardad = [];

    public function relatedCasting()
    {
        return $this->hasMany(Audition::class, 'id_proyect');
    }
}
