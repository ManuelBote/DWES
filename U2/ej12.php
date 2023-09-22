<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ej12</title>
</head>
<body>
    
    <?php

        $persona = array(2345.65, 'Carlos', 34, array('nombre'=>'Maria', 'edad'=>19), true);

    ?>

    <table border="1px">
        <tr>
            <?php

                foreach($persona as $valor){
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
                    } else{
                        echo $valor;
                    }
                    echo '</td>';
                }

            ?>
        </tr>
    </table>

</body>
</html>