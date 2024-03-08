<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use PDOException;

class LoginC extends Controller
{
    //
    function login(){
        //Carga la vista de login
        return view('login/loguear');
    }

    function loguear(Request $r){
        //Abrir sesion
        $r->validate([
            'email'=>'required',
            'ps'=>'required'
        ]);

        $credenciales = ['email'=>$r->email, 'password'=>$r->ps];

        if(Auth::attempt($credenciales)){
            $r->session()->regenerate();
            return redirect()->route('productos');
        } else{
            return redirect()->back()->with('mensaje', 'Datps incorrectos');
        }
        
    }

    function registro(){
        //Cargar registro
        return view('login/registrar');
    }

    function registrar(Request $r){
        //Crea un usuario
        $r->validate([
            'nombre'=>'required|string', //Requerido y formato string
            'email'=>'required|email|unique:App\Models\User,email',
            'ps1'=> 'required',
            'ps2'=> 'required|same:ps1',
            'telf'=>'required',
            'dir'=>'required'
        ]);
        
        $error = false;

        try {
            
            DB::transaction(function() use($r){
                //Crear usuario
                $u = new User();
                $u->name=$r->nombre;
                $u->email=$r->email;
                $u->password=Hash::make($r->ps1);
                $u->tipo='C';
            
                if($u->save()){
                    //Crear el cliente
                    $c = new Cliente();
                    $c->telefono=$r->telf;
                    $c->direccion = $r->dir;
                    $c->user_id = $u->id;
            
                    if($c->save()){
                        //Logueamos al usuario directamente
                        Auth::login($u);

                    } else{
                        return back()->with('mensaje', 'Error al crear el cliente');
                    }
            
                } else{
                    return back()->with('mensaje', 'Error al crear el usuario');
                }
    
            });

        } catch (PDOException $e) {
            $error = true;
            return back()->with('mensaje', $e->getMessage());
        }
        finally{
            if($error==false){
                return redirect()->route('productos');
            }
        }
    
        
    }

    function salir(){
        //Cerrar sesion y devolver a login
        Auth::logout();
        return redirect()->route('login');

        
    }
}
