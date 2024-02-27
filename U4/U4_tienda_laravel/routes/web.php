<?php

use App\Http\Controllers\CarritoC;
use App\Http\Controllers\ProductoC;
use App\Http\Controllers\ClienteC;
use App\Http\Controllers\LoginC;
use App\Http\Controllers\PedidosC;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name("inicio");


// ----------------------------------------------Productos-------------------------------------------------------- //

Route::controller(ProductoC::class)->group(function(){
 
    
    //Ruta para ver todos los productos
    Route::get('productos', 'productos')->name("productos");

    //Definir ruta para crear un producto (ruta basica)
    Route::get('productos/crear', 'crear')->name('crearP');
    Route::post('productos/insertar', 'insertar')->name('insertarProducto');

    //Definir una ruta con un parametro
    //Ruta para ver un producto concreto, pasando el id
    Route::get('productos/{idP}', 'ver')->name('verP');

    Route::delete('productos/borrar/{idP}', 'borrar')->name('borrarP');

    Route::get('productos/modificar/{idP}', 'modificar')->name('modificarP');
    Route::put('productos/modificar/{idP}', 'actualizarP')->name('actualizarP');



});


// ----------------------------------------------Clientes-------------------------------------------------------- //

Route::controller(ClienteC::class)->group(function(){

    Route::get('clientes', 'clientes')->name("clientes");

    // Route::get('clientes/crear', 'crearC')->name('crearC');
    // Route::post('clientes/insertar', 'insertarC')->name('insertarCliente');

    Route::get('clientes/{idC}', 'verC')->name('verC');

    Route::delete('clientes/borrar/{idC}', 'borrarC')->name('borrarC');

    Route::get('clientes/modificar/{idC}', 'modificarC')->name('modificarC');
    Route::put('clientes/modificar/{idC}', 'actualizarC')->name('actualizarC');


});


// ----------------------------------------------Clientes-------------------------------------------------------- //

Route::controller(LoginC::class)->group(function(){

    Route::get('login','login')->name('login'); //Carga form login
    Route::post('login','loguear')->name('loguear'); //Inicio de sesion

    Route::get('login/registro','registro')->name('registro'); //Carfa form registro
    Route::post('login/registro','registrar')->name('registrar'); //Crea usuario y cliente

    Route::get('login/salir','salir')->name('salir'); //Cierra sesion
});
   

// ----------------------------------------------Pedidos-------------------------------------------------------- //

Route::controller(PedidosC::class)->group((function(){

    Route::get('pedidos', 'pedidos')->name('pedidos');
    Route::post('pedidos/crear', 'crearPedido')->name('crearPedido');

    
}));


// ----------------------------------------------Carrito-------------------------------------------------------- //

Route::controller(CarritoC::class)->group((function(){

    Route::post('carrito', 'insertarCarrito')->name('aCarrito');
    Route::get('carrito', 'verCarrito')->name('verCarrito');


    
}));



Route::get('Productos/modificar/{idP}/{texto}', function($idP, $texto){
    echo '<h1>'.$texto.'</h1>';
    echo 'PAGINA PARA MODIFICAR EL PRODUCTO '.$idP;
});

//Definir una ruta con dos parametros y una de ellos opcional (untexto)
Route::get('Productos/opt/{idP}/{unTexto?}', function($idP, $texto=null){
    echo '<h1>'.$texto!=null?$texto:''.'</h1>';
    echo 'Pagina para ver como se define un parametro opcional '.$idP;
});