<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Character, Proyect, Question_character};
use Illuminate\Support\Facades\Storage;
use DB;
use Auth;
use App\User;

class CharacterController extends Controller
{
    public function index(Proyect $Proyect, $id_proyect)
    {
        return $Proyect->with('CharacterRelated')->where('id',  $id_proyect)->first();
    }

    public function characterSpesific(Character $character , $id_user, $id_character)
    {   
       
        try {
            $user = User::where('id', $id_user)->first();
            if ($user->rol_user === 1) {
                $result = $character->with(['vauditionRelated', 'questions'])->where('id',$id_character)->first();

                foreach ($result->vauditionRelated as $key => $value) {
                    $value->questions = Question_character::where('character_id', $value->character_id)->with(['relatedAnswer' => function($q) use ($value) {
                        $q->where('user_id', $value->user_id);
                    }])->get();

                     $value->userPost = User::where('id', $value->user_id)->first();

                }

                return $result ;
            }else {

                $result = $character->with(['vauditionRelated' => function($q) use ($id_user){
                    $q->where('user_id', $id_user);
                }, 'questions'])->where('id',$id_character)->first();

                foreach ($result->vauditionRelated as $key => $value) {
                    $value->questions = Question_character::where('character_id', $value->character_id)->with(['relatedAnswer' => function($q) use ($value) {
                        $q->where('user_id', $value->user_id);
                    }])->get();
                    
                     $value->userPost = User::where('id', $value->user_id)->first();

                }

                return $result;
            }
        } catch (Exception $e) {
            
        }
        // return $Proyect->with(['CharacterRelated' => function($q) use ($id_character){
        //     $q->where('id', $id_character)->get();
        // }])->where('id',  $id_proyect)->first();
    }

    public function store(Request $request , Character $character)
    {
        try {
            return DB::transaction(function() use ($request, $character) {
                $questions = json_decode($request->questions);
                if (is_file($request['script_file'])) {
                    $script = Storage::disk('public')->put('scripts', $request->file('script_file'));
                }else{
                    $script = null;
                }
                    $character->character_name = $request['name'];
                    $character->description_character = $request['description'];
                    $character->id_proyect = $request['id'];
                    $character->script_attached_audition = asset($script);
                    $character->save();

                    foreach ($questions as $key => $value) {
                       $questions = new  Question_character();
                       $questions->question_proyect = $value->question;
                       $questions->character_id  = $character->id;
                       $questions->save();
                    }

            });
        } catch (Exception $e) {
            throw new Exception($e, 1);
            
        }
    
    }
}