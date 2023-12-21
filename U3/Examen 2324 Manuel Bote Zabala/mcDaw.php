<?php
    require_once 'Modelo.php';

    $bd=new Modelo();
    if($bd->getConexion()==null){
        $mensaje = 'ERROR, No hay conexion con la bd';
    } else{
        session_start();

        //Boton seleccionar tienda
        if(isset($_POST['selTienda'])){
            $tienda = $bd->obtenerTiendaId($_POST['tienda']);
            $_SESSION['tienda'] =$tienda;
            $_SESSION['cesta'] = array();
        }

        //Boton cambiar de tienda
        if(isset($_POST['cambiar'])){
            session_destroy();
            header('location:mcDaw.php');
        }

        //Boton de agregar pedido
        if(isset($_POST['agregar'])){
            if($_POST['cantidad']<=0){
                $mensaje = 'ERROR, No puedes pedir menos de 0 productos';
            } else{
                $enCesta = false;
                foreach($_SESSION['cesta'] as $posicion=>$c){

                    if($c->getProducto()->getCodigo() == $_POST['producto']){
                        $enCesta = true;
                        $cantidadTotal = $c->getCantidad() + $_POST['cantidad'];
                        $pCesta = new Producto($c->getProducto()->getCodigo(), $c->getProducto()->getNombre(),
                         $c->getProducto()->getPrecio());

                        $_SESSION['cesta'][$posicion] = new ProductoEnCesta($pCesta, $cantidadTotal);
                    }
                }
                if($enCesta == false){
                   $productoCesta = $bd->agregarProductoCesta($_POST['producto'], $_POST['cantidad']);
                    $_SESSION['cesta'][] = $productoCesta; 
                }
            
            }
            
        }
        
        //Boton borrar
        if(isset($_POST['cBorrar'])){
            foreach($_SESSION['cesta'] as $posicion=>$c){
                if($c->getProducto()->getCodigo() == $_POST['cBorrar'][0]){

                    if($_POST['cBorrar'][1]<=0){
                        unset($_SESSION['cesta'][$posicion]);
                        array_values($_SESSION['cesta']);

                    } else{
                        $pCesta = new Producto($c->getProducto()->getCodigo(), $c->getProducto()->getNombre(),
                         $c->getProducto()->getPrecio());

                        $_SESSION['cesta'][$posicion] = new ProductoEnCesta($pCesta, $_POST['cBorrar'][1]);
                    }
                    
                }
            }
        }

        //Boton de crear pedido
        if(isset($_POST['crearPedido'])){
            if($_SESSION['cesta'] == null){
                //Si la cesta esta vacia
                $mensaje = 'ERROR, La cesta esta vacia';

            } else{
                //Si la cesta esta llena creamos el pedido y lo añadimos a la base de datos
               if(($p = $bd->crearPedido($_SESSION['cesta'], $_SESSION['tienda'])) != null){

                //Borramos los productos de la sesion
                $_SESSION['cesta'] = array();

                //Llamamos a la funcion para obtener los datos del pedido
                if(($datosP = $bd->obtenerDatosPedido($p)) != null){
                    $mensaje= 'Pedido '.$datosP[0].'. Nº de Productos: '.$datosP[1].', Importe total: '.$datosP[2].'€';

                } else{
                    $mensaje = 'Error al cargar los datos del pedido';
                }

               } else{
                $mensaje = 'Error al crear el pedido';
               } 
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div>
        <h1 style='color:red;'><?php echo isset($mensaje)?$mensaje:'';?></h1>
    </div>
    <form action="mcDaw.php" method="post">

        <?php
            if(!isset($_SESSION['tienda'])){
        ?>

        <div>
            <h1 style='color:blue;'>Tienda</h1>
            <label for="tienda">Tienda</label><br />
            <select name="tienda">
                <?php
                    $tiendas = $bd->obtenerTiendas();
                    foreach($tiendas as $t){
                        echo '<option value="'.$t->getCodigo().'">'.$t->getNombre().'</option>';
                    }
                ?>
            </select>
            <button type="submit" name="selTienda">Seleccionar tienda</button>
        </div>

        <?php
            } else{
        ?>

        <div>
            <h1 style='color:blue;'>Añade productos a la cesta</h1>
            <h2 style='color:green;'>Datos Tienda: 
                <?php 
                    echo $_SESSION['tienda']->getNombre().' - '.$_SESSION['tienda']->getTelefono(); 
                ?>
                <button type="submit" name="cambiar">Cambiar Tienda</button>
            </h2>
            <table>
                <tr>
                    <td><label for="producto">Producto</label><br /></td>
                    <td><label for="cantidad">Cantidad</label><br /></td>
                    <td>Añadir a la cesta</td>
                </tr>
                <tr>
                    <td>
                        <select id="producto" name="producto">
                            <?php
                                $productos = $bd->obtenerProductos();
                                foreach($productos as $p){
                                    echo '<option value="'.$p->getCodigo().'">'.$p->getNombre().' - '.$p->getPrecio().'</option>';
                                }
                            ?>
                        </select>
                    </td>
                    <td><input id="cantidad" type="number" name="cantidad" value="1"/></td>
                    <td><button type="submit" name="agregar">+</button></td>
                </tr>
            </table>            
        </div>
        <div>
            <h1 style='color:blue;'>Contenido de la cesta</h1>
            <table  border="1"  rules="all"  width="25%">
                <tr>
                    <td><b>Producto</b></td>
                    <td><b>Cantidad</b></td>
                    <td><b>Precio</b></td>
                    <td><b>Borrar</b></td>
                </tr>
                                
                <?php
                    if(isset($_SESSION['cesta'])){
                        foreach($_SESSION['cesta'] as $c){
                            echo '<tr>';
                                echo '<td>'.$c->getProducto()->getNombre().'</td>';
                                if(isset($_POST['borrar']) && $_POST['borrar']==$c->getProducto()->getCodigo()){
                                    echo '<td><input type="number" value="'.$c->getCantidad().'" name="cantidadB" /></td>';
                                    echo '<td>'.($c->getProducto()->getPrecio()*$c->getCantidad()).'€</td>';
                                    echo '<td><button type="submit" name="cBorrar" 
                                    value="'.array($c->getProducto()->getCodigo(), $c->getCantidad()).'">Confirmar</button></td>';
                                } else{
                                    echo '<td>'.$c->getCantidad().'</td>';
                                    echo '<td>'.($c->getProducto()->getPrecio()*$c->getCantidad()).'€</td>';
                                    echo '<td><button type="submit" name="borrar" value="'.$c->getProducto()->getCodigo().'">Borrar</button></td>';
                                }
                            echo '</tr>';
                        }
                    }
                ?>

            </table>   
            <button type="submit" name="crearPedido">Crear Pedido</button>         
        </div>

        <?php } ?>
    </form>
</body>
</html>