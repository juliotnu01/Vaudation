<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vaudition;
use DB;
use Auth;


class VauditionController extends Controller
{
    public function store(Request $request, Vaudition $vaudition)
    {
        try {
            return DB::transaction(function() use ($request, $vaudition) {

                $vaudition->url_video_redsocial =  $request->url_audition_red;
                $vaudition->type_redsocial =  $request->red_selected;
                $vaudition->character_id =  $request->character_id;
                $vaudition->user_id = Auth::id();
                $vaudition->save();


            }, 5);
            
        } catch (Exception $e) {
            throw new Exception($e, 1);
            
        }
    }
}
