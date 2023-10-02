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
            <label>Nº de alumnos: </label>
            <input type="number" name="numAlum"  
                value="<?php if(isset($_POST['numAlum'])) 
                                echo $_POST['numAlum'];
                            else echo '';?>">
        </div>

        <br>
        <input type="submit" value="Crear" name="crear">
        <br/>

        <?php

            if(isset($_POST['crear']) or isset($_POST['mostrar'])){

                for($i=1;$i<=$_POST['numAlum'];$i++){
                    echo '<div>';
                    echo '<label>Alumno '.$i.' </label>';
                    if(isset($_POST['nombres'][$i-1]))
                        $nombre= $_POST['nombres'][$i-1];
                    else
                        $nombre='';
                    echo '<input type="text" name="nombres[]" value="'.$nombre.'">';
                    echo '</div>';
                    echo '<br>';
                }
        ?>
        <input type="submit" name="mostrar" value="Mostrar">
        <br>

        <?php
            }
        ?>
    </form>

    <?php
        if(isset($_POST['mostrar'])){
    ?>
    <h2>Alumnos:</h2>
        <ul>
            <?php
                for($i=1;$i<=$_POST['numAlum'];$i++){
                    echo '<li>'.$_POST['nombres'][$i-1].'</li>';
                }
            ?> 
        </ul>
    <?php
        }
    ?>
    

</body>
</html>