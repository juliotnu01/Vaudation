<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vaudition extends Model
{
    protected $guarded = [];
    protected $hidden = [];

    public function questions()
    {
        return $this->hasMany(Question_character::class, 'character_id');
    }

    public function character()
    {
        return $this->belongsTo(character::class, 'character_id');
    }
}

