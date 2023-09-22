<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ej10</title>
</head>

<body>

    <?php
        $array1 = array('Cougar', 'Ford', '', '2500', 'v6', '182');
        echo '$array1: Array escalar - Numero de elementos: '.sizeof($array1);
    ?>

    <table border="1px">
        <tr style="background-color:#A6FEF0">
            <?php
            foreach ($array1 as $indice => $valor) {
                echo '<td>' . $indice . '</br>' . $valor . '</td>';
            }
            ?>
        </tr>
    </table>

    <br/><br/>

    <?php
        $array2 = array('Modelo'=>'Cougar', 'Marca'=>'Ford', 'fecha'=>'', 'CC'=>'2500', 'Motor'=>'v6', 'Potencia'=>'182');
        echo '$array2: Array asociativo - Numero de elementos: '.sizeof($array2);
    ?>

    <table border="1px">
        <tr style="background-color:#A6FEF0">
            <?php
            foreach ($array1 as $indice => $valor) {
                echo '<td>' . $indice . '</br>' . $valor . '</td>';
            }
            ?>
        </tr>
    </table>
</body>

</html>