<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Scene extends Model
{
    protected $table = 'scene';
    protected $guarded = [];

    public function relatedAudition()
    {
        return $this->belongsTo(Audition::class,'id_audition');
    }
    public function relatedAuditionScene()
    {
        return $this->hasMany(AuditionScene::class, 'scene_id');
    }
}
