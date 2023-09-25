<h1>FUNCIÓN CON VARIABLES GLOBALES</h1>

<?php

    function precio_conIva1(){
        global $precio;
        return $precio*1.21;
    }

    $precio=10;
    $precio_iva=precio_conIva1();
    echo 'El precio con iva es: '.$precio_iva;

?>

<h1>FUNCIONES CON PARÁMETROS POR VALOR</h1>

<?php

    function precio_conIva2($importe){
        $importe = $importe*1.21;
        echo '<p>Valor de importe dentro de la funcion: '.$importe.'</p>';
    }

    $imp1=10;
    precio_conIva2($imp1);
    echo '<p>Valor de importe fuera de la funcion: '.$imp1.'</p>';

?>

<h1>FUNCIONES CON PARÁMETROS POR REFERENCIA</h1>

<?php

    function precio_conIva3(&$importe){
        $importe = $importe*1.21;
        echo '<p>Valor de importe dentro de la funcion: '.$importe.'</p>';
    }

    $imp2=10;
    precio_conIva3($imp2);
    echo '<p>Valor de importe fuera de la funcion: '.$imp1.'</p>';

?>

