<?php

    //Comprobamos si hay que guardar o borrar la cookie
    if(isset($_POST['guardar'])){
        setcookie('colorF', $_POST['colorF'], time()+(24*60*60));
        setcookie('colorT', $_POST['colorT'], time()+(24*60*60));
        header('location:Ejercicio2.php');
    }

    if(isset($_POST['borrar'])){
        setcookie('colorF', '', time()-1);
        setcookie('colorT', '', time()-1);
        header('location:Ejercicio2.php');
    }

    $colorF='#FFFFFF';
    $colorT='#000000';
    //Ver si estan definidos los colores en la cadena
    if(isset($_COOKIE['colorF'])){
        $colorF = $_COOKIE['colorF'];
    }

    if(isset($_COOKIE['colorT'])){
        $colorT = $_COOKIE['colorT'];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body{
            background-color: <?php echo $colorF ?>;
            color: <?php echo $colorT ?>;
        }
    </style>
</head>
<body>
    <form action="" method="post">
        <div>
            <label>Color de fondo</label>
            <input type="color" name='colorF' value="<?php echo $colorF; ?>">
        </div>
        <br>
        <div>
            <label>Color de texto</label>
            <input type="color" name='colorT' value="<?php echo $colorT; ?>">
        </div>
        <br>
        <div>
            <input type="submit" name="guardar" value="Guardar preferencia">
            <input type="submit" name="borrar" value="Borrar">
        </div>
    </form>
</body>
</html>