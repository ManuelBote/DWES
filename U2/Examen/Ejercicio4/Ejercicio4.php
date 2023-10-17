<?php

    require_once 'Jugador.php';
    require_once 'modelo.php';
    $modelo = new Model;

    function rellenarCategoria($item){
        if(isset($_POST['categoria'])){
            if($_POST['categoria']==$item){
                echo 'selected = "selected"';
            }
        }
    }

    function rellenarRadio($item, $opcionPorDefecto){
        if(isset($_POST['tipoC'])){
            if($_POST['tipoC']==$item){
                echo 'checked = "checked"';
            }
        }
        elseif($opcionPorDefecto){
            echo 'checked = "checked"';
        }
    }

    function rellenarCompeticion($item){
        if(isset($_POST['competiciones'])){
            foreach($_POST['competiciones'] as $o){
                if($o == $item){
                    echo 'selected="selected"';
                }
            }
        }
    }

    function rellenarCheckbox($item, $opcionPorDefecto){
        if(isset($_POST['equipamiento'])){
            foreach($_POST['equipamiento'] as $o){
                if($o == $item){
                    echo 'checked="checked"';
                }
            }
        } elseif($opcionPorDefecto){
            echo 'checked = "checked"';
        }
        
    }

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
            width: 50%;
            margin-left: 25%;
            border-radius: 1rem;
        }
        table, th, tr, td{
            border: 1px solid black;
            border-collapse: collapse;
            padding: 10px;
            text-align: center;
        }
        h3{
            text-align: center;
        }
    </style>
</head>
<body>
    <form action="" method="post" aling="center">
        <div>
            <label>Nº de Jugador</label><br>
            <input type="number" name="numJugador" placeholder="Nº de jugador"
            value="<?php echo (isset($_POST['numJugador'])?$_POST['numJugador']:''); ?>">
        </div>
        <br>
        <div>
            <label>Nombre y Apellidos</label><br>
            <input type="text" name="nombre" placeholder="Nombre y apellidos"
            value="<?php echo (isset($_POST['nombre'])?$_POST['nombre']:''); ?>">
        </div>
        <br>
        <div>
            <label>Fecha de Nacimiento</label><br>
            <input type="date" name="fecha"
            value="<?php echo (isset($_POST['fecha'])?$_POST['fecha']:''); ?>">
        </div>
        <br>
        <div>
            <label>Selecciona Categoria</label><br>
            <select name="categoria">
                <option <?php rellenarCategoria('1');?> value="1">Benjamin</option>
                <option <?php rellenarCategoria('2');?> value="2">Alevin</option>
                <option <?php rellenarCategoria('3');?> value="3">Infantil</option>
                <option <?php rellenarCategoria('4');?> value="4">Cadete</option>
                <option <?php rellenarCategoria('5');?> value="5">Junior</option>
                <option <?php rellenarCategoria('6');?> value="6">Senior</option>
            </select>
        </div>
        <br>
        <div>
            <label>Tipo de Categotia</label><br>
            <input type="radio" name="tipoC" value="Masculina" <?php rellenarRadio('Masculina', true);?>>Masculina
            <input type="radio" name="tipoC" value="Femenina" <?php rellenarRadio('Femenina', false);?>>Femenina
            <input type="radio" name="tipoC" value="Mixta" <?php rellenarRadio('Mixta', false);?>>Mixta
        </div>
        <br>
        <div>
            <label>Selecciona la/las competiciones</label><br>
            <select name="competiciones[]" multiple="multiple">
                <option value="Primera" <?php rellenarCompeticion('Primera');?>>Primera</option>
                <option value="Segunda A" <?php rellenarCompeticion('Segunda A');?>>Segunda A</option>
                <option value="Segunda B" <?php rellenarCompeticion('Segunda B');?>>Segunda B</option>
                <option value="Tercera" <?php rellenarCompeticion('Tercera');?>>Tercera</option>
            </select>
        </div>
        <br>
        <div>
            <label>Equipamiento y Extras</label><br>
            <input type="checkbox" name="equipamiento[]" value="1" <?php rellenarCheckbox('1', true);?>>Entrenamiento(25,00€)
            <input type="checkbox" name="equipamiento[]" value="2" <?php rellenarCheckbox('2', false);?>>Partidos(25,00€)
            <input type="checkbox" name="equipamiento[]" value="3" <?php rellenarCheckbox('3', false);?>>Chandal(40,00€)
            <input type="checkbox" name="equipamiento[]" value="4" <?php rellenarCheckbox('4', false);?>>Bolso(15,00€)
        </div>
        <br>
        <div>
            <input type="submit" name="enviar" value="Enviar">
            <input type="reset" name="limpiar" value="Limpiar">
            <input type="submit" name="ver" value="Ver Jugadores">
        </div>
    </form>

    <?php

        if(isset($_POST['enviar'])){
            if(empty($_POST['numJugador']) or empty($_POST['nombre']) or empty($_POST['fecha']) or empty($_POST['categoria'])
             or empty($_POST['tipoC']) or empty($_POST['competiciones']) or empty($_POST['equipamiento'])){
                echo '<h3 style="color:red;">Error: Debes rellenar todos los campos</h3>';
             } else{
                if($_POST['categoria']== '1' or $_POST['categoria']== '2' and $_POST['tipoC']!='Mixta'){
                    echo '<h3 style="color:red;">Error: Esa categoria solo es accesible con categoria Mixta</h3>';
                } else{
                    $comprobar = false;
                    foreach($_POST['equipamiento'] as $i){
                        if($i=='1' or $i=='2'){
                            $comprobar=true;
                        }
                    }

                    if($comprobar==false){
                        echo '<h3 style="color:red;">Error: Debes seleccionar al menos Entrenamientos o Partidos</h3>';
                    }else{

                        $importe = 0;
                        foreach($_POST['equipamiento'] as $i){
                            switch($i){
                                case '1':
                                    $importe+=25;
                                    break;
                                case '2':
                                    $importe+=25;
                                    break;
                                case '3':
                                    $importe+=40;
                                    break;
                                case '4':
                                    $importe+=15;
                                    break;
                            }
                        }

                        echo '<h3 style="color:blue;">Datos correctos. El importe a pagar es de '.$importe.'€</h3>';

                        $competencias=implode(',', $_POST['competiciones']);
                        $equipExtras=implode(',', $_POST['equipamiento']);

                        $jugador = new Jugador($_POST['numJugador'],
                                                $_POST['nombre'],
                                                $_POST['fecha'],
                                                $_POST['categoria'],
                                                $_POST['tipoC'],
                                                $competencias,
                                                $equipExtras,
                                                $importe);

                        if($modelo->crearJugador($jugador)){
                             echo '<h3 style="color:blue">Jugador creada</h3>';
                         } else{
                             echo '<h3 style="color:red">Jugador no creada</h3>';
                         }

                    }
                }
             }
        }

        if(isset($_POST['ver'])){
            if(file_exists('jugadores.txt')){
                $jugadoresTotal=$modelo->obtenerJugador();

    ?>

    <br><br>
    <table align="center">
        <tr>
            <th>Nº Jugador</th>
            <th>Nombre y Apellidos</th>
            <th>Fecha de Nacimiento</th>
            <th>Categoria</th>
            <th>Tipo de categoria</th>
            <th>Competiciones</th>
            <th>Equipaciones y Extras</th>
            <th>Importe</th>
        </tr>
        <?php
        
                foreach($jugadoresTotal as $j){
                    //$j = new Jugador();
                    echo '<tr>';
                        echo '<td>'.$j->getNumero().'</td>';
                        echo '<td>'.$j->getNombre().'</td>';
                        echo '<td>'.date('d/m/Y', strtotime($j->getFecha())).'</td>';
                        echo '<td>'.$j->getCategoria().'</td>';
                        echo '<td>'.$j->getTipoC().'</td>';
                        echo '<td>'.$j->getCompetencia().'</td>';
                        echo '<td>'.$j->obtenerEquipamiento().'</td>';
                        echo '<td>'.$j->getImporte().'€</td>';
                    echo '</tr>';
                }

        ?>
    </table>

    <?php

            }
            
        }

    ?>
</body>
</html>