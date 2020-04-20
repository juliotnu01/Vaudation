<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Audition,Proyect};
use Illuminate\Support\Facades\Storage;
use Auth;
use DB;

class AuditionController extends Controller
{
    public function index(Audition $audition, $id_proyect)
    {
        try {
            return $audition->where('id_proyect', $id_proyect)->with('relatedUser')->get();
        } catch (Exception $e) {
            throw new Exception($e, 1);
            
        }
    }
    public function getauditionspecific(Proyect $project, $id_project, $id_audition)
    {
        return $project->with(['relatedCasting' => function($q) use ($id_audition){
             return  $q->where('id', $id_audition)->first();
        }, 'relatedCasting.relatedScenes' , 'relatedQuestionProject', 'relatedQuestionProject.relatedAnswer' => function($q){
            return $q->where('user_id', Auth::id());
        }])->where('id', $id_project)->first();
    }
     public function relatedAuditionWithScene(Audition $audition)
    {
        try {
            return $audition->with('relatedScenes')->get();
        } catch (Exception $e) {
            throw new Exception($e, 1);
            
        }
    }
    public function store(Request $request, Audition $audition)
    {
        try {
            return DB::transaction(function() use ($request, $audition){
                if (is_file($request->banner_audition)) {
                    $banner = Storage::disk('public')->put('auditions/banner', $request->file('banner_audition'));
                }else{
                    $banner = null;
                }

                $audition->title_audition = $request->title_audition;
                $audition->description_audition = $request->description_audition;
                $audition->banner_audition = asset($banner);
                $audition->end_date_available = $request->picker;
                $audition->id_proyect = $request->id_project;
                $audition->created_by = Auth::id();
                $audition->updated_by = Auth::id();
                $audition->save();

            return Response($audition);
            }, 5);
        } catch (Exception $e) {
            throw new Exception($e, 1);
        }
    }

}
