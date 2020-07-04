<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Question_character,Aswer};
use DB;
use Auth;

class QuestionProyectController extends Controller
{
    public function store(Request $request)
    {
        try {
            return DB::transaction(function() use ($request) {
                foreach ($request->questions as $key => $value) {
                    $answer = new Aswer();
                    $answer->answer_question = $value['answer_question'];
                    $answer->user_id = $request->id_user;
                    $answer->save();
                    $question = Question_character::find($value['id']);
                    $question->relatedAnswer()->attach($answer);
                }
            });
        } catch (Exception $e) {
            throw new Exception($e, 1);
        }
    }
}
