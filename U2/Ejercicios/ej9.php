<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ej9</title>
</head>
<body>
    
    <h1>PLANETAS DEL SISTEMA SOLAR</h1>

    <table border="1px">
        <tr>
        <?php

            $planetas = array('Mercurio', 'Venus', 'Tierra', 'Marte', 'Jupiter', 'Saturno', 'Urano', 'Neptuno');
            foreach($planetas as $valor){
                echo '<td>'.$valor.'</td>';
            }

        ?>
        </tr>
    </table>

    <h2>Nº de planetas: <?php echo sizeof($planetas)?></h2>

</body>
</html>