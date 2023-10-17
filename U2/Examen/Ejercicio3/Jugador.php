<?php

    class Jugador{

        private int $numero;
        private String $nombre;
        private String $fecha;
        private String $categoria;
        private String $tipoC;
        private String $competencia;
        private String $equipamiento;
        private int $importe;

        function __construct($numero, $nombre, $fecha, $categoria, $tipoC, $competencia, $equipamiento, $importe)
        {
            $this->numero=$numero;
            $this->nombre=$nombre;
            $this->fecha=$fecha;
            $this->categoria=$categoria;
            $this->tipoC=$tipoC;
            $this->competencia=$competencia;
            $this->equipamiento=$equipamiento;
            $this->importe=$importe;
        }

        function obtenerCategoria(){
            switch($this->categoria){
                case '1':
                    return 'Benjamin';
                    break;
                case '2':
                    return 'Alevin';
                    break;
                case '3':
                    return 'Infantil';
                    break;
                case '4':
                    return 'Cadete';
                    break;
                case '5':
                    return 'Junior';
                    break;
                case '6':
                    return 'Senior';
                    break;
                
            }
        }

        function obtenerEquipamiento(){
            $array = explode(',', $this->equipamiento);
            $equipo = '';
            foreach($array as $e){
                switch($e){
                    case '1':
                        $equipo = $equipo.'Entrenamientos ';
                        break;
                    case '2':
                        $equipo = $equipo.'Partidos ';
                        break;
                    case '3':
                        $equipo = $equipo.'Chandal ';
                        break;
                    case '4':
                        $equipo = $equipo.' Bolso ';
                        break;
                }
            }
        }

        /**
         * Get the value of numero
         */ 
        public function getNumero()
        {
                return $this->numero;
        }

        /**
         * Set the value of numero
         *
         * @return  self
         */ 
        public function setNumero($numero)
        {
                $this->numero = $numero;

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
         * Get the value of fecha
         */ 
        public function getFecha()
        {
                return $this->fecha;
        }

        /**
         * Set the value of fecha
         *
         * @return  self
         */ 
        public function setFecha($fecha)
        {
                $this->fecha = $fecha;

                return $this;
        }

        /**
         * Get the value of categoria
         */ 
        public function getCategoria()
        {
                return $this->categoria;
        }

        /**
         * Set the value of categoria
         *
         * @return  self
         */ 
        public function setCategoria($categoria)
        {
                $this->categoria = $categoria;

                return $this;
        }

         /**
         * Get the value of tipoC
         */ 
        public function getTipoC()
        {
                return $this->tipoC;
        }

        /**
         * Set the value of tipoC
         *
         * @return  self
         */ 
        public function setTipoC($tipoC)
        {
                $this->tipoC = $tipoC;

                return $this;
        }
        
        /**
         * Get the value of competencia
         */ 
        public function getCompetencia()
        {
                return $this->competencia;
        }

        /**
         * Set the value of competencia
         *
         * @return  self
         */ 
        public function setCompetencia($competencia)
        {
                $this->competencia = $competencia;

                return $this;
        }

        /**
         * Get the value of equipamiento
         */ 
        public function getEquipamiento()
        {
                return $this->equipamiento;
        }

        /**
         * Set the value of equipamiento
         *
         * @return  self
         */ 
        public function setEquipamiento($equipamiento)
        {
                $this->equipamiento = $equipamiento;

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

       
    }

?>