<?php

    require_once 'Empleado.php';

    class Modelo{
        private $conexion;
        private string $url = 'mysql:host=localhost;port=3306;dbname=mensajes';
        private string $us = 'root';
        private string $ps = '';

      

        function __construct()
        {
            try {
                $this->conexion = new PDO($this->url, $this->us, $this->ps);
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

        function login(string $us, string $ps){
            try {
                $consulta=$this->conexion->prepare('SELECT login(?,?)');
                $params = array($us, $ps);
                if($consulta->execute($params)){
                    if($fila=$consulta->fetch());
                    return $fila[0];               }
            } catch (PDOException $e) {
                echo $e->getMessage();
            }

            return 0;
        }

        function obtenerEmpleado(string $us){
            $resultado = null;
            try {
                $consulta=$this->conexion->prepare('SELECT * from empleado where idEmp = ?');
                $params = array($us);
                if($consulta->execute($params)){
                    if($fila=$consulta->fetch());
                    $resultado = new Empleado ($fila['idEmp'], $fila['dni'], $fila['nombreEmp'], $fila['fechaNac'], $fila['departamento'], $fila['cambiarPs']);               
                }
            } catch (PDOException $e) {
                echo $e->getMessage();
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