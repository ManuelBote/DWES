<?php

    //Definicion de array escalar
    $persona = array("Ana",23,1.73);

    //Mostrar array
    echo '<h1>Array persona con funcion var_dump</h1>';
    var_dump($persona);

    //Acceder por posicion a los elementos del array
    echo'<p>';
    echo 'Elementos de persona:'.$persona[0].', '.$persona[1].', '.$persona[2];
    echo '</p>';

    //Mostrar el array con foreach
    echo '<h1>Array persona con foreach</h1>';
    foreach($persona as $valor){
        echo $valor.' ';
    }

     //Mostrar el array con foreach mostrando los indices
     echo '<h1>Array persona con foreach mostrando los indices</h1>';
     foreach($persona as $indice=>$valor){
         echo 'Indice: '.$indice.' Valor: '.$valor.'<br/>';
     }

     //Crear un array vacio
     $mascota = array();

     //Asignar valores al array mascota
     $mascota[10] = 'Tobby';
     $mascota[100] = 'Perro';
     $mascota[200] = 'Ana';

     echo '<h1>Mostrar mascotas con vardump</h1>';
     var_dump($mascota);

     //Mostrasr el array con foreach mostrando los indices
     echo '<h1>Array mascota con foreach mostrando los indices</h1>';
     foreach($mascota as $indice=>$valor){
         echo 'Indice: '.$indice.' Valor: '.$valor.'<br/>';
     }

     //Crear un nuevo elemento en array mascotas, sin especificar el indice
     $mascota[]=5;
     echo '<h1>Mostrar mascotas con vardump</h1>';
     var_dump($mascota);

     //Acceder a un elemento cuyo indice no existe
     echo '<h1>Mostrar mascota[0]</h1>';
     echo $mascora[0];

?>