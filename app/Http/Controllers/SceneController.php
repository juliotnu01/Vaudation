<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Scene,Audition};
use Illuminate\Support\Facades\Storage;
use Auth;
use DB;

class SceneController extends Controller
{
    public function AuditionSpecificWithScenes(Audition $audition, $id_audition)
    {
        try {
            return $audition->where('id', $id_audition)->with('relatedScenes')->first();
        } catch (Exception $e) {
            throw new Exception($e, 1);
            
        }
    }
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
    public function SceneSpesific(Scene $scene, $id_audition)
    {
        try {
            $s = $scene->where('id_audition', $id_audition)->get();
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
                if (is_file($request->script_attached_audition)) {
                    $pdf = Storage::disk('public')->put('auditions/PDF', $request->file('script_attached_audition'));
                }else {
                    $pdf = null;
                }
                $scene->character_scene = $request->character_scene;
                $scene->descripction_character_scene = $request->descripction_character_scene;
                $scene->script_attached_audition = asset($pdf);
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
