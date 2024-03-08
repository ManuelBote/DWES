<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Pedido;
use App\Models\Pedido_Producto;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDOException;

class ApiPedido extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        // Crea un pedido con un producto
        //Parametros: idP, idC, cantidad
        $request->validate([
            'idP'=>'required',
            'idC'=>'required',
            'cantidad'=>'required|gte:1',
        ]);

        $pr = Producto::find($request->idP);
        if($pr==null){
            return response()->json('Error, no existe el producto', 500);
        }
        if($pr->stock < $request->cantidad){
            return response()->json('Error, no hay stock de producto', 500);
        } else{
            $cant = $request->cantidad;
        }
        
        $c = Cliente::find($request->idC);
        if($c==null){
            return response()->json('Error, no existe el cliente', 500);
        }

        $p = null;

        $error = false;
        //Crear el pedido a partir de la variable de sesion y el usuario loguado
        try {
            //DB::transaction(function ()use($pr, $c, $cant, $p) {
                
                $p = new Pedido();
                $p->fecha = date('YmdHis');
                $p->cliente_id = $c->id;
                
                if($p->save()){
                    
                    $nuevo = new Pedido_Producto();
                    $nuevo->cantidad = $cant;
                    $nuevo->precioU = $pr->precio;
                    $nuevo->pedido_id = $p->id;
                    $nuevo->producto = $pr->id;
                    if($nuevo->save()){
                        $pr->stock=$pr->stock-$cant;
                        $pr->save();
                    }
                    
                }
                
                    
           // });
        } catch (PDOException $th) {
            $error=true;
            return response()->json($th->getMessage(), 500);              
        }
        finally{
        }
        
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function obtenerPedidoCliente(string $id){
        $pedidos = Pedido::where("cliente_id", $id)->get();
        $detalles = array();
        foreach($pedidos as $p){
            foreach($p->detalle() as $d){
                $detalles[] = $d;
            }
        }
        return $detalles;
    }
}
