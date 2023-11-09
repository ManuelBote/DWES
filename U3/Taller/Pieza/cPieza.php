<?php
    require_once '../ModeloDAO.php';
    $bd = new Modelo();
    if($bd->getConexion()==null){
        $mensaje = array('e','Error no hay conexion con la base de datos');
    } else{
        //Controlar el perfil del usuario
        session_start();
        if(isset($_SESSION['usuario']) and ($_SESSION['usuario']->getPerfil()!='A' and $_SESSION['usuario']->getPerfil()!='M')){
            header('location:../Usuario/login.php');
        }
        session_write_close();
        //Boton crear
        if(isset($_POST['crear'])){
            if(empty($_POST['codigo']) or empty($_POST['clase']) or empty($_POST['desc']) or empty($_POST['precio']) or empty($_POST['stock'])){
                $mensaje = array('e', 'Debes rellenar todos los campos');
            } else{
                //Comprobar que no existe una pieza con el mismo codigo
                $p = $bd->obtenerPieza($_POST['codigo']);
                if($p == null){
                    //La pieza no existe
                    //Insertar pieza
                    $p = new Pieza();
                    $p->setCodigo($_POST['codigo']);
                    $p->setClase($_POST['clase']);
                    $p->setDescripcion($_POST['desc']);
                    $p->setPrecio($_POST['precio']);
                    $p->setStock($_POST['stock']);
                    if($bd->insertarPieza($p)){
                        $mensaje=array('i', 'Pieza creada');
                    }else {
                        $mensaje=array('e', 'Error al crear la pieza');
                    }
                } else {
                    $mensaje = array('e', 'Pieza ya existente: '.$p->getCodigo().' '.$p->getDescripcion());
                }
            }
        } else if(isset($_POST['update'])){
            if(empty($_POST['codigo']) or empty($_POST['clase']) or empty($_POST['desc']) or empty($_POST['precio']) or empty($_POST['stock'])){
                $mensaje = array('e', 'Debes rellenar todos los campos');
            } else{
                $p = $bd->obtenerPieza($_POST['codigo']);
                if($p == null or $p->getCodigo()==$_POST['update']){
                    $p=new Pieza();
                    $p->setCodigo($_POST['codigo']);
                    $p->setClase($_POST['clase']);
                    $p->setDescripcion($_POST['desc']);
                    $p->setPrecio($_POST['precio']);
                    $p->setStock($_POST['stock']);
                    if($bd->modificarPieza($p, $_POST['update'])){
                        $mensaje=array('i', 'Pieza modificada');
                    }else {
                        $mensaje=array('e', 'Error al modificar la pieza');
                    }
                }else {
                    $mensaje = array('e', 'Pieza ya existente una pieza con codigo '.$p->getCodigo());
                }
            }
        } else if(isset($_POST['borrar'])){
            //Chequear que la pieza exista
            $p = $bd->obtenerPieza($_POST['borrar']);
            //Comprobar que se pueda borrar si no se ha usado en ninguna reparacion
            if($bd->existenReparacionesP($p->getCodigo())){
                $mensaje=array('e', 'Error, no se puede borrar la pieza porque existen reparaciones');
            }else{
                //Borrar pieza
                if($p != null){
                    if($bd->borrarPieza($p->getCodigo())){
                        $mensaje=array('i','Pieza borrada');
                        //header('location:cPieza.php');
                    } else{
                        $mensaje=array('e', 'Error, al borrar la pieza');
                    }
                } else{
                    $mensaje=array('e', 'Error, la pieza no existe');
                }
            }
            
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
            <h3 style="text-align:center;">GESTION DE PIEZAS</h3>

        </header>

        <section>
            <!--Crear Pieza-->
            <?php include_once 'crearPieza.php' ?>
        </section>
        <section>
            <!--Comunicar mensajes-->
            <?php include_once '../verMensaje.php' ?>
        </section>
        <section>
            <!-- Visualizar piezas-->
            <?php include_once 'listarPiezas.php' ?>
        </section>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    </body>
</html>