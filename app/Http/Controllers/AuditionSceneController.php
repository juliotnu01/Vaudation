<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AuditionScene;
use DB;
use Auth;

class AuditionSceneController extends Controller
{
    public function store(Request $request, AuditionScene $audition)
    {
        try {
            return DB::transaction(function() use ($request, $audition){
                $audition->url_audition_red = $request->url_audition_red;
                $audition->scene_id = $request->scene_id;
                $audition->red_selected = $request->red_selected;
                $audition->created_by =  Auth::id();
                $audition->updated_by = Auth::id();
                $audition->save();
            });
        } catch (Exception $e) {
            throw new Exception($e, 1);
            
        }
    }
}
