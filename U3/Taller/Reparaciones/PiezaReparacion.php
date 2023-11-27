<?php

require_once "Reparacion.php";
require_once "../Pieza/pieza.php";

    class PiezaReparacion{
        private Reparacion $r;
        private Pieza $p;
        private int $cantidad;
        private float $precio;

        function __construct($r, $p, $cantidad, $precio)
        {
            $this->r=$r;
            $this->p=$p;
            $this->cantidad=$cantidad;
            $this->precio=$precio;
        }

        /**
         * Get the value of r
         */ 
        public function getR()
        {
                return $this->r;
        }

        /**
         * Set the value of r
         *
         * @return  self
         */ 
        public function setR($r)
        {
                $this->r = $r;

                return $this;
        }

        /**
         * Get the value of p
         */ 
        public function getP()
        {
                return $this->p;
        }

        /**
         * Set the value of p
         *
         * @return  self
         */ 
        public function setP($p)
        {
                $this->p = $p;

                return $this;
        }

        /**
         * Get the value of cantidad
         */ 
        public function getCantidad()
        {
                return $this->cantidad;
        }

        /**
         * Set the value of cantidad
         *
         * @return  self
         */ 
        public function setCantidad($cantidad)
        {
                $this->cantidad = $cantidad;

                return $this;
        }

        /**
         * Get the value of precio
         */ 
        public function getPrecio()
        {
                return $this->precio;
        }

        /**
         * Set the value of precio
         *
         * @return  self
         */ 
        public function setPrecio($precio)
        {
                $this->precio = $precio;

                return $this;
        }
    }

?>