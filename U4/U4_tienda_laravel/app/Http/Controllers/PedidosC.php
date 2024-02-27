<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Pedido;
use App\Models\Pedido_Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDOException;

class PedidosC extends Controller
{

    function __construct(){
        $this->middleware('auth');
    }
    
    function pedidos(){
        //Recuperar el cliente asociado al usuario
        //Recuperar sus pedidos
        
        if(Auth::user()->tipo=='A'){
            $pedidos = Pedido::all();
            return view('pedidos/pedidos', compact('pedidos'));
        }else{
            $cliente = Cliente::where('user_id', Auth::user()->id)->first();
            $pedidos = Pedido::where('cliente_id', $cliente->id)->get();
            return view('pedidos/pedidosC', compact('pedidos'));
        }
    }

    function crearPedido(){

        if(session('carrito')==null or sizeof(session('carrito'))==0){
            return back()->with('mensaje', 'Error no hay productos en el carrito');
        }

        $error = false;
        //Crear el pedido a partir de la variable de sesion y el usuario loguado

        try {
            DB::transaction(function () {
                
                $p = new Pedido();
                $p->fecha = date('YmdHis');
        
                $c = Cliente::where('user_id', Auth::user()->id)->first();
                $p->cliente_id = $c->id;
    
                if($p->save()){
                     $carrito = session('carrito');
    
                     foreach($carrito as $pc){
                        $nuevo = new Pedido_Producto();
                        $nuevo->cantidad = $pc['cantidad'];
                        $nuevo->precioU = $pc['producto']->precio;
                        $nuevo->pedido_id = $p->id;
                        $nuevo->producto = $pc['producto']->id;
                        $nuevo->save();
                     }
    
                     return redirect()->route('pedidos')->with('mensaje', 'Pedido realizado con id:'.$p->id);
                    }
                    
                });
            } catch (PDOException $th) {
                $error=true;
                return back()->with('mensaje', 'Error no se ha creado pedido'. $th->getMessage());
                
            }
            finally{
                if(!$error){
                    session()->forget('carrito');
                    return redirect()->route('pedidos')->with('mensaje', 'Pedido realizado');
            }
        }
        
    }

}
