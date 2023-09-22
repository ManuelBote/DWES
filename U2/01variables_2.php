<!-- Mismo ejercicio pero con html-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $nombre="Manuel";
    $edad=19;
    $estatura=1.76;
    $esAlumno=true;
    ?>

    <p>Nombre: <?php echo $nombre;?></p>
    <p>Edad: <?php echo $edad;?></p>
    <p>Estatura: <?php echo $estatura;?></p>
    <p>Es alumno: <?php echo $esAlumno;?></p>

    <table border="1px">
        <tr>
            <th>Variable</th>
            <th>Tipo</th>
        </tr>
        <tr>
            <td>Nombre</td>
            <td><?php echo $nombre; ?></td>
        </tr>
        <tr>
            <td>Edad</td>
            <td><?php echo $edad; ?></td>
        </tr>
        <tr>
            <td>Estatura</td>
            <td><?php echo $estatura; ?></td>
        </tr>
        <tr>
            <td>Es alimno</td>
            <td><?php echo $esAlumno; ?></td>
        </tr>
    </table>


</body>
</html>





