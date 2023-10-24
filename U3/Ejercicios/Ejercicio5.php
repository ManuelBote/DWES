<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        //Iniciar sesion
        session_start();

        if(isset($_POST['cerrar'])){
            echo 'Cerrando sesion...';
            session_destroy();
            session_start();
        }
        //Comprobar si existen datos de acceso
        if(isset($_SESSION['datosAcceso'])){
            echo '<h2>Historial de acceso:</h2><ul>';
            $acceso = $_SESSION['datosAcceso'];
            //Mostrar acceso
            foreach($acceso as $a){
                echo '<li>'.$a.'</li>';
            }
            echo '<ul>';
        }else{
            //Primaer acceso
            echo '<p>Este es el primer acceso. Su SSID es: '.session_id().'</p>';
        }

        //Guardar array en la sesion en un array
        $acceso[]=date('d/m/Y h:i');
        //Guardar array en la sesion
        $_SESSION['datosAcceso']= $acceso;
    ?>
    <br>
    <form action="" method="post">
        <button type="submit" name="cerrar">Cerrar sesion</button>
    </form>
</body>
</html>