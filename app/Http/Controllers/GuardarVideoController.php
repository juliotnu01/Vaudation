<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GuardarVideoController extends Controller
{
    public function guardarVideo(Request $request)
    {
        dd($request);
        $a = asset(Storage::disk('public')->put($request->nombre, $request->video));
        // dd($a);
    }
}
