<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDOException;

class ClienteC extends Controller
{

    function __construct(){
        $this->middleware('auth');
    }


    //Metodo que maneja la ruta productos
    function clientes(){
        $clientes = Cliente::all();
        return view('clientes/clientes', compact("clientes"));
    }

    // //Metodo que maneja la ruta crearP
    // function crearC(){
    //     return view('clientes/crear');
    // }

    // function insertarC(Request $r){
    //     $r->validate([
    //         "email"=>"required | unique:App\Models\Cliente,email", //Requerido y unico
    //         "nombre"=>"required", //Requerido
    //         "telefono"=>"required | min:9", //Requerido y minimo 9 cifras
    //         "direccion"=>"required", //Requerido
    //     ]);

    //     $c = new Cliente();

    //     $c->email= $r->email;
    //     $c->nombre= $r->nombre;
    //     $c->telefono= $r->telefono;
    //     $c->direccion= $r->direccion;

    //     if($c->save()){
    //         return redirect()->route('clientes')->with('mensaje', 'Cliente creado con el ID:'.$c->id);
    //     } else{
    //         return back()->with('mensaje', 'Error al crear el cliente');
    //     }

        
    // }

    //Metodo que maneja la ruta verP
    function verC($idC){
        return 'Pagina para ver el producto '.$idC;
    }

    //Metodo que maneja la ruta modificarP
    function modificarC($idC){
        $c = Cliente::find($idC);
        return view('clientes/modificar', compact("c"));
    }

    function actualizarC(Request $r, $idC){
        $r->validate([
            "email"=>"required", //Requerido
            "nombre"=>"required", //Requerido
            "telefono"=>"required | min:9", //Requerido y minimo 9 cifras
            "direccion"=>"required", //Requerido
        ]);

        $c = Cliente::find($idC);

        if($r->email != $c->usuario->email){
            $r->validate([
            "email"=>"unique:App\Models\User,email", //Unico
            ]);
        }
        
        $c->usuario->email= $r->email;
        $c->usuario->name= $r->nombre;
        $c->telefono= $r->telefono;
        $c->direccion= $r->direccion;

        $error = false;

        try {

            DB::transaction(function() use($c){
                if($c->save()){
                    if(!$c->usuario->save()){
                        return back()->with('mensaje', 'Error al modificar el cliente  con el ID:'.$c->id);
                    }
                } else{
                    return back()->with('mensaje', 'Error al modificar el cliente  con el ID:'.$c->id);
                }
            });
            
        } catch (PDOException $e) {
            $error = true;
            return back()->with('mensaje', 'Error al modificar el cliente  con el ID:'.$c->id);
        }
        finally{
            if(!$error){
                return redirect()->route('clientes')->with('mensaje', 'Cliente modificado');
            }
        }
    }
    
    //Metodo que maneja la ruta borrarP
    function borrarC($idC){
        $c = Cliente::find($idC);

        //Si tiene pedido no podemos borrar
        $error = false;

        try {

            DB::transaction(function() use($c){
                if(sizeof($c->pedido())>0){
                    return back()->with('mensaje', 'Error, el cliente ya tiene pedidos');
                } else{
                        if($c->delete()){
                            if(!$c->usuario->delete()){
                                return back()->with('mensaje', 'Error, al borrar cliente');
                            }
                        
                    }
                }
            });
            
        } catch (PDOException $e) {
            $error = true;
            return back()->with('mensaje', 'Error al borrar el cliente');
        }
        finally{
            if(!$error){
                return redirect()->route('clientes')->with('mensaje', 'Cliente Borrado');
            }
        }


    }
}
