<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ej12</title>
</head>
<body>
    
    <?php
        $datosPersona = array();
        $datosPersona[]=2345.65;
        $datosPersona[]="Carlos";
        $datosPersona[]=34;
        $datosPersona[]=array('Nombre'=>"María", 'Edad'=>19);
        $datosPersona[]=True;
    ?>

    <table border="1px">
        <tr>
        <?php
        foreach($datosPersona as $valor){
        
            if(is_array($valor)){
                echo '<td>';
                echo '<table>';
                foreach($valor as $indice2=>$valor2){
                    echo '<tr>';
                    echo '<td>'.$indice2.'</td>';
                    echo '<td>'.$valor2.'</td>';
                    echo '</tr>';
                }
                echo '</table>';
                echo '</td>';
                

            }else{
                echo '<td>'.$valor.'</td>';
            }
        }
        ?>
        </tr>
    </table>
        <?php
            echo '<br>';
            foreach($datosPersona as $indice=>$var){
                $texto=is_array($var)?'':$var;
                echo 'Posicion '.$indice.' '.gettype($var).'- Valor'.$texto.'<br/>';
       
             if(is_array($var)){
                 foreach($var as $ind2=>$var2){
                     echo '=>'.$ind2.' '.$var2.'<br>';
              }  
            }
          }
        ?>
</body>
</html>