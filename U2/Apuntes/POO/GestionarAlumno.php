<?php
include_once 'Alumno.php';
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
            <label for="numEx">NºExpediente</label>
            <input type="text" name="numEx">
        </div>

        <div>
            <label for="nombre">Nombre</label>
            <input type="text" placeholder="Introduce nombre Alumnos" name="nombre">
        </div>

        <div>
            <label for="fechaN">Fecha de nacimiento</label>
            <input type="date" name="fecha" value="<?php echo date('Y-m-d')?>">
        </div>

        <input type="submit" name="crear" value="Crear Alumno">
    </form>

   <?php
   //Se crea el objeto y se muestra
   if(isset($_POST['crear'])){
        $a = new Alumno($_POST['numEx'], $_POST['nombre'], strtotime($_POST['fechaN']));
        $a->mostrar();
   }

   ?>
    
</body>
</html>