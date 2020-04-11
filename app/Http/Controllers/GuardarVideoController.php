<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GuardarVideoController extends Controller
{
    public function guardarVideo(Request $request)
    {
        $path = $request->file('video')->storeAs('videos', $request->file('video')->getClientOriginalName(), 'public');;
        return $path;
    }
}