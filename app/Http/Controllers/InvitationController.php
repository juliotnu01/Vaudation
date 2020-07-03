<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\InvitationsVaudition;
use Illuminate\Support\Facades\Mail;
use App\User;
use App\Models\Proyect;
use App\Models\Invitation;


class InvitationController extends Controller
{
    public function sendInvitations(Request $request)
    {
        try {
                
            foreach ($request->invitations as $key => $value) {
                Mail::to($value['email'])->send(new InvitationsVaudition());
            }
        } catch (Exception $e) {
            throw new Exception($e, 1);
            
        }
    }

    public function desactiveInvitation(Request $request)
    {
        try {
            $user = User::find($request->user);
            $userInvitation = Proyect::with(['CharacterRelated' => function($q) use ($request) {
                $q->where('id', $request->character)->first();
            }  , 'CharacterRelated.invitationsRelated' => function($q) use ($user) {
                $q->where('email', $user->email)->get();
            }])->get();

            foreach ($userInvitation as $key => $value) {
                foreach ($value->CharacterRelated as $key => $value2) {
                    foreach ($value2->invitationsRelated as $key => $value3) {
                        if ($value3->email == $user->email && $value3->character_id == $request->character) {
                            $inv = Invitation::find($value3->id);
                            $inv->update([
                                'route_invitation_satus' => false
                            ]);
                        }
                    }
                }
            }
        } catch (Exception $e) {
            throw new Exception($e, 1);
            
        }
    }
}
