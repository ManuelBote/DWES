<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class CarritoC extends Controller
{
    //
    function __construct(){
        $this->middleware('auth');
    }

    function insertarCarrito(Request $r){
        $producto = Producto::find($r->carrito);
        //El carrito se almacena en una variable de sesion

        if(session('carrito')==null){
            $carrito = array();
        } else{
            $carrito = session('carrito');
        }

        $actualizado=false;

        foreach($carrito as $clave=>$c){
            if($c['producto']->id == $producto->id){
                $carrito[$clave]['cantidad'] = $r->cantidad;
                $actualizado = true;
            }
        }
        
        if(!$actualizado){
            $carrito[]=array('producto'=>$producto,'cantidad'=>1);
        }

        session(['carrito'=>$carrito]);

        return back()->with('mensaje', 'Producto añadido al carrito');
    }

    function verCarrito(){
        return view('carrito/verCarrito');
    }

    function modificarCarrito(Request $r){

        $carrito = session("carrito");

        if($r->modificarPC!=null){
            foreach($carrito as $clave=>$c){
                if($c['producto']->id == $r->modificarPC){
                    $carrito[$clave]['cantidad'] = $c['cantidad']+1;
                    session(['carrito'=>$carrito]);
                    return back()->with('mensaje', 'Producto modificado');
                    
                }
            }

        } 
        elseif($r->borrarPC!=null){
            foreach($carrito as $clave=>$c){
                if($c['producto']->id == $r->modificarPC){
                    unset($carrito[$clave]);
                    $carrito=array_values($carrito);
                    session(['carrito'=>$carrito]);
                    return back()->with('mensaje', 'Producto modificado');
                    
                }
            }


        }
        session(['carrito'=>$carrito]);
    }
}
