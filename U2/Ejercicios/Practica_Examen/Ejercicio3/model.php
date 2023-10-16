<?php

    require_once 'Estancia.php';

    class ModeloEstancia{

        private String $nomFicheroEstancia = "estancias.txt";

        function __construct()
        {
            
        }

        function crearEstancia(Estancia $e){

            try {
                $f=fopen($this->nomFicheroEstancia,"a+");
                
                fwrite($f, $e->getDni().';'.
                            $e->getNombre().';'.
                            $e->getTipoH().';'.
                            $e->getNum().';'.
                            $e->getEstasncia().';'.
                            $e->getImporte().';'.
                            $e->obtenerPago().';'.
                            $e->obtenerOpcion(). PHP_EOL);

                $resultado=true;

            } catch (\Throwable $th) {
                echo $th->getMessage();
            } finally{
                if($f!=null){
                    fclose($f);
                }
            }

            return $resultado;

        }

    }

?>