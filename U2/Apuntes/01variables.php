<?php

//Declaracion de variables de diferentes tipos

$nombre="Manuel";
$edad=19;
$estatura=1.76;
$esAlumno=true;

//Mostrar el valor de las variables

echo 'Nombre: ' .$nombre; //Con el . concatenamos
echo "<br>Edad: $edad"; //Dentro de " podemos usar las variables y se sustituyen por su valor
echo '<br>Estatura: ' .$estatura;
echo '<br>Es alumno: ' .$esAlumno;

echo '<br><br><table border ="1">';
    echo '<tr><th>Variables</th><th>Tipo</th></tr>';
    echo '<tr><td>Nombre</td><td>'.gettype($nombre).'</td></tr>';
    echo '<tr><td>Edad</td><td>'.gettype($edad).'</td></tr>';
    echo '<tr><td>Estatura</td><td>'.gettype($estatura).'</td></tr>';
    echo '<tr><td>Es alumno</td><td>'.gettype($esAlumno).'</td></tr>';
echo '</table>';

?>