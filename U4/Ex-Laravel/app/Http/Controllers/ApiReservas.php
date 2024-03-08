<?php

namespace App\Http\Controllers;

use App\Models\reserva;
use App\Models\viajes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiReservas extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return reserva::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $r, $idR)
    {
        
        $r = reserva::find($idR);
        $v = viajes::find($r->viaje_id);

        if($r->anulada == true){
            return response()->json("Reserva ya anulada", 500);
        }

        $error = false;

        try {
            DB::transaction(function () use($r, $v){
                $r->anulada=true;
                
                if($r->save()){
                    $v->nPlazas = $v->nPlazas+$r->nPersonas;
                    $v->save();
                }


            });
        } catch (\Throwable $th) {
            $error = true;
            return response()->json($th->getMessage(), 500);
        }

        finally{
            if(!$error){
                return response()->json("Reserva anulada", 200);
            }
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

}
