<?php

   class Alumno{
    private $numEx;
    private $nombre;
    private $fechaN;

    function _construct(int $numEx, string $nombre, int $fechaN){

        $this->numEx=$numEx;
        $this->nombre=$nombre;
        $this->fechaN=$fechaN;


    }

    function mostrar(){
        echo 'Alumno: '.$this->numEx.' Fecha de nacimiento: '.date('d/m/Y',$this->fechaN).' Nombre: '.$this->nombre;
    }

    function _destruct(){

        
    }

   }

?>