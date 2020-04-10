<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatusAvailable extends Model
{
    protected $table = 'status_available';
    protected $guarded = [];

    public function auditionAvailable()
    {
        return $this->belongsTo(Audition::class,'id');
    }
    public function sceneAvailable()
    {
        return $this->belongsTo(Scene::class,'id');
    }
}
