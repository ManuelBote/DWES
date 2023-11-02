<?php
    require_once '../ModeloDAO.php';
    $bd = new Modelo();
    if($bd->getConexion()==null){
        $mensaje = array('e','Error no hay conexion con la base de datos');
    } else{
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
        } else if(isset($_POST['borrar'])){
            //Chequear que la pieza exista
            $p = $bd->obtenerPieza($_POST['borrar']);
            //Comprobar que se pueda borrar si no se ha usado en ninguna reparacion
            if($bd->existenReparaciones($p->getCodigo())){
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
            <br>
            <div class="container p-2 my-5 border">
                <form action="#" method="post">
                    <div class="row">
                        <!--Codigo-->
                        <div class="col">
                            <label>Codigo</label>
                            <input type="text" name="codigo" placeholder="F01" maxlength="3">
                        </div>
                        <!--Clase-->
                        <div class="col">
                            <label>Clase</label>
                            <select name="clase" class="form-select form-select-sm">
                                <option>Refrigeración</option>
                                <option>Filtro</option>
                                <option>Motor</option>
                                <option>Otros</option>
                            </select>
                        </div>
                        <!--Descripcion-->
                        <div class="col">
                            <label>Descripcion</label>
                        <input type="text" name="desc">
                        </div>
                        <div class="col">
                            <label>Precio</label>
                            <input type="number" name="precio" step="0.01">
                        </div>
                        <!--Stock-->
                        <div class="col">
                            <label>Stock</label>
                        <input type="number" name="stock">
                        </div>
                        <!--Btn-->
                        <div class="col">
                            <input type="submit" name="crear" value="Crear" class="btn btn-outline-primary">
                            <input type="reset" name="limpiar" value="Cancelar" class="btn btn-outline-primary">
                        </div>
                    </div>
                </form>
            </div>
        </section>
        <section>
            <!--Comunicar mensajes-->
            <?php
                if(isset($mensaje)){
                    if($mensaje[0]=='e'){
                        echo ' <div class="container p-5 my-5 border"><h3 class="text-danger">'.$mensaje[1].'<h3></div>';
                    } else{
                        echo ' <div class="container p-5 my-5 border"><h3 class="text-success">'.$mensaje[1].'<h3></div>';
                    }
                }
            ?>
        </section>
        <section>
            <!--Motrar piezas y dar opcion a modificar o borrar-->
            <?php
                //Obtener piezas
                if($bd->getConexion()!=null){
                    $piezas = $bd->obtenerPiezas();
            ?>
            <div class="container p-5 my-5 border">
                <form action="" method="post">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Codigo</th>
                                <th>Clase</th>
                                <th>Descripcion</th>
                                <th>Precio</th>
                                <th>Stock</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach($piezas as $p){
                                    echo '<tr>';
                                    echo '<td>'.$p->getCodigo().'</td>';
                                    echo '<td>'.$p->getClase().'</td>';                                    
                                    echo '<td>'.$p->getDescripcion().'</td>';
                                    echo '<td>'.$p->getPrecio().'</td>';
                                    echo '<td>'.$p->getStock().'</td>';
                                    echo '<td>'; 
                                        echo '<button type="submit" class="btn btn-outline-secondary" name="modif" value="'.$p->getCodigo().'"><img src="../img/modif25.png"></button>';
                                        echo '<button type="button" class="btn btn-outline-secondary" name="avisar" value="" data-bs-toggle="modal" data-bs-target="#a'.$p->getCodigo().'"><img src="../img/delete25.png"></button>';
                                    echo'</td>';
                                    echo '</tr>';

                                    //Definir ventana modal
                            ?>
                                <!-- The Modal -->
                                <div class="modal" id="a<?php echo $p->getCodigo(); ?>">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">Borrar pieza</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>

                                        <!-- Modal body -->
                                        <div class="modal-body">
                                            ¿Está seguro de borrar la pieza?
                                        </div>

                                        <!-- Modal footer -->
                                        <div class="modal-footer">
                                            <button type="submit" name="borrar" value="<?php echo $p->getCodigo();?>" class="btn btn-danger" data-bs-dismiss="modal">Borrar</button>
                                        </div>

                                        </div>
                                    </div>
                                </div>
                            <?php
                                }
                            ?>
                        </tbody>
                    </table>
                </form>

            </div>
            <?php
                }
            ?>
        </section>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    </body>
</html>