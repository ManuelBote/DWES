<?php

   class Alumno{
    private int $numEx;
    private String $nombre;
    private int $fechaN;

    function __construct(int $numEx, string $nombre, int $fechaN){
        $this->numEx=$numEx;
        $this->nombre=$nombre;
        $this->fechaN=$fechaN;

    }

    function mostrar(){
        echo 'Alumno: '.$this->numEx.
        ' Fecha de nacimiento: '.date('d/m/Y',$this->fechaN).
        ' Nombre: '.$this->nombre;
    }

    function __destruct(){
        //echo 'El alumno: '.$this->nombre.' se ha dado de baja';   
    }


    /**
     * Get the value of numEx
     */ 
    public function getNumEx()
    {
        return $this->numEx;
    }

    /**
     * Set the value of numEx
     *
     * @return  self
     */ 
    public function setNumEx($numEx)
    {
        $this->numEx = $numEx;

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
     * Get the value of fechaN
     */ 
    public function getFechaN()
    {
        return $this->fechaN;
    }

    /**
     * Set the value of fechaN
     *
     * @return  self
     */ 
    public function setFechaN($fechaN)
    {
        $this->fechaN = $fechaN;

        return $this;
    }
   }

?>