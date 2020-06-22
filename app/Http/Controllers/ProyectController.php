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
    public function getUserVaudition(User $user, $id)
    {
        try {
            return $user->where('id' ,$id)->first();
        } catch (Exception $e) {
            throw new Exception($e, 1);
            
        }
    }
     public function getUserVauditionAll(User $user, $id)
    {
        try {
            return $user->where('id', '!=', $id)->get();
        } catch (Exception $e) {
            throw new Exception($e, 1);
            
        }
    }
    public function changeStatusUser(Request $request, User $user, $id)
    {
        try {
            $user->find($id)->update(["status_user" => $request->status_user]);
            return ;
        } catch (Exception $e) {
            throw new Exception($e, 1);
            
        }
    }
    public function project(Proyect $project)
    {
        try {
            return $project->all();    
           
        } catch (Exception $e) {
            throw new Exception($e, 1);
        }
          
    }
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
                    $invitation->note = $value->note;
                    $invitation->route_invitation = '/project/'.$project->id.'/character/'.$character->id.'/audition';
                    $invitation->route_invitation_satus = true;
                    $invitation->save();

                    $data = collect(['project_name' => $project->project_name, 'character_name' => $character->character_name, 'note' => $invitation->note, 'link' => env('APP_URL') ]);

                    Mail::to($value->email)->send(new InvitationsVaudition($invitation, $data));
                }

                return Response($project);
            });
        } catch (Exception $e) {
            throw new Exception($e, 1);
            
        }
    }
}
