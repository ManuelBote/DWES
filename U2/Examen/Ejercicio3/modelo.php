<?php

    require_once 'Jugador.php';

    class Model{
        private String $nombreF = 'jugadores.txt';

        function __construct()
        {
            
        }

        function crearJugador(Jugador $j){

            try {
                $f = fopen($this->nombreF, 'a+');

                fwrite($f, $j->getNumero().';'.
                            $j->getNombre().';'.
                            $j->getFecha().';'.
                            $j->obtenerCategoria().';'.
                            $j->getTipoC().';'.
                            $j->getCompetencia().';'.
                            $j->getEquipamiento().';'.
                            $j->getImporte().PHP_EOL);

                $resultado = true;

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