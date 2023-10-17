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

        function obtenerJugador(){
            $resultado = array();

            if(file_exists($this->nombreF)){
                $fichero=file($this->nombreF);
                foreach($fichero as $linea){
                    $datos=explode(';',$linea);
                    $jugador= new Jugador($datos[0], $datos[1], $datos[2], $datos[3], $datos[4], $datos[5], $datos[6], $datos[7]);
                    $resultado[] = $jugador;
                }
            }

            return $resultado;
        }
    }

?>