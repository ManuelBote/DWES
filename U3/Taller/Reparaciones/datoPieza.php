<!--Motrar piezas y dar opcion a modificar o borrar-->
<?php
    function marcarClaseSeleccionada($clase, $clasePieza){
        if($clase == $clasePieza){
            return 'selected=selected';
        }
    }

                //Obtener piezas
                if($bd->getConexion()!=null){
                    $piezas = $bd->obtenerPiezasReparacion($_SESSION['reparacion']);
            ?>
            <div class="container p-5 my-5 border">
                <form action="" method="post">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Codigo Pieza</th>
                                <th>Clase</th>
                                <th>Descripcion</th>
                                <th>Cantidad</th>
                                <th>Importe</th>
                                <th>Precio total</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach($piezas as $pr){
                                    echo '<tr>';
                                    if(isset($_POST['modif']) and $_POST['modif']==$pr->getP()->getCodigo()){
                                        //Pintar campos para modificar
                                        echo '<td><input type="text" name="codigo" value="'.$pr->getP()->getCodigo().'" disabled="disabled"/></td>';
                                        echo '<td><input type="text" name="clase" value="'.$pr->getP()->getClase().'" disabled="disabled"/></td>';
                                        echo '<td><input type="text" name="desc" value="'.$pr->getP()->getDescripcion().'" disabled="disabled"/></td>';
                                        echo '<td><input type="number" name="cantidad" value="'.$pr->getCantidad().'"/></td>';
                                        echo '<td><input type="number" name="precio" step="0.01" value="'.$pr->getPrecio().'" disabled="disabled"/></td>';
                                        echo '<td></td>';
                                        echo '<td>'; 
                                            echo '<button type="submit" class="btn btn-outline-secondary" name="update" value="'.$pr->getP()->getCodigo().'">Guardar</button>';
                                            echo '<button type="submit" class="btn btn-outline-secondary" name="cancelar">Cancelar</button>';
                                        echo'</td>';
                                    }else{
                                        echo '<td>'.$pr->getP()->getCodigo().'</td>';
                                        echo '<td>'.$pr->getP()->getClase().'</td>';                                    
                                        echo '<td>'.$pr->getP()->getDescripcion().'</td>';
                                        echo '<td>'.$pr->getCantidad().'</td>';
                                        echo '<td>'.$pr->getPrecio().'</td>';
                                        echo '<td>'.$pr->getPrecio()*$pr->getCantidad().'</td>';
                                        echo '<td>'; 
                                            echo '<button type="submit" class="btn btn-outline-secondary" name="modif" value="'.$pr->getP()->getCodigo().'"><img src="../img/modif25.png"></button>';
                                            echo '<button type="button" class="btn btn-outline-secondary" name="avisar" value="" data-bs-toggle="modal" data-bs-target="#a'.$pr->getP()->getCodigo().'"><img src="../img/delete25.png"></button>';
                                        echo'</td>';
                                    }
                                    echo '</tr>';

                                    //Definir ventana modal
                            ?>
                                <!-- The Modal -->
                                <div class="modal" id="a<?php echo $pr->getP()->getCodigo(); ?>">
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
                                            <button type="submit" name="borrar" value="<?php echo $pr->getP()->getCodigo();?>" class="btn btn-danger" data-bs-dismiss="modal">Borrar</button>
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