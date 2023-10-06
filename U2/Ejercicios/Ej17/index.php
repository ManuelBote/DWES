<?php
require_once 'claseCita.php';
require_once 'modelo.php';
$ad = new Modelo();
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
            <input type="date" name="fecha" value="<?php echo date('d/m/Y'); ?>">
            <input type="time" name="hora" value="<?php echo date('H/i');?>">
        </div>
        <div>
            <label for="nombre">Nombre del cliente</label>
            <input type="text" name="nombre" placeholder="Nombre del cliente">
        </div>

        <div>
            <label for="tipos">Tipo de servicio</label>
            <select name="tipos">
                <option value="1">Corte Sra.</option>
                <option value="2">Corte Sr.</option>
                <option value="3">Corte Tinte</option>
                <option value="4">Corte Mechas</option>
            </select>
        </div>
        <div>
            <input type="submit" name="crear" value="Crear cita">
        </div>
    </form>

    <?php

        //Si se ha pulsado en crearCita, hay que crear la cita en el fichero
        if(isset($_POST['crear'])){
            //Chequear que los campos esta rellenos
            if(empty($_POST['fecha'])or empty($_POST['hora'])or empty($_POST['nombre'])or empty($_POST['tipos'])){
                echo '<h3 style="color:red">Error, rellenar todos los campos</h3>';

            }else{
                $cita=new Cita($_POST['fecha'],
                                $_POST['hora'],
                                $_POST['nombre'],
                                $_POST['tipos']);

                //No vamos a chequear que la cita exista
                //Guardar cita en el fichero
                if($ad->crearCita($cita)){
                    echo '<h3 style="color:blue">Cita creada</h3>';
                } else{
                    echo '<h3 style="color:red">Cita no creada</h3>';
                }
            } 
        } 

        $citas=$ad->obtenerCitas();

    ?>

    <table width="50%" align="center">
        <tr>
            <td><b>Fecha</b></td>
            <td><b>Hora</b></td>
            <td><b>Cliente</b></td>
            <td><b>Tipo Servicio</b></td>
            <td><b>Duracion</b></td>
            <td><b>Hora de fin</b></td>
        </tr>
        <?php
            foreach($citas as $c){
                echo '<tr>';
                echo '<td>'.date('d/m/Y', strtotime($c->getFecha())).'</td>';
                echo '<td>'.$c->getHora().'</td>';
                echo '<td>'.$c->getNombre().'</td>';
                echo '<td>'.$c->obtenerTipoServicio().'</td>';
                echo '<td>'.$c->obtenerTiempoServicio().'</td>';
                echo '<td>'.date('H:i',strtotime('1970-01-01'.$c->getHora())+($c->obtenerTiempoServicio()*60)).'</td>';
                echo '</tr>';
            }
        ?>
    </table>
</body>
</html>