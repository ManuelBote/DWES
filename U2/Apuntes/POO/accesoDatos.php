<?php

    include_once "Alumno.php";
    $nombreFichero="alumnos.txt";

    function crearAlumno(Alumno $a){
        $fichero = null;
        try {
            global $nombreFichero;
            //Abrir fichero para añadir info
            //Si no existe se crea uno
            $fichero=fopen($nombreFichero, "a+");
            //Escribir los datos en el fichero
            fwrite($fichero,$a->getNumEx().';'.$a->getNombre().';'.$a->getFechaN().PHP_EOL);
            return true;

        } catch (\Throwable $th) {
            return false;
            
        } finally{
            //Crear fichero si se ha abierto
            if($fichero!=null){
                fclose($fichero);
            }
        }
    }

    function obtenerAlumno(int $numEx){
        global $nombreFichero;
        $resultado = null;

        try {
            if(file_exists($nombreFichero)){
                //Cargar fichero en array
                $contenido=file($nombreFichero);
                if(is_array($contenido)){
                    //Buscar el numEx en el array
                    foreach($contenido as $linea){
                        $datos=explode(';',$linea);
                        //Comparar el numEx del fichero() con el numEx buscando
                        if((int)$datos[0]==$numEx){
                            //Si se encuentra, crear $resultado como un alumno
                            $resultado=new Alumno((int)$datos[0],(String)$datos[1],(int)$datos[2]);
                            return $resultado;
                        }
                    }
                }
            }
            
            
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }

        return $resultado;
    }

    function obtenerAlumnos(){
        $resultado=array();
        global $nombreFichero;

        try{
            //Comprobar si el fichero existe
            if(file_exists($nombreFichero)){
                $contenido=file($nombreFichero);
                foreach($contenido as $linea){
                    //Dividir la linea
                    $campos=explode(";", $linea);
                    //Creamos objeto de alumno
                    $a = new Alumno($campos[0],$campos[1],$campos[2]);
                    //Añadimos el alumno al array de resultado
                    $resultado[]=$a;

                }
            }


        }catch(\Throwable $th){
            echo $th->getMessage();
        }

        return $resultado;
    }


?>