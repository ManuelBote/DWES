<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ej12_2</title>
</head>
<body>

    <h1>Info del alumno (con arrays)</h1>

    <?php

        $alumno = array();
        $alumno['nombre']='Andres';
        $alumno['fechaNac']='29/03/2000';
        $alumno['direccion']=array('tipoVia'=>'Calle', 'nombreVia'=>'Antonio Concha', 'numero'=>23);
        $alumno['curso']='2ºDAW';
        $alumno['asignaturas']=array('DWES','DWEC','DAW','DIW','EIE');

    ?>

    <table border="1px">
        <?php
            foreach($alumno as $clave=>$valor){
                echo '<tr>';
                echo '<td>'.$clave.'</td>';
                echo '<td>';
                if(is_array($valor)){
                    echo '<table border="1px">';
                        foreach($valor as $c2=>$v2){
                            echo '<tr>';
                            echo '<td>'.$c2.'</td>';
                            echo '<td>'.$v2.'</td>';
                            echo '</tr>';
                        }
                    echo '</table>';
                } else {
                    echo $valor;
                }
                echo '</td>';
                echo '</tr>';
            }
        ?>
    </table>
    
</body>
</html>