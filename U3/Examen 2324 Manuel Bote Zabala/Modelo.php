<?php

    require_once 'Producto.php';
    require_once 'ProductoEnCesta.php';
    require_once 'Tienda.php';

    class Modelo{
        private $conexion;
        private string $url = 'mysql:host=localhost;port=3306;dbname=mcdaw';
        private string $us = 'root';
        private string $ps = '';

        function __construct()
        {
            try {
                $this->conexion = new PDO($this->url, $this->us, $this->ps);
            } catch (PDOException $th) {
                echo $th->getMessage();
            }
        }


        /************************************************** Pedido ********************************************************/

        function obtenerDatosPedido($idP){
            $resultado = null;
            try {
                $consulta = $this->conexion->prepare('call datosPedido(?)');
                $params = array($idP);
                if($consulta->execute($params)){
                    if($fila = $consulta->fetch()){
                        $resultado = array($fila['codigo'], $fila['numProd'], $fila['total']);
                    }
                }
            } catch (PDOException $th) {
                echo $th->getMessage();
            }
            return $resultado;
        }

        function crearPedido($productos, $tienda){
            $resultado = null;
            try {
                $this->conexion->beginTransaction();
                $consulta = $this->conexion->prepare('INSERT into pedido values(default, curdate(), ?)');
                $params = array($tienda->getCodigo());
                if($consulta->execute($params)){
                    $idPedido = $this->conexion->lastInsertId();
                    $linea = 1;

                    foreach($productos as $p){
                        $consulta = $this->conexion->prepare('INSERT into detalle values(?,?,?,?,?)');
                        $params = array($linea, $idPedido, $p->getProducto()->getCodigo(),  
                        $p->getCantidad(), $p->getProducto()->getPrecio());
                        if($consulta->execute($params)){
                            if($consulta->rowCount()!=1){
                                $this->conexion->rollBack();
                            }
                            $linea++;
                        }
                    }
                
                $this->conexion->commit();
                $resultado = $idPedido;

                }
            } catch (PDOException $th) {
                $this->conexion->rollBack();
                echo $th->getMessage();
            }
            return $resultado;

        }


        /************************************************** Cesta ********************************************************/

        function agregarProductoCesta($producto, $cantidad){
            $resultado = null;
            try {
                $consulta=$this->conexion->prepare('SELECT * from producto where codigo = ?');
                $params = array($producto);
                if($consulta->execute($params)){
                    if($fila=$consulta->fetch());
                    $resultado = new ProductoEnCesta (new Producto($fila['codigo'], $fila['nombre'], $fila['precio']), $cantidad);               
                }
            } catch (PDOException $th) {
                echo $th->getMessage();
            }
            return $resultado;
        }

        function obtenerProductos(){
            $resultado = array();
            try {
                $consulta=$this->conexion->query('SELECT * from producto');
                if($consulta->execute()){
                    while($fila=$consulta->fetch()){
                        $resultado[] = new Producto($fila['codigo'], $fila['nombre'], $fila['precio']);
                    }
                }
            } catch (PDOException $th) {
                echo $th->getMessage();
            }
            return $resultado;
        }


        /************************************************** Tienda ********************************************************/

        function obtenerTiendas(){
            $resultado = array();
            try {
                $consulta=$this->conexion->query('SELECT * from tienda');
                if($consulta->execute()){
                    while($fila=$consulta->fetch()){
                        $resultado[] = new Tienda($fila['codigo'], $fila['nombre'], $fila['telefono']);
                    }
                }
            } catch (PDOException $th) {
                echo $th->getMessage();
            }
            return $resultado;
        }

        function obtenerTiendaId($id){
            $resultado = null;
            try {
                $consulta=$this->conexion->prepare('SELECT * from tienda where codigo = ?');
                $params = array($id);
                if($consulta->execute($params)){
                    if($fila=$consulta->fetch());
                    $resultado = new Tienda ($fila['codigo'], $fila['nombre'], $fila['telefono']);               
                }
            } catch (PDOException $th) {
                echo $th->getMessage();
            }

            return $resultado;
        }


        /************************************************** Getter and setter ********************************************************/

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