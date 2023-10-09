<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <label for="numopc">Numero de opciones</label>
        <input type="number" id="num" name="numero" 
        value="<?php echo (isset($_POST['numero'])?$_POST['numero']:1)?>" required="requiere">
        <br>
        <input type="submit" name="rellenar" value="Rellenar Opciones">

        <?php
            if(isset($_POST['rellenar']) or isset($_POST['mostrar'])){
        ?>
        <hr>
        <div>
            <label for="color1">Color de Fondo</label>
            <input type="color" name="colorF" 
            value="<?php echo (isset($_POST['colorF'])?$_POST['colorF']:"")?>">
        </div>
        <div>
            <label for="color2">Color de Texto</label>
            <input type="color" name="colorT"
            value="<?php echo (isset($_POST['colorT'])?$_POST['colorT']:"")?>">
        </div>
        <br>
        Rellenar Opciones
        <br>
        <?php
            for($i=0;$i<$_POST['numero'];$i++){
                echo '<br><input type="text" name="opciones[]" placeholder="Opcion: '.($i+1).'"
                value="'.(isset($_POST['opciones'][$i])?$_POST['opciones'][$i]:"").'">';
            }
        }
        ?>
        <br><br>
        <input type="submit" name="mostrar" value="Mostrar Menu">

    </form>
    <hr>

    <!-- MENU-->
    <?php

        if(isset($_POST['mostrar'])){
            if(isset($_POST['opciones'])){
                foreach($_POST['opciones'] as $opcion){
                    echo '<span style="background-color:'.$_POST['colorF'].'; 
                    color:'.$_POST['colorT'].'; margin:5px; padding:5px">'.$opcion.'</span>';
                }
            }
        }

    ?>
   
</body>
</html>