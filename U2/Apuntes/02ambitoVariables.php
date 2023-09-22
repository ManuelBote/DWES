<?php

//Declara variable $mascota como global
$mascota = 'Tobby';

//Declara funcion mostarMascota
function mostrarMascota(){

    //Definir variable $mascota como local a la funcion
    $mascota = 'Laia';
    echo 'El valor de la variable $mascota local es: '.$mascota;

    //Mostrar la variable global mascota
    global $mascota;
    echo '<br/> El valor de la variable $mascota global es: '.$mascota;

}

echo '<h2>VARIABLE LOCALES Y GLOBALES</h2>';

//Llamar a la funcion
mostrarMascota();


echo '<br><br/><h2>VARIABLES PREDEFINIDAS</h2>';
//Mostrar los 3 primero valores de $_SERVER
echo 'Nombre del servidor de $_SERVER: '.$_SERVER['SERVER_NAME'];
echo '</br>Puerto de escucha de $_SERVER: '.$_SERVER['SERVER_PORT'];
echo '</br>Software de $_SERVER: '.$_SERVER['SERVER_SOFTWARE'];

//Mostrar todo el array $_SERVER
//echo '<br/><hr/>Contenido de $_SERVER:<br/>';
//var_dump($_SERVER);
//echo '<hr/>';


//Variables estáticas
echo '<h2>VARIABLES ESTATICAS</h2>';

//Declara funcion que incremente dos contadores, uno estatico y otro no
function contadores(){
    $contador1 = 1;
    static $contador2 =1;

    //Incrementar contadores
    $contador1++;
    $contador2++;

    //Mostrar contadores
    echo 'El contenedor1 vale: '.$contador1.' y el contador2 vale: '.$contador2.'<br/>'; 
}

//Llamar a la funcion
contadores();
contadores();
contadores();


//Variables de variables
echo '<h2>VARIABLES DE VARIABLES</h2>';
$precio = 134.78;
$importe = 'precio';

echo 'El valor de precio es: '.$precio;
echo '<br/>El valor de mporte es: '.$importe.' y su tipo es '.gettype($importe);
echo '<br/>El valor del valor de $importe es: '.$$importe.' y su tipo es '.gettype($$importe);


//Variables constantes
echo '<h2>DEFINICION DE CONSTANTES DE USUARIO</h2>';
const PI = 3.14;
define ('IVA', 0.21);
echo 'Valor de PI: '.PI;
echo '<br/>Valor de IVA: '.IVA;

//Predefinidos
echo '<h2>CONSTANTES PREDEFINIDAS</h2>';
echo 'Version de PHP :'.PHP_VERSION;

?>