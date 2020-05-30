<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    protected $table = 'character';
    protected $guardad = [];

    public function invitationsRelated()
    {
        return $this->hasMany(Invitation::class, 'character_id');
    }

    public function questions()
    {
        return $this->hasMany(Question_character::class, 'character_id');
    }
    public function vauditionRelated(){
        return $this->hasMany(Vaudition::class);
    }
}
