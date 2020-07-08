<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\ContactUser;
use App\Mail\SelectedActorVauditionerEmail;
use Illuminate\Support\Facades\Mail;

class ContactUserController extends Controller
{
    public function contacUser(Request $request)
    {
        $user = User::find($request->user);
        $user->update([
            'actorHasbinContact' => true
        ]);
        mail::to($user->email)->send(new SelectedActorVauditionerEmail($request->note));

        return ContactUser::create([
            'note' => $request->note,
            'email_contact' => $user->email,
            'user_id' => $user->id,
            'character' => $request->character
        ]);

    }
}
