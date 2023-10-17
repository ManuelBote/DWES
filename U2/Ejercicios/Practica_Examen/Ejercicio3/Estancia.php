<?php

    class Estancia{

        private String $dni;
        private String $nombre;
        private String $tipoH;
        private int $num;
        private String $estancia;
        private float $importe;
        private $pago1;
        private $pago2;
        private $opcion1;
        private $opcion2;
        private $opcion3;

        function __construct($dni, $nombre, $tipoH, $num, $estancia, $importe)
        {

            $this->dni=$dni;
            $this->nombre=$nombre;
            $this->tipoH=$tipoH;
            $this->num=$num;
            $this->estancia=$estancia;
            $this->importe=$importe;
            $this->pago1=false;
            $this->pago2=false;
            $this->opcion1=false;
            $this->opcion2=false;
            $this->opcion3=false;
            
        }

        function obtenerPago(){
            if($this->pago1==true){
                $pago = 'Efectivo';
            } elseif($this->pago2==true){
                $pago = 'Tarjeta';
            }
            return $pago;
        }

        function obtenerOpcion(){
            $array = [];

            if($this->opcion1==true){
                $array[] = 'Cuna';
            }
            if($this->opcion2==true){
                $array[] = 'Cama suplementaria';
            }
            if($this->opcion3==true){
                $array[] = 'Lavanderia';
            }

            if(isset($array)){
                $opciones = implode(',', $array);
            }

            if($this->opcion1==false && $this->opcion2==false && $this->opcion3==false){
                $opciones= 'No';
            }

            return $opciones;
        }

        /**
             * Get the value of dni
             */ 
            public function getDni()
            {
                        return $this->dni;
            }

            /**
             * Set the value of dni
             *
             * @return  self
             */ 
            public function setDni($dni)
            {
                        $this->dni = $dni;

                        return $this;
            }

        /**
             * Get the value of nombre
             */ 
            public function getNombre()
            {
                        return $this->nombre;
            }

            /**
             * Set the value of nombre
             *
             * @return  self
             */ 
            public function setNombre($nombre)
            {
                        $this->nombre = $nombre;

                        return $this;
            }

        /**
             * Get the value of tipoH
             */ 
            public function getTipoH()
            {
                        return $this->tipoH;
            }

            /**
             * Set the value of tipoH
             *
             * @return  self
             */ 
            public function setTipoH($tipoH)
            {
                        $this->tipoH = $tipoH;

                        return $this;
            }

        /**
             * Get the value of num
             */ 
            public function getNum()
            {
                        return $this->num;
            }

            /**
             * Set the value of num
             *
             * @return  self
             */ 
            public function setNum($num)
            {
                        $this->num = $num;

                        return $this;
            }

        /**
             * Get the value of estancia
             */ 
            public function getEstasncia()
            {
                        return $this->estancia;
            }

            /**
             * Set the value of estancia
             *
             * @return  self
             */ 
            public function setEstancia($estancia)
            {
                        $this->estancia = $estancia;

                        return $this;
            }

            /**
             * Get the value of importe
             */ 
            public function getImporte()
            {
                        return $this->importe;
            }

            /**
             * Set the value of importe
             *
             * @return  self
             */ 
            public function setImporte($importe)
            {
                        $this->importe = $importe;

                        return $this;
            }

        /**
             * Get the value of pago1
             */ 
            public function getPago1()
            {
                        return $this->pago1;
            }

            /**
             * Set the value of tipo
             *
             * @return  self
             */ 
            public function setPago1($pago1)
            {
                        $this->pago1 = $pago1;

                        return $this;
            }

      /**
             * Get the value of pago2
             */ 
            public function getPago2()
            {
                        return $this->pago2;
            }

            /**
             * Set the value of pago2
             *
             * @return  self
             */ 
            public function setPago2($pago2)
            {
                        $this->pago2 = $pago2;

                        return $this;
            }

        /**
             * Get the value of opcion1
             */ 
            public function getOpcion1()
            {
                        return $this->opcion1;
            }

            /**
             * Set the value of opcion1
             *
             * @return  self
             */ 
            public function setOpcion1($opcion1)
            {
                        $this->opcion1 = $opcion1;

                        return $this;
            }

             /**
             * Get the value of opcion2
             */ 
            public function getOpcion2()
            {
                        return $this->opcion2;
            }

            /**
             * Set the value of opcion2
             *
             * @return  self
             */ 
            public function setOpcion2($opcion2)
            {
                        $this->opcion2 = $opcion2;

                        return $this;
            }

             /**
             * Get the value of opcion3
             */ 
            public function getOpcion3()
            {
                        return $this->opcion3;
            }

            /**
             * Set the value of opcion3
             *
             * @return  self
             */ 
            public function setOpcion3($opcion3)
            {
                        $this->opcion3 = $opcion3;

                        return $this;
            }


    }
