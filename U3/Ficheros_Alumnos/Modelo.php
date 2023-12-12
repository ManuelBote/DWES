<?php

    require_once 'Empleado.php';
    require_once 'Departamento.php';
    require_once 'Mensaje.php';

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

        function obtenerEmpleadoDepartamento($idDep){
            $resultado= array();
            try {
                $consulta = $this->conexion->prepare('SELECT * from empleado where departamento = ?');
                $param = array($idDep);
                if($consulta->execute($param)){
                    while($fila=$consulta->fetch()){
                        $resultado[] = new Empleado($fila['idEmp'], $fila['dni'], $fila['nombreEmp'], 
                        $fila['fechaNac'],$fila['departamento'], $fila['cambiarPs']);
                    }
                }
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
            return $resultado;
        }

        function enviarMensaje($m, $destinatarios){
            $resultado = false;
            try {
                $this->conexion->beginTransaction();
                $consulta = $this->conexion->prepare('INSERT into mensaje values(default,?,?,?,?,?)');
                $params = array($m->getDeEmpleado(), $m->getParaDepartamento(), $m->getAsunto(), $m->getMensaje());
                if($consulta->execute($params)){
                    foreach($destinatarios as $d){
                        $consulta = $this->conexion->prepare('INSERT into para values(?,?,false)');
                        $params = array(,$d->getIdEmp())
                    }
                }

            }  catch (PDOException $e) {
                echo $e->getMessage();
            }
            return $resultado;
        }

        function obtenerDepartamentos(){
            $resultado = array();
            try {
                $consulta = $this->conexion->query('SELECT * from departamento');
                if($consulta->execute()){
                    while($fila=$consulta->fetch()){
                        $resultado[] = new Departamento($fila['idDep'], $fila['nombre']);
                    }
                }
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
            return $resultado;
        }

        //-------------------------------------------LOGIN--------------------------------------------------------------------------//
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
                $consulta=$this->conexion->prepare('SELECT * from empleado e 
                inner join departamento d on e.departamento=d.idDep where idEmp = ?');
                $params = array($us);
                if($consulta->execute($params)){
                    if($fila=$consulta->fetch());
                    $resultado = new Empleado ($fila['idEmp'], $fila['dni'], $fila['nombreEmp'], 
                    $fila['fechaNac'], new Departamento($fila['idDep'], $fila['nombre']), $fila['cambiarPs']);               
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