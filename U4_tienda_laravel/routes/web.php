<?php

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
});

//Definir una ruta basica pra ver todos los productos
//Ruta para ver todos los productos
Route::get('Productos', function(){
    echo 'PAGINA PARA VER TODOS LOS PRODUCTOS';
});

//Definir ruta para crear un producto (ruta basica)
Route::get('Productos/crear', function(){
    echo 'PAGINA PARA CREAR UN PRODUCTO';
});

//Definir una ruta con un parametro
//Ruta para ver un producto concreto, pasandoel id
Route::get('Productos/{idP}', function($idP){
    echo 'PAGINA PARA VER EL PRODUCTO '.$idP;
});

Route::get('Productos/borrar/{idP}', function($idP){
    echo 'PAGINA PARA BORRAR EL PRODUCTO '.$idP;
});

Route::get('Productos/modificar/{idP}', function($idP){
    echo 'PAGINA PARA MODIFICAR EL PRODUCTO '.$idP;
});

Route::get('Productos/modificar/{idP}/{texto}', function($idP, $texto){
    echo '<h1>'.$texto.'</h1>';
    echo 'PAGINA PARA MODIFICAR EL PRODUCTO '.$idP;
});