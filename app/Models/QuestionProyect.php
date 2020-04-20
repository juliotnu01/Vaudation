<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionProyect extends Model
{
    protected  $table = 'question_proyect';
    protected  $guarded = [];

    public function relatedAnswer()
    {
        return $this->belongsToMany(Aswer::class);
    }
}
