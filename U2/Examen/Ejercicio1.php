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
            <label>Nº de Jugador</label><br>
            <input type="number" name="numJugador" placeholder="Nº de jugador">
        </div>
        <br>
        <div>
            <label>Nombre y Apellidos</label><br>
            <input type="text" name="nombre" placeholder="Nombre y apellidos">
        </div>
        <br>
        <div>
            <label>Fecha de Nacimiento</label><br>
            <input type="date" name="fecha">
        </div>
        <br>
        <div>
            <label>Selecciona Categoria</label><br>
            <select name="categoria">
                <option value="1">Benjamin</option>
                <option value="2">Alevin</option>
                <option value="3">Infantil</option>
                <option value="4">Cadete</option>
                <option value="5">Junior</option>
                <option value="6">Senior</option>
            </select>
        </div>
        <br>
        <div>
            <label>Tipo de Categotia</label><br>
            <input type="radio" name="tipoC" value="Masculina" checked="checked">Masculina
            <input type="radio" name="tipoC" value="Femenina">Femenina
            <input type="radio" name="tipoC" value="Mixta">Mixta
        </div>
        <br>
        <div>
            <label>Selecciona la/las competiciones</label><br>
            <select name="competiciones[]" multiple="multiple">
                <option value="Primera">Primera</option>
                <option value="Segunda A">Segunda A</option>
                <option value="Segunda B">Segunda B</option>
                <option value="Tercera">Tercera</option>
            </select>
        </div>
        <br>
        <div>
            <label>Equipamiento y Extras</label><br>
            <input type="checkbox" name="equipamiento[]" value="1" checked="checked">Entrenamiento(25,00€)
            <input type="checkbox" name="equipamiento[]" value="2">Partidos(25,00€)
            <input type="checkbox" name="equipamiento[]" value="3">Chandal(40,00€)
            <input type="checkbox" name="equipamiento[]" value="4">Bolso(15,00€)
        </div>
        <br>
        <div>
            <input type="submit" name="enviar" value="Enviar">
            <input type="submit" name="limpiar" value="Limpiar">
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
                    }
                }
             }
        }

    ?>
</body>
</html>