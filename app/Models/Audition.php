<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Audition extends Model
{
    protected $table = 'audition';
    protected $guarded = [];

    public function relatedScenes()
    {
        return $this->hasMany(Scene::class, 'id_audition');
    }
    public function relatedUser(){
        return $this->belongsTo(User::class, 'created_by');
    }
}
