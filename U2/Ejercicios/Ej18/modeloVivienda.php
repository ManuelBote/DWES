<?php

    require_once 'ClaseVivienda.php';

    class Modelo{
        private String $nomFichero = 'viviendas.txt';

        function __construct()
        {
            
        }

        function crearVivienda(Vivienda $v){
            try {
                //Abrir fichero con escritura
                $f=fopen($this->nomFichero,'a+');

                fwrite($f, $v->getTipo().';'.
                            $v->getZona().';'.
                            $v->getDireccion().';'.
                            $v->getNumHabitacion().';'.
                            $v->getPrecio().';'.
                            $v->getTamanio().';'.
                            $v->getExtras().';'.
                            $v->getObservaciones().PHP_EOL);

                $resultado = true;

            } catch (\Throwable $th) {
                echo $th->getMessage();
            }
            finally{
                if($f!=null){
                    fclose($f);
                }
            }

            return $resultado;
        }

        function obtenerViviendas(){
            $resultado = array();

            if(file_exists($this->nomFichero)){
                $fichero=file($this->nomFichero);
                foreach($fichero as $linea){
                    $datos=explode(';',$linea);
                    $vivien=new Vivienda($datos[0],$datos[1],$datos[2],$datos[3],$datos[4],$datos[5]);
                    $vivien->setExtras($datos[6]);
                    $vivien->setObservaciones($datos[7]);
                    $resultado[]=$vivien;
                }
            }
            return $resultado;
        }
    }

?>