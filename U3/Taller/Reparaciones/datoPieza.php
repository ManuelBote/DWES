<!--Motrar piezas y dar opcion a modificar o borrar-->
<?php
    function marcarClaseSeleccionada($clase, $clasePieza){
        if($clase == $clasePieza){
            return 'selected=selected';
        }
    }

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
                                    if(isset($_POST['modif']) and $_POST['modif']==$p->getCodigo()){
                                        //Pintar campos para modificar
                                        echo '<td><input type="text" name="codigo" value="'.$p->getCodigo().'" maxlength="3"/></td>';
                                        echo '<td><select name="clase">';
                                            echo '<option '.marcarClaseSeleccionada('Refrigeracion', $p->getClase()).'>Refrigeración</option>';
                                            echo '<option '.marcarClaseSeleccionada('Filtro', $p->getClase()).'>Filtro</option>';
                                            echo '<option '.marcarClaseSeleccionada('Motor', $p->getClase()).'>Motor</option>';
                                            echo '<option '.marcarClaseSeleccionada('Otros', $p->getClase()).'>Otros</option>';
                                        echo '</select></td>';                                    
                                        echo '<td><input type="text" name="desc" value="'.$p->getDescripcion().'"/></td>';
                                        echo '<td><input type="number" name="precio" step="0.01" value="'.$p->getPrecio().'"/></td>';
                                        echo '<td><input type="number" name="stock" value="'.$p->getStock().'"/></td>';
                                        echo '<td>'; 
                                            echo '<button type="submit" class="btn btn-outline-secondary" name="update" value="'.$p->getCodigo().'">Guardar</button>';
                                            echo '<button type="submit" class="btn btn-outline-secondary" name="cancelar">Cancelar</button>';
                                        echo'</td>';
                                    }else{
                                        echo '<td>'.$p->getCodigo().'</td>';
                                        echo '<td>'.$p->getClase().'</td>';                                    
                                        echo '<td>'.$p->getDescripcion().'</td>';
                                        echo '<td>'.$p->getPrecio().'</td>';
                                        echo '<td>'.$p->getStock().'</td>';
                                        echo '<td>'; 
                                            echo '<button type="submit" class="btn btn-outline-secondary" name="modif" value="'.$p->getCodigo().'"><img src="../img/modif25.png"></button>';
                                            echo '<button type="button" class="btn btn-outline-secondary" name="avisar" value="" data-bs-toggle="modal" data-bs-target="#a'.$p->getCodigo().'"><img src="../img/delete25.png"></button>';
                                        echo'</td>';
                                    }
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