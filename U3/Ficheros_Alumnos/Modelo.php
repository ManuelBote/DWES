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

        function obtenerMensajesRecibidos($empleado){
            $resultado = array();
            try {
                $consulta = $this->conexion->prepare('SELECT * from para p inner join mensaje m using(idMen) 
                inner join empleado e on m.deEmpleado=e.idEmp
                inner join departamento d on m.paraDepartamento=d.idDep
                where p.paraEmpleado = ?');
                $params = array($empleado->getIdEmp());
                if($consulta->execute($params)){
                    while($fila = $consulta->fetch()){
                        $resultado[] = new Mensaje($fila['idMen'], 
                        new Empleado($fila['idEmp'], $fila['dni'], $fila['nombreEmp'], $fila['fechaNac'], $fila['departamento'], $fila['cambiarPs']), 
                        new Departamento($fila['idDep'], $fila['nombre']), 
                        $fila['asunto'], $fila['fechaEnvio'], $fila['mensaje']);
                    }
                }
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
            return $resultado;
            
        }

        function obtenerMensajes($empleado){
            $resultado = array();

            try {
                $consulta = $this->conexion->prepare('SELECT * from mensaje 
                inner join departamento on paraDepartamento=idDep where deEmpleado=? order by fechaEnvio desc');
                $params = array($empleado->getIdEmp());
                if($consulta->execute($params)){
                    while($fila = $consulta->fetch()){
                        $resultado[] = new Mensaje($fila['idMen'], $empleado, new Departamento($fila['idDep'], $fila['nombre']), 
                        $fila['asunto'], $fila['fechaEnvio'], $fila['mensaje']);
                    }
                }
            } catch (PDOException $e) {
                echo $e->getMessage();
            }

            return $resultado;
        }

        function obtenerEmpleadosDepartamento($idDep){
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

        function enviarMensaje(Mensaje $m, $destinatarios){
            $resultado = false;
            try {
                $this->conexion->beginTransaction();
                $consulta = $this->conexion->prepare('INSERT into mensaje values(default,?,?,?,curdate(),?)');
                $params = array($m->getDeEmpleado(), $m->getParaDepartamento(), $m->getAsunto(), $m->getMensaje());
                if($consulta->execute($params)){
                    //Recuperar el id del mensaje generado
                    $idMensaje = $this->conexion->lastInsertId();
                    //Hacer un insert en "para" para cada destinatario
                    foreach($destinatarios as $d){
                        $consulta = $this->conexion->prepare('INSERT into para values(?,?,false)');
                        $param = array($idMensaje,$d->getIdEmp());
                        if($consulta->execute($param)){
                            if($consulta->rowCount()!=1){
                                $this->conexion->rollBack();
                            }
                        } else{
                            $this->conexion->rollBack();
                        }
                    }
                }
                $this->conexion->commit();
                $resultado = true;
                $m->setIdMen($idMensaje);


            }  catch (PDOException $e) {
                echo $e->getMessage();
                $this->conexion->rollBack();
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