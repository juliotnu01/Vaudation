<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatusPublic extends Model
{
    protected $table = 'status_public';
    protected $guarded = [];

    public function auditionPublic()
    {
        return $this->belongsTo(Audition::class,'id');
    }
    public function scenePublic()
    {
        return $this->belongsTo(Scene::class,'id');
    }
}
