<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Character, Proyect};

class CharacterController extends Controller
{
    public function index(Proyect $Proyect, $id_proyect)
    {
        return $Proyect->with('CharacterRelated')->where('id',  $id_proyect)->first();
    }
    public function characterSpesific(Proyect $Proyect , $id_proyect, $id_character )
    {
        return $Proyect->with(['CharacterRelated' => function($q) use ($id_character){
            $q->where('id', $id_character)->get();
        }])->where('id',  $id_proyect)->first();
    }
    
}
