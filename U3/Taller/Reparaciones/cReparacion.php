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
        if(!isset($_SESSION['reparacion'])){
            header('location:../Vehiculo/cVehiculo.php');

        }

        if(isset($_POST['crear'])){
           //Crear una pieza en reparacion

        }else if(isset($_POST['update'])){
           //Modificar pieza reparacion

        } else if(isset($_POST['borrar'])){
            //Borrar datos reparacion
            
        }
        session_write_close();
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Control de reparacion</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    </head>
    <body>
        <header>
            <?php
                require_once '../menu.php';
            ?>
            <br>
            <h3 style="text-align:center;">GESTION DE REPARACION</h3>

        </header>

        <section>
            <!--Ver reparacion-->
            <?php 
            $r = $bd->obtenerReparacion($_SESSION['reparacion']);
            include_once 'infoReparacion.php' 
            ?>
        </section>

        <section>
            <!--Crear pieza-->
            <?php include_once 'crearPiezaR.php' ?>
        </section>

        <section>
            <!--Comunicar mensajes-->
            <?php include_once '../vermensaje.php' ?>
        </section>

        <section>
            <!-- Seleccionar y visualizar datos de reparacion -->
            <?php include_once 'datoPieza.php' ?>
        </section>

        

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    </body>
</html>