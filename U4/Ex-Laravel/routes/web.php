<?php

use App\Http\Controllers\ReservasC;
use App\Http\Controllers\ViajesC;
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

Route::controller(ViajesC::class)->group(function(){

    Route::get('viajes', "verViajes")->name("verViajes");

});

Route::controller(ReservasC::class)->group(function(){

    Route::get('reserva', "verReserva")->name("verReserva");
    Route::post('reserva/crear', "crearReserva")->name("crearReserva");

});
