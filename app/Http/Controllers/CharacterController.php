<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Character;

class CharacterController extends Controller
{
    public function index(Character $character, $id_proyect)
    {
        return $character->where('id_proyect', $id_proyect)->get();
    }
    
}
