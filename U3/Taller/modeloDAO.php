<?php

    require_once 'Pieza/pieza.php';

    class Modelo{
        private $conexion;
        const URL='mysql:host=127.0.0.1;port=3307;dbname=taller';
        const USUARIO='root';
        const PS='root';
        

        function __construct()
        {
            try {
                //Establecer conexion con la base de datos
                $this->conexion = new PDO(Modelo::URL, Modelo::USUARIO, Modelo::PS);
            } catch (PDOException $th) {
                echo $th->getMessage();
            }

        }

        function insertarPieza(Pieza $p){
            $resultado = false;
            
            try {
                $consulta = $this->conexion->prepare('insert into pieza values (?,?,?,?,?)');
                $parms = array($p->getCodigo(), $p->getClase(), $p->getDescripcion(), $p->getPrecio(), $p->getStock());
                if($consulta->execute($parms)){
                    $resultado=true;
                }
            } catch (PDOException $th) {
                echo $th->getMessage();
            }

            return $resultado;
        }

        function obtenerPieza($codigo){
            $resultado = null;

            try {
                $consulta = $this->conexion->prepare('select * from pieza where codigo = ?');
                $parms = array($codigo);
                if($consulta->execute($parms)){
                    //recuperar el registro y crear un objeto pieza en resultado
                    if($fila=$consulta->fetch()){
                        $resultado = new Pieza();
                        $resultado->setCodigo($fila['codigo']);
                        $resultado->setClase($fila['clase']);
                        $resultado->setDescripcion($fila['descripcion']);
                        $resultado->setPrecio($fila['precio']);
                        $resultado->setStock($fila['stock']);
                    }
                }
            } catch (PDOException $th) {
                echo $th->getMessage();
            }

            return $resultado;
        }

        function obtenerPiezas(){
            //Devuelve un array de piezas
            $resultado = array();

            try {
                //Ejecutamos consulta
                $datos = $this->conexion->query('select * from pieza');  
                if($datos != false){
                    //Recorrer los datos para crear onjetos pieza
                    while ($fila = $datos->fetch()){
                        $p= new Pieza();
                        $p->setCodigo($fila['codigo']);
                        $p->setClase($fila['clase']);
                        $p->setDescripcion($fila['descripcion']);
                        $p->setPrecio($fila['precio']);
                        $p->setStock($fila['stock']);

                        $resultado[] = $p;
                    }
                }
            } catch (PDOException $th) {
                echo $th->getMessage();
            }

            return $resultado;
        }

        function existenReparaciones(string $codigo){
            $resultado = false;

            try {
                $consulta = $this->conexion->prepare('select * from piezareparacion where pieza= ?');
                $parametro = array($codigo);
                if($consulta->execute($parametro)){
                    if($consulta->fetch()){
                        $resultado = true;
                    }
                }
            } catch (PDOException $th) {
                echo $th->getMessage();
            }

            return $resultado;
        }

        function borrarPieza(string $codigo){
            $resultado = false;

            try {
                $consulta = $this->conexion->prepare('delete from pieza where codigo= ?');
                $parametro = array($codigo);
                if($consulta->execute($parametro)){
                    //Comprobar si se a borrado al menos un registro
                    //En ese caso devuelve true
                    if($consulta->rowCount() == 1){
                        $resultado = true;
                    }
                }
            } catch (PDOException $th) {
                echo $th->getMessage();
            }

            return $resultado;
        }

        


        /**
         * Get the value of conexion
         */ 
        public function getConexion()
        {
                return $this->conexion;
        }

        /**
         * Set the value of conexion
         *
         * @return  self
         */ 
        public function setConexion($conexion)
        {
                $this->conexion = $conexion;

                return $this;
        }
    }

?>