<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\AuditionScene;
use DB;
use Auth;

class GuardarVideoController extends Controller
{
    public function guardarVideo(Request $request,AuditionScene $audition)
    {
        $path = $request->file('video')->storeAs('videos', $request->file('video')->getClientOriginalName(), 'public');

        try {
            return DB::transaction(function() use ($request, $audition, $path){
                $audition->url_upload_video_audition = asset($path);
                $audition->scene_id = $request->scene_id;
                $audition->created_by =  Auth::id();
                $audition->updated_by = Auth::id();
                $audition->save();
            });
        } catch (Exception $e) {
            throw new Exception($e, 1);
            
        }
    }
}