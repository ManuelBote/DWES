<?php

use App\Http\Controllers\libroC;
use App\Http\Controllers\prestamoC;
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

Route::controller(libroC::class)->group(
    function(){

    }
);

Route::controller(prestamoC::class)->group(
    function(){
        Route::get('verPrestamos', 'ver')->name('rutaVer');

        Route::get('crearPrestamos', 'crear')->name('rutaCrear');
        Route::post('insertarPrestamo', 'insertar')->name('rutaInsertar');

        Route::get('modificarPrestamo/{id}', 'modificar')->name('rutaModificar');
        Route::post('actualizarPrestamo/{id}', 'actualizar')->name('rutaActualizar');


    }
);
