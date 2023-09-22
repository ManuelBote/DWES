<?php

    //Definicion de array asociativo
    $persona = array('Nombre'=>'Ana','Edad'=>23,'Estatura'=>1.73);

    //Mostrar array
    echo '<h1>Array persona con funcion vardump</h1>';
    var_dump($persona);

    //Acceder al array como si fuera un array escalar
    echo '<h1>Acceder a la posicion 0 de un array asociativo</h1>';
    $persona[0];

    //Acceder por nombre a los elementos de un array como asociativo
    echo'<p>';
    echo 'Nombre: '.$persona['Nombre'].'<br/>Edad: '.$persona['Edad'].'</br>Estatura: '.$persona['Estatura'];
    echo '<p>';

     //Mostrasr el array con foreach mostrando los indices
     echo '<h1>Mostrar los datos con foreach mostrando los indices</h1>';
     foreach($persona as $indice=>$valor){
         echo $indice.' Valor: '.$valor.'<br/>';
     }

     //Crear un array vacio
     $mascota = array();

     //Asignar valores al array mascota
     $mascota['nombre'] = 'Tobby';
     $mascota['tipo'] = 'Perro';
     $mascota['nombrePropietario'] = 'Ana';

     echo '<h1>Mostrar mascotas con vardump</h1>';
     var_dump($mascota);

     //Mostrasr el array con foreach mostrando los indices
     echo '<h1>Array mascota con foreach mostrando los indices</h1>';
     foreach($mascota as $indice=>$valor){
         echo $indice.' Valor: '.$valor.'<br/>';
     }

     //Crear un nuevo elemento
     $mascota['edade']=5;
     echo '<h1>Mostrar mascotas con vardump</h1>';
     var_dump($mascota);

     //Mezclar array asociativo y escalar
     //crear un elementosin especicar la clase
     echo '<h1>Mostrar un array con modo escalar y asociativo</h1>';
     $mascota[]=1234;
     var_dump($mascota);



?>