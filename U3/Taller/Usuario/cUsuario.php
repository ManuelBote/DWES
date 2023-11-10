<?php
    require_once '../ModeloDAO.php';
    $bd = new Modelo();
    if($bd->getConexion()==null){
        $mensaje = array('e','Error no hay conexion con la base de datos');
    } else{
        //Controlar el perfil del usuario
        session_start();
        if(isset($_SESSION['usuario']) and ($_SESSION['usuario']->getPerfil()!='A')){
            header('location:../Usuario/login.php');
        }
        session_write_close();
        //Boton crear
        //Boton crear
        if(isset($_POST['crear'])){
            if(empty($_POST['dni']) or empty($_POST['nombre']) or empty($_POST['perfil'])){
                $mensaje=array('e', 'Debe rellenar todos los campos');
            }else{
                //Chequear que no existe el dni
                $u = $bd->obtenerUsuarioDni($_POST['dni']);
                if ($u==null){
                    //Se puede crear
                    $u = new Usuario(0, $_POST['dni'],$_POST['nombre'],$_POST['perfil']);
                    if($bd->crearUsuario($u)){
                        $mensaje=array('i', 'Usuario '.$u->getId().' creado');
                    }else {
                        $mensaje=array('e', 'Error al crear el usuario');
                    }
                } else{
                    $mensaje=array('e', 'Este usuario ya existe');
                }
            }

        } else if(isset($_POST['update'])){
            if(empty($_POST['dni']) or empty($_POST['nombre']) or empty($_POST['perfil'])){
                $mensaje=array('e', 'Debe rellenar todos los campos');
            } else{
                 //Chequear que no existe el dni
                 $u = $bd->obtenerUsuarioId($_POST['update']);
                 if ($u!=null){
                     //Chequear que si se modifica el dni no existe de nuevo
                     if($_POST['dni'] != $u->getDni()){
                        if($bd->obtenerUsuarioDni($_POST['dni']) !=null){
                            $existeDNI = true;
                            $mensaje = array('e','El dni ya esta registrado');
                        }
                     }
                     if(!isset($existeDNI)){
                        $u->setDni($_POST['dni']);
                        $u->setNombre($_POST['nombre']);
                        $u->setPerfil($_POST['perfil']);
                        if($bd->modificarUsuario($u)){
                            $mensaje = array('i', 'Usuario modificado');
                        } else{
                            $mensaje=array('e', 'Error al modificar el usuario');
                        }

                     }
                     
                 } else{
                     $mensaje=array('e', 'Este usuario no existe');
                 }
            }

        } else if(isset($_POST['borrar'])){
            $u=$bd->obtenerUsuarioId($_POST['borrar']);
            if($u!=null){
                if($bd->existenReparacionesU($u->getId())){
                    $mensaje=array('e', 'No se puede borrar el usuario porque existen reparaciones');
                } else{
                    if($bd->borrarUsuario($u->getId())){
                        $mensaje=array('i', 'Usuario borrado');
                    }else{
                        $mensaje=array('e', 'Error al borrar el usuario');

                    }
                }

            } else{
                $mensaje=array('e', 'No se encuentra al usuario');
            }
            
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Control de usuarios</title>
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
            <!--Crear Pieza-->
            <?php include_once 'crearUsuario.php' ?>
        </section>
        <section>
            <!--Comunicar mensajes-->
            <?php include_once '../verMensaje.php' ?>
        </section>
        <section>
            <!-- Visualizar piezas-->
            <?php include_once 'listarUsuario.php' ?>
        </section>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    </body>
</html>