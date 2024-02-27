<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use App\Models\prestamo;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDO;
use PDOException;

class prestamoC extends Controller
{
    //

    function ver(){
        $prestamos = prestamo::all();
        return view('verP', compact('prestamos'));
    }

    function crear(){
        $libros = Libro::all();

        return view('crearP', compact('libros'));
    }

    function insertar(Request $r){
        $r->validate([
            'fecha'=>'required',
            'libro'=>'required',
            'cliente'=>'required'
        ]);

        $l = Libro::find($r->libro);

        if($l!=null and $l->numEjemplares>0){
            //Chequear que el cliente no tenga prestamos pendientes
            $pendiente = prestamo::where('nombreCliente',$r->cliente)->where('fechaDevolucion',null)->get();
            if(sizeof($pendiente)>0){
                return back()->with('mensaje', 'Error, el cliente tiene libros sin devolver');
            } else{
                //Registrar prestamo y actualizar el numero de ejemplares
                try {
                    $error = false;
                    $mensaje = "";
                    DB::transaction(function()use($r){
                       //Insert
                       $p = new prestamo();
                       $p->fecha=$r->fecha;
                       $p->libro_id=$r->libro; 
                       $p->nombreCliente=$r->cliente;
                       if($p->save()){
                           //Modificar el numero de ejemplares
                           $p->libro->numEjemplares--;
                           $p->libro->save();
                       } 
                    });
                } catch (Exception $e) {
                    $error = true;
                    $mensaje = $e->getMessage();
                } finally {
                    if($error){
                        return back()->with('mensaje', $mensaje);
                    } else{
                        return redirect('verPrestamos');
                    }
                }
            }
        } else{
            return back()->with('mensaje', 'Error, el libro no existe o no hay ejemplares');
        }
    }
    
    function modificar($id){
        $p = prestamo::find($id);
        $libros = Libro::all();
        return view('modificarP', compact('p', 'libros'));
        
    }

    function actualizar(Request $r, $id){
        $r->validate([
            'fecha'=>'required',
            'libro'=>'required',
            'cliente'=>'required'
        ]);
        
        $p = prestamo::find($id);
        $libroAntiguo = Libro::find($p->libro_id);
        $fAntigua = $p->fechaDevolucion;

        //Chequear si se cambia el libro
        if($p->libro_id != $r->libro){
            $l = Libro::find($r->libro);
            if($l==null or $l->numEjemplares<=0){
                return back()->with('mensaje', 'Error, el libro no existe o no hay ejemplares');
            }
        }

        $p->fecha=$r->fecha;
        $p->libro_id=$r->libro; 
        $p->nombreCliente=$r->cliente;
        $p->fechaDevolucion=$r->fechaD;

            //Registrar prestamo y actualizar el numero de ejemplares
            try {
                $error = false;
                $mensaje = "";
                DB::transaction(function()use($p, $libroAntiguo, $fAntigua){
                    //Update
                   if($p->save()){
                       //Modificar el numero de ejemplares
                       if(empty($p->fechaDevolucion)){
                            if($libroAntiguo->id != $p->libro_id){
                                $libroAntiguo->numEjemplares++;
                                $libroAntiguo->save();
                                $p->libro->numEjemplares--;
                                $p->libro->save();
                            }  
                        } else{
                            if($fAntigua == null){
                                if($libroAntiguo->id != $p->libro_id){
                                    $libroAntiguo->numEjemplares++;
                                    $libroAntiguo->save();
                                } else{
                                    $p->libro->numEjemplares++;
                                    $p->libro->save();
                                }
                            }
                        }
                   } 
                    });
                } catch (Exception $e) {
                    $error = true;
                    $mensaje = $e->getMessage();
                } finally {
                    if($error){
                        return back()->with('mensaje', $mensaje);
                    } else{
                        return redirect()->route('rutaVer');
                    }
                }
            
    }

}
