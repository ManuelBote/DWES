
<?php
                if(isset($_SESSION['vehiculo'])){
                    $rehiculos = $bd->obtenerReparaciones($_SESSION['vehiculo']);
            ?>
            <div class="container p-5 my-5 border">
                <form action="" method="post">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Fecha</th>
                                <th>Hora en taller</th>
                                <th>Pagado</th>
                                <th>Usuario</th>
                                <th>Precio/Hora</th>
                                <th></th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach($reparaciones as $r){
                                    echo '<tr>';
                                    if(isset($_POST['modif']) and $_POST['modif']==$r->getCodigo()){
                                        //Pintar campos para modificar
                                        echo '<td><input type="text" name="codigo" value="'.$r->getCodigo().'" disabled="disabled"/></td>';
                                        echo '<td><input type="text" name="matricual" value="'.$r->getMatricula().'"/></td>';
                                        echo '<td><input type="color" name="color" value="'.$r->getColor().'"/></td>';                                  
                                        echo '<td>'; 
                                            echo '<button type="submit" class="btn btn-outline-secondary" name="update" value="'.$r->getCodigo().'">Guardar</button>';
                                            echo '<button type="submit" class="btn btn-outline-secondary" name="cancelar">Cancelar</button>';
                                        echo'</td>';
                                    }else{
                                        echo '<td>'.$r->getCodigo().'</td>';
                                        echo '<td>'.$r->getMatricula().'</td>';
                                        echo '<td><input type="color" name="color" value="'.$r->getColor().'" disabled="disabled"/></td>';
                                        echo '<td>'; 
                                            echo '<button type="submit" class="btn btn-outline-secondary" name="modif" value="'.$r->getCodigo().'"><img src="../img/modif25.png"></button>';
                                            echo '<button type="button" class="btn btn-outline-secondary" name="avisar" value="" data-bs-toggle="modal" data-bs-target="#a'.$r->getCodigo().'"><img src="../img/delete25.png"></button>';
                                            echo '<button type="submit" class="btn btn-outline-secondary" name="mostrarR" value="'.$r->getCodigo().'">Mostrar Reparaciones</button>';
                                        echo'</td>';
                                    }
                                    echo '</tr>';

                                    //Definir ventana modal
                            ?>
                                <!-- The Modal -->
                                <div class="modal" id="a<?php echo $r->getCodigo(); ?>">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">Borrar vehiculo</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>

                                        <!-- Modal body -->
                                        <div class="modal-body">
                                            ¿Está seguro de borrar el vehiculo <?php echo $r->getMatricula(); ?>?
                                        </div>

                                        <!-- Modal footer -->
                                        <div class="modal-footer">
                                            <button type="submit" name="borrar" value="<?php echo $r->getCodigo();?>" class="btn btn-danger" data-bs-dismiss="modal">Borrar</button>
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