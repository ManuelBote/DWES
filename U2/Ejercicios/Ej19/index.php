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
            if(isset($_POST['rellenar'])){
        ?>
        <hr>
        <div>
            <label for="color1">Color de Fondo</label>
            <input type="color" name="colorF">
        </div>
        <div>
            <label for="color2">Color de Texto</label>
            <input type="color" name="colorT">
        </div>
        <br>
        Rellenar Opciones
        <br>
        <?php
            for($i=0;$i<$_POST['numero'];$i++){
                echo '<br><input type="text" name="opciones[]" placeholder="Opcion: '.($i+1).'">';
            }
        }
        ?>

    </form>
   
</body>
</html>