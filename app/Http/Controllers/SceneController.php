<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Scene,Audition};
use Auth;
use DB;

class SceneController extends Controller
{
    public function index(Scene $scene)
    {
        try {
            $s = $scene->all();
            foreach ($s as $key => $value) {
                     
                $value->audition = Audition::find($value->id_audition);
            }
            return $s;
        } catch (Exception $e) {
            throw new Exception($e, 1);
            
        }
    }
    public function store(Scene $scene, Request $request)
    {
        try {
            return DB::transaction(function() use ($scene, $request){
                $scene->act_scene = $request->act_scene;
                $scene->numbre_scene = $request->numbre_scene;
                $scene->scene_direction = $request->scene_direction;
                $scene->character_scene = $request->character_scene;
                $scene->descripction_character_scene = $request->descripction_character_scene;
                $scene->dialogue_scene = $request->dialogue_scene;
                $scene->id_audition = $request->id_audition;
                $scene->created_by = Auth::id();
                $scene->updated_by = Auth::id();
                $scene->save();
                return ['mensaje' => 'save'];
            });
        } catch (Exception $e) {
            throw new Exception($e, 1);
            
        }
    }
}
