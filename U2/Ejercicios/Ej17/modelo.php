<?php

    require_once 'claseCita.php';

    class Modelo {
        private String $nombreFichero="citas.txt";

        function __construct()
        {
            
        }


        function crearCita(Cita $c){

            try {
                //Abrir fichero para añadir
                $f=fopen($this->nombreFichero,"a+");
                //Añadir cita
                fwrite($f,$c ->getFecha().';'.
                            $c ->getHora().';'.
                            $c ->getNombre().';'.
                            $c ->getTipoServicio().PHP_EOL);
                $resultado=true;
            } catch (\Throwable $th) {
                echo $th->getMessage();
            }
            finally{
                //Cerrar fichero
                if($f!=null){
                    fclose($f);
                }
            }
            return $resultado;
        }

        function obtenerCitas(){
            $resultado = array();

            if(file_exists($this->nombreFichero)){
                $datos=file($this->nombreFichero);
                //Convertimos cada linea del fichero en un objeto Cita
                foreach($datos as $linea){
                    $campos=explode(';',$linea);
                    $cita = new Cita($campos[0],$campos[1],$campos[2],$campos[3]);
                    $resultado[]=$cita;
                }
            }

            return $resultado;
        }


    }

?>