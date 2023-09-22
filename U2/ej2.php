<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $entero = 3;
        $decimal = 4.1;
        $cadena = "Hola";
        $boolean = true;


        echo  gettype($entero). ": $entero";
        echo "<br/>". gettype($decimal). ": $decimal";
        echo "<br/>". gettype($cadena). ": $cadena";
        echo "<br/> ". gettype($boolean). ": $boolean";

    ?>
</body>
</html>