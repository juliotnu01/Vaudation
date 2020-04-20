<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\InvitationsVaudition;
use Illuminate\Support\Facades\Mail;

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
}
