<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Proyect extends Model
{
    protected $table = 'proyect';
    protected $guardad = [];

    public function userRelated()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
     public function CharacterRelated()
    {
        return $this->hasMany(Character::class, 'id_proyect');
    }

  
}
