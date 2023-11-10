<?php
    require_once '../ModeloDAO.php';
    $bd = new Modelo();
    if($bd->getConexion()==null){
        $mensaje = array('e','Error no hay conexion con la base de datos');
    } else{
        //Controlar el perfil del usuario
        session_start();
        if(isset($_SESSION['usuario']) and ($_SESSION['usuario']->getPerfil()=='C')){
            header('location:../Usuario/login.php');
        }
        session_write_close();
        //Boton crear
        //Boton crear
        if(isset($_POST['crear'])){
            if(false){
                $mensaje=array('e', 'Debe rellenar todos los campos');
            }else{
                
            }

        } else if(isset($_POST['update'])){

        } else if(isset($_POST['borrar'])){
            
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Control de pieza</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    </head>
    <body>
        <header>
            <?php
                require_once '../menu.php';
            ?>
            <br>
            <h3 style="text-align:center;">GESTION DE USUARIO</h3>

        </header>

        <section>
            <!--Crear Vehiculo-->
            <?php include_once 'crearVehiculo.php' ?>
        </section>
        <section>
            <!--Comunicar mensajes-->
            <?php include_once '../verMensaje.php' ?>
        </section>
        <section>
            <!-- Seleccionar y visualizar datos de vehiculo -->
            <?php include_once 'datosVehiculos.php' ?>
        </section>
        <section>
            <!-- Seleccionar y visualizar datos de reparacion -->
            <?php include_once 'datosReparacion.php' ?>
        </section>
        

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    </body>
</html>