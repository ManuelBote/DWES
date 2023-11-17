
<?php
                if(isset($_SESSION['propietario'])){
                    $vehiculos = $bd->obtenerVehiculos($_SESSION['propietario']);
            ?>
            <div class="container p-5 my-5 border">
                <form action="" method="post">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Codigo</th>
                                <th>Matricula</th>
                                <th>Color</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach($vehiculos as $v){
                                    echo '<tr>';
                                    if(isset($_POST['modif']) and $_POST['modif']==$v->getCodigo()){
                                        //Pintar campos para modificar
                                        echo '<td><input type="text" name="codigo" value="'.$v->getCodigo().'" disabled="disabled"/></td>';
                                        echo '<td><input type="text" name="matricual" value="'.$v->getMatricula().'"/></td>';
                                        echo '<td><input type="color" name="color" value="'.$v->getColor().'"/></td>';                                  
                                        echo '<td>'; 
                                            echo '<button type="submit" class="btn btn-outline-secondary" name="update" value="'.$v->getCodigo().'">Guardar</button>';
                                            echo '<button type="submit" class="btn btn-outline-secondary" name="cancelar">Cancelar</button>';
                                        echo'</td>';
                                    }else{
                                        echo '<td>'.$v->getCodigo().'</td>';
                                        echo '<td>'.$v->getMatricula().'</td>';
                                        echo '<td><input type="color" name="color" value="'.$v->getColor().'" disabled="disabled"/></td>';
                                        echo '<td>'; 
                                            echo '<button type="submit" class="btn btn-outline-secondary" name="modif" value="'.$v->getCodigo().'"><img src="../img/modif25.png"></button>';
                                            echo '<button type="button" class="btn btn-outline-secondary" name="avisar" value="" data-bs-toggle="modal" data-bs-target="#a'.$v->getCodigo().'"><img src="../img/delete25.png"></button>';
                                            echo '<button type="submit" class="btn btn-outline-secondary" name="mostrarR" value="'.$v->getCodigo().'">Mostrar Reparaciones</button>';
                                        echo'</td>';
                                    }
                                    echo '</tr>';

                                    //Definir ventana modal
                            ?>
                                <!-- The Modal -->
                                <div class="modal" id="a<?php echo $v->getCodigo(); ?>">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">Borrar vehiculo</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>

                                        <!-- Modal body -->
                                        <div class="modal-body">
                                            ¿Está seguro de borrar el vehiculo <?php echo $v->getMatricula(); ?>?
                                        </div>

                                        <!-- Modal footer -->
                                        <div class="modal-footer">
                                            <button type="submit" name="borrar" value="<?php echo $v->getCodigo();?>" class="btn btn-danger" data-bs-dismiss="modal">Borrar</button>
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