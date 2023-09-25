<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <?php

        //Mostrar una variable definida en f1.php
        echo $texto;

        //Incluir codigo de f2.php (muestra un tecto)
        include '08f2.php';

        //Generar un error
        require '08f3.php';

    ?>

</body>
</html>