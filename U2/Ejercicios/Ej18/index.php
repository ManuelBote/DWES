<?php

    require_once 'ClaseVivienda.php';
    require_once 'modeloVivienda.php';
    $model = new Modelo;

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
            <laber for="tipo">Selecciona el tipo de vivienda: </laber>
            <select name="tipoV">
                <option value="Adosado">Adosado</option>
                <option value="Unifamiliar">Unifamiliar</option>
                <option value="Piso">Piso</option>
            </select>
        </div>

        <div>
            <laber for="zona">Selecciona la zona: </laber>
            <select name="zona">
                <option value="Centro">Centro</option>
                <option value="Periferia">Periferia</option>
            </select>
        </div>
        <div>
            <label for="direccion">Introduzca la direccion: </label>
            <input type="text" name="direccion" 
            value="<?php echo (isset($_POST['direccion'])?$_POST['direccion']:"") ?>">
        </div>
        <div>
            <label for="numH">Selecciona nº de habitaciones: </label>
            <input type=radio name=numH value=1 checked="checke">1
            <input type=radio name=numH value=2>2
            <input type=radio name=numH value=3>3
        </div>
        <div>
            <label for="precio">Introduzca precio: </label>
            <input type="number" name="precio" 
            value="<?php echo (isset($_POST['precio'])?$_POST['precio']:"") ?>">
        </div>
        <div>
            <label for="tamanio">Introduzca tamaño: </label>
            <input type="number" name="tamanio" 
            value="<?php echo (isset($_POST['tamanio'])?$_POST['tamanio']:"") ?>">
        </div>
        <div>
            <label for="extra">Selecciona los extras que necesites: </label>
            <input type="checkbox" name="extra[]" value="Garaje">Garaje
            <input type="checkbox" name="extra[]" value="Trastero">Trastero
            <input type="checkbox" name="extra[]" value="Piscina">Piscina
        </div>
        <div>
            <label for="observaciones">Observaciones</label>
            <br>
            <textarea name="observaciones" rows="10" cols="20"
            value="<?php echo (isset($_POST['observaciones'])?$_POST['observaciones']:"") ?>"></textarea>
        </div>
        <br>
        <input type="submit" name="crear" value="Crear Vivienda">

    </form>

    <?php
        //Se pulsa el boton
        if(isset($_POST['crear'])){
            //Se conmpruba que todo esta rellenado
            if(empty($_POST['direccion']) or empty($_POST['precio']) or empty($_POST['tamanio'])){
                echo '<h3 style="color:red">Debes rellenar todos los campos</h3>';
            } else{
                $vivienda= new Vivienda($_POST['tipoV'],
                                        $_POST['zona'],
                                        $_POST['direccion'],
                                        $_POST['numH'],
                                        $_POST['precio'],
                                        $_POST['tamanio'],);

                if(!empty($_POST['extra'])){
                    $totalExtra;
                    foreach($_POST['extra'] as $extra){
                        $totalExtra=$extra.", ";
                    }
                    $vivienda->setExtras($totalExtra);
                }
                
                if(!empty($_POST['observaciones'])){
                    $vivienda->setObservaciones($_POST['observaciones']);
                }
                
            }
        }
    
    ?>

</body>
</html>