<?php
    session_start();
    if(isset($_POST['tirar'])){
        if(empty($_POST['nombre'])){
            $mensaje= '<spam style="color:red;">**Debes rellenar el campo nombre jugador</spam>';
        } else{
            //Recuperar datos si existen
            if(isset($_SESSION['jugadores'])){
                $jugadores = $_SESSION['jugadores'];                
            }
            //Generar numero
            $numero = rand(1,6);
            //Guardar datos array
            $jugadores[$_POST['nombre']]=$numero;
            //Guardar en la sesion
            $_SESSION['jugadores']=$jugadores;
        }
    }else if(isset($_POST['borrar'])){
        session_unset();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <div>
            <label>Nombre del jugador</label>
            <input name="nombre" placeholder="Nombre del jugador">
            <?php
                if(isset($mensaje)){
                    echo $mensaje;
                }
                
            ?>
        </div>
        <br>
        <div>
            <input type="submit" name="tirar" value="Tirar dado">
        </div>
        <br>
        <?php
            //Mostrar tirada
            if(isset($_SESSION['jugadores'])){
                foreach($_SESSION['jugadores'] as $clave=>$valor){
                    echo '<li>'.$clave.' => '.$valor.'</li>';
                }
            }
           
        ?>
        <br>
        <div>
            <input type="submit" name="borrar" value="Borrar Jugadores">
        </div>
    </form>
</body>
</html>