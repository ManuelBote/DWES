<?php
include_once 'Alumno.php';
include_once 'accesoDatos.php';
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
        $a = new Alumno($_POST['numEx'], $_POST['nombre'], strtotime($_POST['fecha']));

        //Chequear si el nº de expediente no existe en el fichero
        //Si existe, se debe lanzar un error
        $alTmp=obtenerAlumno($a->getNumEx());

        if($alTmp==null){
            if(crearAlumno($a)){
                //Guardar alumno en el fichero
                echo '<p style="color:blue;">Alumno creado: '.$a->mostrar().'<p>';
            }else{
                echo '<p style="color:red;">Error al crear alumno</p>';
            }
        }else{
            echo '<p style="color:red;">El alumno ya existe</p>';
        }
    }
    ?>

    <!--Mostrar alumnos-->
    <h1>LISTADO DE ALUMNOS</h1>
    <hr>
    <table>
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Fecha nacimiento</th>
        </tr>
        <?php
        //Obtener en un array todos los alumnos que hay en el fichero
        //$alumnos va a ser un array de objetos Alumnos
        $alumnos=obtenerAlumnos();
        foreach($alumnos as $a){
            echo '<tr>';
            echo '<td>'.$a->getNumEx().'</td>';
            echo '<td>'.$a->getNombre().'</td>';
            echo '<td>'.date('d/m/Y',$a->getFechaN()).'</td>';
            echo '</tr>';
        }
        ?>  
    </table>
    
</body>
</html>