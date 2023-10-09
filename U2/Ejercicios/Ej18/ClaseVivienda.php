<?php

    class Vivienda{

        private String $tipo;
        private String $zona;
        private String $direccion;
        private int $numHabitacion;
        private float $precio;
        private int $tamanio;
        private String $extras;
        private String $observaciones;

        public function __construct($tipo, $zona, $direccion, $numHabitacion, $precio, $tamanio)
        {

            $this->tipo=$tipo;
            $this->zona=$zona;
            $this->direccion=$direccion;
            $this->numHabitacion=$numHabitacion;
            $this->precio=$precio;
            $this->tamanio=$tamanio;
            
        }


            /**
             * Get the value of tipo
             */ 
            public function getTipo()
            {
                        return $this->tipo;
            }

            /**
             * Set the value of tipo
             *
             * @return  self
             */ 
            public function setTipo($tipo)
            {
                        $this->tipo = $tipo;

                        return $this;
            }

        /**
         * Get the value of zona
         */ 
        public function getZona()
        {
                return $this->zona;
        }

        /**
         * Set the value of zona
         *
         * @return  self
         */ 
        public function setZona($zona)
        {
                $this->zona = $zona;

                return $this;
        }

        /**
         * Get the value of direccion
         */ 
        public function getDireccion()
        {
                return $this->direccion;
        }

        /**
         * Set the value of direccion
         *
         * @return  self
         */ 
        public function setDireccion($direccion)
        {
                $this->direccion = $direccion;

                return $this;
        }

        /**
         * Get the value of numHabitacion
         */ 
        public function getNumHabitacion()
        {
                return $this->numHabitacion;
        }

        /**
         * Set the value of numHabitacion
         *
         * @return  self
         */ 
        public function setNumHabitacion($numHabitacion)
        {
                $this->numHabitacion = $numHabitacion;

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
        
        /**
         * Get the value of tamanio
         */ 
        public function getTamanio()
        {
                return $this->tamanio;
        }

        /**
         * Set the value of tamanio
         *
         * @return  self
         */ 
        public function setTamanio($tamanio)
        {
                $this->tamanio = $tamanio;

                return $this;
        }

        /**
         * Get the value of extras
         */ 
        public function getExtras()
        {
                return $this->extras;
        }

        /**
         * Set the value of extras
         *
         * @return  self
         */ 
        public function setExtras($extras)
        {
                $this->extras = $extras;

                return $this;
        }


        /**
         * Get the value of observaciones
         */ 
        public function getObservaciones()
        {
                return $this->observaciones;
        }

        /**
         * Set the value of observaciones
         *
         * @return  self
         */ 
        public function setObservaciones($observaciones)
        {
                $this->observaciones = $observaciones;

                return $this;
        }
    }

?>