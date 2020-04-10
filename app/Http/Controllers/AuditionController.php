<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Audition;
use Illuminate\Support\Facades\Storage;
use Auth;
use DB;

class AuditionController extends Controller
{
    public function index(Audition $audition)
    {
        try {
            return $audition->with('relatedUser')->get();
        } catch (Exception $e) {
            throw new Exception($e, 1);
            
        }
    }
    public function getauditionspecific(Audition $audition, $id)
    {
        return $audition->where('id', $id)->with('relatedScenes')->first();
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
                if (is_file($request->attachment_audition)) {
                    $pdf = Storage::disk('public')->put('auditions/PDF', $request->file('attachment_audition'));
                }else {
                    $pdf = null;
                }

                $audition->title_audition = $request->title_audition;
                $audition->description_audition = $request->description_audition;
                $audition->banner_audition = asset($banner);
                $audition->script_attached_audition = asset($pdf);
                $audition->script_text_audition = $request->script_text_audition;
                $audition->end_date_available = $request->picker;
                $audition->created_by = Auth::id();
                $audition->updated_by = Auth::id();
                $audition->save();

            return ['audition' => 'save'];
            }, 5);
        } catch (Exception $e) {
            throw new Exception($e, 1);
        }
    }

}
