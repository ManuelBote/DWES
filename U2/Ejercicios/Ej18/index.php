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
    <style>
        *{
            box-sizing: border-box;
        }
        form{
            border: 1px solid black;
            padding: 20px;
            width: 40%;
            margin-left: 30%;
            border-radius: 1rem;
        }
        table, th, tr, td{
            border: 1px solid black;
            border-collapse: collapse;
            padding: 10px;
            text-align: center;

        }
    </style>
</head>
<body style="text-align: center;">

    <h1>Formulario de viviendas</h1>
    
    <form action="" method="post" align="center">
        <div>
            <laber for="tipo">Selecciona el tipo de vivienda: </laber>
            <select name="tipoV">
                <option>Adosado</option>
                <option>Unifamiliar</option>
                <option>Piso</option>
            </select>
        </div>

        <div>
            <laber for="zona">Selecciona la zona: </laber>
            <select name="zona">
                <option>Centro</option>
                <option>Periferia</option>
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
            <textarea name="observaciones" rows="10" cols="40"
            value="<?php echo (isset($_POST['observaciones'])?$_POST['observaciones']:"") ?>"></textarea>
        </div>
        <br>
        <input type="submit" name="crear" value="Crear Vivienda">

    </form>

    <?php
        //Se pulsa el boton
        if(isset($_POST['crear'])){
            //Se conmpruba que todo esta rellenado
            if(empty($_POST['tipoV']) or empty($_POST['zona']) or empty($_POST['direccion']) or 
                empty($_POST['numH']) or empty($_POST['precio']) or empty($_POST['tamanio'])){
                echo '<h3 style="color:red">Debes rellenar todos los campos</h3>';
            } else{
                $vivienda= new Vivienda($_POST['tipoV'],
                                        $_POST['zona'],
                                        $_POST['direccion'],
                                        $_POST['numH'],
                                        $_POST['precio'],
                                        $_POST['tamanio'],);

                if(isset($_POST['extra'])){
                    $totalExtra=implode(',', $_POST['extra']);
                } else{
                    $totalExtra='';
                }
                
                $vivienda->setExtras($totalExtra);
                $vivienda->setObservaciones($_POST['observaciones']);
                

                if($model->crearVivienda($vivienda)){
                    echo '<h3 style="color:blue">Vivienda creada</h3>';
                } else{
                    echo '<h3 style="color:red">Vivienda no creada</h3>';
                }
            }
        }

        $viviendasTotal=$model->obtenerViviendas();

        if(file_exists('viviendas.txt')){

    ?>

        <br><br>
        <table align="center">
            <tr>
                <th>Tipo de vivienda</th>
                <th>Zona</th>
                <th>Direccion</th>
                <th>Nº de habitaciones</th>
                <th>Precio</th>
                <th>Tamaño</th>
                <th>Extras</th>
                <th>Observaciones</th>
            </tr>
            <?php
                foreach($viviendasTotal as $v){
                    //$v=new Vivienda();
                    echo '<tr>';
                        echo '<td>'.$v->getTipo().'</td>';
                        echo '<td>'.$v->getZona().'</td>';
                        echo '<td>'.$v->getDireccion().'</td>';
                        echo '<td>'.$v->getNumHabitacion().'</td>';
                        echo '<td>'.$v->getPrecio().'</td>';
                        echo '<td>'.$v->getTamanio().'</td>';
                        echo '<td>'.$v->getExtras().'</td>';
                        echo '<td>'.$v->getObservaciones().'</td>';
                    echo '<tr>';

                }
            ?>
        </table>

    <?php
        } else{
            echo '<h3 style="color:red">No hay ninguna vivienda creada</h3>';
        }
    ?>

    

</body>
</html>