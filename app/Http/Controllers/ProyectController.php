<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Proyect,Character,QuestionProyect};
use DB;
use Auth;

class ProyectController extends Controller
{
    public function index(Proyect $project)
    {
        try {
            return $project->with('relatedCasting')->get();
        } catch (Exception $e) {
            throw new Exception($e, 1);
            
        }
    }
    public function store(Request $request, Proyect $project)
    {

        try {
            return DB::transaction(function() use ($project, $request){
                $project->project_name = $request->project_name;
                $project->save();

                foreach ($request->characters as $key => $value) {
                    $character = new Character;
                    $character->character_name = $value['name'];
                    $character->description_character = $value['description'];
                    $character->id_proyect = $project->id;
                    $character->save();
                }
                foreach ($request->questions as $key => $value) {
                    $question = new QuestionProyect;
                    $question->question_proyect = $value['question'];
                    $question->id_proyect = $project->id;
                    $question->save();
                }
                return Response($project);
            });
        } catch (Exception $e) {
            throw new Exception($e, 1);
            
        }
    }
}
