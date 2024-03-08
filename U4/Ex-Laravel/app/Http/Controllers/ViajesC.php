<?php

namespace App\Http\Controllers;

use App\Models\viajes;
use Illuminate\Http\Request;

class ViajesC extends Controller
{
    //


    function verViajes(){
        $viajes = viajes::all();
        return view('viajes/viajes', compact('viajes'));
    }

}
