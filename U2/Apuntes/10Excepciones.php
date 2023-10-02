<?php

    function dividir($a,$b){
        return $a/$b;
    }

    $num1=10;
    $num2=0;

    //echo 'Resultado: '.dividir($num1,$num2);

    try{
        echo 'Resultado: '.dividir($num1,$num2);
    }
    catch(Throwable $e){
        //Capturamos la excepcion con Throwable
        echo 'Error: '.$e->getMessage();
    }


    function dividir2($a,$b){
        //Comprueba que los tipos de datos son enteros
        // y si no lanza una excepcion
        if(!is_int($a) or !is_int($b)){
            throw new Exception('excepcion de tipos de datos incorrecto');
        }
        return $a/$b;
    }

    $num1=5.8;
    
    try{
        echo '<br>Resultado: '.dividir2($num1,$num2);
    }
    catch(Throwable $e){
        //Capturamos la excepcion con Throwable
        echo '<br>Resultado: '.$e->getMessage();
    }

    
    


?>