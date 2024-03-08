<?php

namespace App\Http\Controllers;

use App\Models\reserva;
use App\Models\viajes;
use Faker\Core\Number;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDOException;
use Ramsey\Uuid\Type\Integer;

class ReservasC extends Controller
{
    //

    function verReserva(){
        $viajes = viajes::all();
        return view("reservas/reserva", compact("viajes"));
    }

    function crearReserva(Request $r){

        $r->validate([
            "viaje"=>"required",
            "fecha"=>"required",
            "nombre"=>"required",
            "nPersonas"=>"required"
        ]);

        $v = viajes::find($r->viaje);

        if($v->nPlazas < $r->nPeronas){
            return back()->with('mensaje', "No hay suficientes plazas");
        }

        $error = false;
        
        try{
            
            DB::transaction(function () use($r, $v, ) {
                        $total = ((int)$r->nPersonas*$v->pPersona);
                
                        $re = new reserva();
                
                        $re->viaje_id = $v->id;
                        $re->fechaS = $r->fecha;
                        $re->nombreC = $r->nombre;
                        $re->nPersonas = $r->nPersonas;
                        $re->total = $total;
                        $re->anulada = false;
    
                        if($re->save()){
                            $v->nPlazas = $v->nPlazas-$r->nPersonas;
                            $v->save();
                                                        
                        } else{
                            return back()->with('mensaje', "Error al crear reserva");
                        }
                        
                    });
                }
                catch(PDOException $e){
                    $error = true;
                    return back()->with('mensaje', $e->getMessage());
                }
                
                finally{
                    if(!$error){
                        return redirect()->route("verViajes")->with("mensaje", "Reserva creada");
                    } else{
                        return back()->with('mensaje', "Error al crear reserva");
                    }
            }
            


    }
}
