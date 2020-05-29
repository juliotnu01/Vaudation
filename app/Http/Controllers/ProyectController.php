<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Proyect,Character,Question_character,Invitation};
use Illuminate\Support\Facades\Storage;
use App\Mail\InvitationsVaudition;
use Illuminate\Support\Facades\Mail;
use DB;
use Auth;
use App\User;

class ProyectController extends Controller
{
    public function index(User $User, $id_user)
    {
        try {
            return $User->with( 'projectRelated','projectRelated.userRelated', 
                                'projectRelated.CharacterRelated.invitationsRelated', 
                                'projectRelated.CharacterRelated.questions')->where('id', $id_user)->first();    
           
        } catch (Exception $e) {
            throw new Exception($e, 1);
            
        }
    }
    public function store(Request $request, Proyect $project, Character $character, Question_character $questions)
    {
        $var_project = json_decode($request->character);
        // dd($project->get()->last());
        
        try {
            return DB::transaction(function() use ($request, $project,$var_project, $character){
                if ($project->get()->last() === null) {
                   
                    $project->project_name = $request['project_name'];
                    $project->user_id = Auth::id();
                    $project->save();

                } else {

                     if ($project->get()->last()->project_name === $request['project_name'] ) {
                        $project->id = $project->get()->last()->id;
                    } else {

                    $project->project_name = $request['project_name'];
                    $project->user_id = Auth::id();
                    $project->save();

                    }

                }

                if (is_file($request['script_file'])) {
                    $script = Storage::disk('public')->put('scripts', $request->file('script_file'));
                }else{
                    $script = null;
                }

                $character->character_name = $var_project->name;
                $character->description_character = $var_project->description;
                $character->id_proyect = $project->id;
                $character->script_attached_audition = asset($script);
                $character->save();

                foreach ($var_project->questions as $key => $value) {
                   $questions = new  Question_character();
                   $questions->question_proyect = $value->question;
                   $questions->character_id  = $character->id;
                   $questions->save();
                }

                foreach ($var_project->invitations as $key => $value) {

                    $invitation =  new Invitation();
                    $invitation->name = $value->name; 
                    $invitation->email = $value->email;  
                    $invitation->character_id = $character->id; 
                    // $invitation->note = $var_project->invitation->note;
                    $invitation->save();
                    // Mail::to($value->email)->send(new InvitationsVaudition());
                }

                return Response($project);
            });
        } catch (Exception $e) {
            throw new Exception($e, 1);
            
        }
    }
}
