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
                            $v->getTamanio().';');

                if(empty($v->getExtras())){
                    if(empty($v->getObservaciones())){
                        fwrite($f, PHP_EOL);
                    }else{

                    }
                }else{

                }

            } catch (\Throwable $th) {
                echo $th->getMessage();
            }
        }
    }

?>