<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Proyect;
use App\Mail\ActivateUserMail;
use Illuminate\Support\Facades\Mail;
use DB;


class ActivateUSerMailController extends Controller
{
    private $ruta = '';
    public function activate($id)
    {

        try {
            $user = User::where('id', $id)->first();

            
                $random_number = intval( "0" . rand(1,9) . rand(0,9) . rand(0,9) . rand(0,9) . rand(0,9) );

                User::where('id', $id)->update([
                    'code_activation' => $random_number
                ]);

                Mail::to($user->email)->send(new ActivateUserMail($random_number));
            
        } catch (Exception $e) {
         throw new Exception($e, 1);
               
        }

    }
    public function activateAccount(Request $request)
    {
        return DB::transaction( function() use ($request){
            $user = User::find($request->user);
            if ($user->code_activation == $request->code) {
                $user->update([
                    'status_user' => true
                ]);
            }
            return Proyect::with(['CharacterRelated', 'CharacterRelated.invitationsRelated' => function($q) use ($user){
                    $q->where('email', $user->email)->where('route_invitation_satus', true)->get();
                }])->get();


        }, 5);
    }
}
