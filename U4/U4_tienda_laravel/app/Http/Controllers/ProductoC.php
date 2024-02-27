<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

//Al utilizar SAVE() laravel sabe si hay que hacer un insert o un update dependiendo de como se cree el objeto (Con NEW o con FIND)

class ProductoC extends Controller
{

    function __construct(){
        $this->middleware('auth');
    }

    //Metodo que maneja la ruta productos
    function productos(){
        //Recuperar los productos para mostrarlos en la vista de la tabla productos
        $productos = Producto::all();
        
        if(Auth::user()->tipo=='A'){
            return view('productos/productos', compact('productos'));
        }else{
            return view('productos/productosC', compact('productos'));
        }
    }

    //Metodo que maneja la ruta crearP
    function crear(){
        return view('productos/crear');
    }

    // Este metodo se llama desde el submit del formulario 
    // para acceder a los campo del formulario hay que
    // definir un parametro de la clase Request
    function insertar(Request $r){
        //VALIDACIONES
        //Todos los campos rellenos | Nombre de producto no se puede repetir | Precio y stock no pueden ser negativo
        $r->validate([
            "nombre"=>"required | unique:App\Models\Producto,nombre", //Requerido y unico
            "descripcion"=>"required", //Requerido
            "precio"=>"required | gte:0", //Requerido y no negativo
            "stock"=>"required | gte:0", //Requerido y no negativo
            "imagen"=>"required" //Requerido
        ]);

        //Creamos un objeto del modelo producto
        $p = new Producto();
        //Rellenar los datos del producto a partir de los campos del formulario
        $p->nombre = $r->nombre;
        $p->descripcion = $r->descripcion;
        $p->precio = $r->precio;
        $p->stock = $r->stock;
        //Subir imagen del producto al servidor y rellenar el producto con la ruta de la imagen
        //El fichero se almacena en storage/app/public/img/Producto
        $ruta=$r->file('imagen')->store('img/producto', 'public');
        $p->img=$ruta;
        
        if($p->save()){
            //Volvemos a la pagina anterio y mostramos mensaje
            return redirect()->route('productos')->with('mensaje', 'Producto creado con el ID ' .$p->id);
        } else{
            return back()->with('mensaje', 'Error al crear el producto');
        }
         
    }


    //Metodo que maneja la ruta verP
    function ver($idP){
        return 'Pagina para ver el producto '.$idP;
    }

    //Metodo que maneja la ruta modificarP
    function modificar($idP){
        //Recuperar los datos del producto
        $p = Producto::find($idP);
        return view('productos/modificar', compact('p'));
    }

    function actualizarP(Request $r, $idP){

        $r->validate([
            "nombre"=>"required", //Requerido y unico
            "descripcion"=>"required", //Requerido
            "precio"=>"required | gte:0", //Requerido y no negativo
            "stock"=>"required | gte:0", //Requerido y no negativo
        ]);
        //Recuperamos los datos del producto antes de modificar
        $p = Producto::find($idP);

        if($r->nombre != $p->nombre){
            $r->validate([
            "nombre"=>"unique:App\Models\Producto,nombre", //Requerido y unico
            ]);
        }

        //Modificamos los campos que se hayan podido cambiar
        $p->nombre = $r->nombre;
        $p->descripcion = $r->descripcion;
        $p->precio = $r->precio;
        $p->stock = $r->stock;

        //Subir nueva imagen si se a modificado
        if(!empty($r->imagen)){
            //Borrar img antigua y subir la nueva
            Storage::delete('public/'.$p->img);
            $ruta=$r->file('imagen')->store('img/producto', 'public');
            $p->img = $ruta;
        }

        //Modificar el producto en la base de datos
        if($p->save()){
            return back()->with('mensaje', 'Producto modificado');
        } else{
            return back()->with('mensaje', 'Error al modificar el producto con ID:'.$p->id);
        }
        
    }

    //Metodo que maneja la ruta borrarP
    function borrar($idP){
        //Obtener el producto a borrar
        $p = Producto::find($idP);

        //Si tiene pedido no podemos borrar
        if(sizeof($p->detalle_pedidos())>0){
            return back()->with('mensaje', 'Error, el producto ya tiene pedidos');
        } else{
            //Borrar imagen
            if($p->delete()){
                Storage::delete('public/'.$p->img);
                return back()->with('mensaje', 'Producto borrado');
            }
        }

    }
}
