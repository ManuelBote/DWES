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
        //Boton crear
        //Boton crear
        if(isset($_POST['crear'])){
            if(empty($_POST['propietario']) or empty($_POST['matricula']) or empty($_POST['color'])){
                $mensaje=array('e', 'Debe rellenar todos los campos');
            }else{
                //Comprobar que no existe otro vehiculo con la misma matricula
                $v = $bd->obtenerVehiculo($_POST['matricula']);
                if($v == null){
                    //Crear Vehiculo
                    $v = new Vehiculo(0, $_POST['propietario'], $_POST['matricula'], $_POST['color']);
                    if($bd->crearVehiculo($v)){
                        $mensaje=array('i', 'Vehiculo creado');
                    } else{
                        $mensaje=array('e', 'Error al crear el vehiculo');
                    }
                } else{
                    $mensaje=array('e', 'Ya existe un vehiculo con esa matricula');
                }
            }
        } else if(isset($_POST['insertP'])){
            if(empty($_POST['dni']) or empty($_POST['nombre']) or empty($_POST['telefono'])){
                $mensaje=array('e', 'Debe rellenar todos los campos');
            } else{
                //debemos comprobar que no hay otro propietario con el mismo dni
                $p = $bd->obtenerPropietario($_POST['dni']);
                if($p==null){
                    //Crear propietario
                    $p= new Propietario(0, $_POST['dni'], $_POST['nombre'], $_POST['telefono'], $_POST['email']);
                    if($bd->crearPropietario($p)){
                        $mensaje=array('i', 'Propietario creado con id: '.$p->getId());
                    } else{
                        $mensaje=array('e', 'Error al crear el propietario');
                    }
                } else{
                    $mensaje=array('e', 'Ya existe un propietario con ese dni');
                }
            }
        } else if(isset($_POST['mostrarV'])){
            //Crear una variable de session con el propietario
            $_SESSION['propietario']=$_POST['propietario'];

        } else if(isset($_POST['mostrarR'])){
            $_SESSION['vehiculo'] = $_POST['mostrarR'];

        } else if(isset($_POST['borrar'])){
            
        }
        session_write_close();
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
            <h3 style="text-align:center;">GESTION DE VEHICULOS</h3>

        </header>

        <section>
            <!--Crear Vehiculo-->
            <?php include_once 'crearVehiculo.php' ?>
        </section>
        
        <section>
            <!--Comunicar mensajes-->
            <?php include_once '../vermensaje.php' ?>
        </section>

        <section>
            <!-- Seleccionar y visualizar datos de vehiculo -->
            <?php include_once 'datosVehiculos.php' ?>
        </section>

        <section>
            <!-- Seleccionar y visualizar datos de reparacion -->
            <?php include_once '../Reparaciones/datosReparaciones.php' ?>
        </section>
        

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    </body>
</html>