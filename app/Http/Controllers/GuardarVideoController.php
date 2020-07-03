<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Vaudition;
use DB;
use Auth;

class GuardarVideoController extends Controller
{
    public function guardarVideo(Request $request,Vaudition $audition)
    {
        $path = $request->file('video')->storeAs('videos', $request->file('video')->getClientOriginalName(), 'public');

        try {
            return DB::transaction(function() use ($request, $audition, $path){
                $audition->url_video_upload = asset($path);
                $audition->character_id = $request->character_id;
                $audition->user_id =  $request->id_user;
                $audition->save();
            });
        } catch (Exception $e) {
            throw new Exception($e, 1);
            
        }
    }
}