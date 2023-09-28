<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <form action="" method="post">

    <h1>RESERVA DE VUELO</h1>

        <div>
            <label>Nombre </label>
            <input type="text" name="nombre" 
            value="<?php if(isset($_POST['nombre']))
                        echo $_POST['nombre'];
                        else echo '';?>">
        </div>
        <br>
        <div>
            <label>Nº de acompañantes </label>
            <input type="number" name="num"
            value="<?php if(isset($_POST['num'])) 
                            echo $_POST['num'];
                        else echo '';?>">
        </div>
        <br>
        <button type="submit" value="rellenar" name="rellenar">Rellenar Datos acompañantes</button>
        <br><br>


        <?php 
            //Pintar el formulario de nombres de acompañantes si se a pulsado enviar
            if(isset($_POST['rellenar']) or isset($_POST['mostrar'])){

                echo '<h3>Datos de acompañantes</h3>';
                        for($i=1;$i<=$_POST['num'];$i++){
                            echo '<div>';
                            echo '<label>Nombre de acompañante '.$i.' </label>';
                            if (isset($_POST['nombres'][$i-1]))
                                $texto=$_POST['nombres'][$i-1];
                            else
                                $texto='';
                            echo '<input name="nombres[]" value="'.$texto.'">';
                            echo '</div>';
                            echo '<br>';
                        }
        ?>
                    <input type="submit" name="mostrar" value="Mostrar">
            
        <?php
            }
        ?>

    </form>

    <?php

        if(isset($_POST['mostrar'])){
    ?>
            <br>
            <table border="1">
                <tr>
                    <th>Persona que reserva</th>
                    <?php
                        for($i=1;$i<=$_POST['num'];$i++){
                                echo '<th>Acompañante '.$i.'</th>';
                        }
                    ?>
                </tr>

                <tr>
                    <td><?php echo $_POST['nombre']?></td>
                    <?php
                        for($i=1;$i<=$_POST['num'];$i++){
                            if(isset($_POST['nombres'][$i-1]))
                                echo '<td>'.$_POST['nombres'][$i-1].'</td>';
                            else 
                                echo '<td></td>';
                        }
                    ?>
                </tr>
            </table>

    <?php
        }

    ?>

</body>
</html>