<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question_character extends Model
{

    protected $table = 'question_character';
    protected $guarded = [];


    public function relatedAnswer()
    {
        return $this->belongsToMany(Aswer::class);
    }
    
}
