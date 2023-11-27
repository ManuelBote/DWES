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

        if(isset($_POST['crearPR'])){
           //Crear una pieza en reparacion
           //Chequear que este relleno la pieza y la cantidad y que la cantidad no sea negativa
           if(empty($_POST['piezas']) or empty($_POST['cantidad']) or $_POST['cantidad']<1){
                $mensaje = array('e','Error inserte correctamente los datos');
           } else{
            $pieza = $bd->obtenerPieza($_POST['piezas']);
            if($pieza->getStock()<$_POST['cantidad']){
                $mensaje = array('e','Error no hay stock suficiente');
            } else{
                //Si la pieza ya se ha usado en esa reparacion hay que hacer update e incrementar la cantidad
                //Sino hay que hacer in insertar
                $pr = $bd->obtenerPiezaReparacion($_SESSION['reparacion'], $pieza->getCodigo());
                if($pr == null){
                    //Insert
                    if($bd->insertarPR($_SESSION['reparacion'], $pieza, $_POST['cantidad'])){
                        $mensaje = array('i','Pieza insertada');
                    } else{
                        $mensaje = array('e','Error al insertar pieza');
                    }

                } else{
                    //Update
                    if($bd->modificarPR($_SESSION['reparacion'], $pieza, $_POST['cantidad'])){
                        $mensaje = array('i','Pieza modificada');
                    } else{
                        $mensaje = array('e','Error al modificar pieza');
                    }

                }
            }
           }
           //Chequear que haya stock

        }else if(isset($_POST['update'])){
           //Modificar pieza reparacion
           //Obtener la pieza a modificar 
           $pr = $bd->obtenerpiezareparacion($_SESSION['reparacion'], $_POST['update']);
           if($pr!=null){
            if($bd->modificarCantidad($pr, $_POST['cantidad'])){
                $mensaje = array('i','Pieza modificada');
            } else{
                $mensaje = array('e','Error al modificar pieza');
            }
           }

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