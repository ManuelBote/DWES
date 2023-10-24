<?php
echo '<h2>NO SE HA INICIADO LA SESION</h2>';
//Mostrar el id y el nombre de la seion sin haver iniciado la sesion
echo '<h3>Sesion: '.session_id().'</h3>';
echo '<h3>Nombre: '.session_name().'</h3>';

if(isset($_SESSION['usuario'])){
    echo 'Existe variable en sesion';
} else{
    echo 'No existe variable usuario en sesion';
}

//Iniciamos sesion
session_start();
echo '<h2>SE HA INICIADO LA SESION</h2>';

//Mostrar el id y el nombre de la seion sin haver iniciado la sesion
echo '<h3>Sesion: '.session_id().'</h3>';
echo '<h3>Nombre: '.session_name().'</h3>';
echo '<h3>Valor de $_COOKIE["nombreSesion"]: '.$_COOKIE[session_name()].'</h3>';

if(isset($_SESSION['usuario'])){
    echo 'Existe variable en sesion con valor:'.$_SESSION['usuario'].PHP_EOL;
} else{
    echo 'No existe variable usuario en sesion'.PHP_EOL;
}

//Guardar variable usuario en la sesion
$_SESSION['usuario']='Manuel';

if(isset($_SESSION['usuario'])){
    echo 'Existe variable en sesion con valor:'.$_SESSION['usuario'];
} else{
    echo 'No existe variable usuario en sesion';
}

//Destruir sesion
echo '<h3>Destruir sesion pero no las variables</h3>';
session_destroy();
if(isset($_SESSION['usuario'])){
    echo 'Existe variable en sesion con valor:'.$_SESSION['usuario'];
} else{
    echo 'No existe variable usuario en sesion';
}
?>