
<?php
                if(isset($_SESSION['vehiculo'])){
                    $reparaciones = $bd->obtenerReparaciones($_SESSION['vehiculo']);
            ?>
            <div class="container p-5 my-5 border">
                <form action="" method="post">
                    <input type="submit" class="btn btn-outline-secondary" name="crearR" value="+"/>
                    <hr/>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Fecha</th>
                                <th>Hora en taller</th>
                                <th>Pagado</th>
                                <th>Usuario</th>
                                <th>Precio/Hora</th>
                                <th>Total reparacion</th>
                                <th></th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach($reparaciones as $r){
                                    echo '<tr>';
                                    if(isset($_POST['modifR']) and $_POST['modifR']==$r->getId()){
                                        //Pintar campos para modificar
                                        echo '<td><input type="text" name="id" value="'.$r->getId().'" disabled="disabled"/></td>';    
                                        echo '<td><input type="date" name="fecha" value="'.date('d/m/Y H:i', strtotime($r->getFecha())).'"  disabled="disabled"/></td>';
                                        echo '<td><input type="number" name="tiempo" step="0.1" value="'.$r->getTiempo().'"/></td>';
                                        echo '<td><input type="checkbox" name="pagado"' .($r->getPagado()?'checked="checked"':"").'/></td>';
                                        echo '<td><input type="text" name="usuario" value="'.$bd->obtenerUsuarioId($r->getUsuario())->getNombre().'"  disabled="disabled"/></td>';
                                        echo '<td><input type="number" name="precioH" step="0.01" value="'.$r->getPrecioH().'"/></td>';
                                        echo '<td><input type="number" name="impTotal" disabled="disabled" value="'.$r->getImporteTotal().'"/></td>';
                                        echo '<td>'; 
                                            echo '<button type="submit" class="btn btn-outline-secondary" name="updateR" value="'.$r->getId().'">Guardar</button>';
                                            echo '<button type="submit" class="btn btn-outline-secondary" name="cancelar">Cancelar</button>';
                                        echo'</td>';
                                    }else{
                                        echo '<td>'.$r->getId().'</td>';
                                        echo '<td>'.date('d/m/Y H:i', strtotime($r->getFecha())).'</td>';
                                        echo '<td>'.$r->getTiempo().'</td>';
                                        echo '<td><input type="checkbox"'.($r->getPagado()?'checked="checked"':"").'" disabled="true"/></td>';
                                        echo '<td>'.$bd->obtenerUsuarioId($r->getUsuario())->getNombre().'</td>';
                                        echo '<td>'.$r->getPrecioH().'</td>';
                                        echo '<td>'.$r->getImporteTotal().'</td>';
                                        echo '<td>'; 
                                            echo '<button type="submit" class="btn btn-outline-secondary" name="modifR" value="'.$r->getId().'"><img src="../img/modif25.png"></button>';
                                            echo '<button type="button" class="btn btn-outline-secondary" name="avisarR" value="" data-bs-toggle="modal" data-bs-target="#r'.$r->getId().'"><img src="../img/delete25.png"></button>';
                                            echo '<button type="submit" class="btn btn-outline-secondary" name="datosR" value="'.$r->getId().'">Ver</button>';
                                            echo '<button type="submit" class="btn btn-outline-secondary" name="pagarR" value="'.$r->getId().'">Pagar</button>';
                                        echo'</td>';
                                    }
                                    echo '</tr>';

                                    //Definir ventana modal
                            ?>
                                <!-- The Modal -->
                                <div class="modal" id="r<?php echo $r->getId(); ?>">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">Borrar reparacion</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>

                                        <!-- Modal body -->
                                        <div class="modal-body">
                                            ¿Está seguro de borrar la reparacion Nº <?php echo $r->getId(); ?>
                                             con matricula: <?php echo $bd->obtenerVehiculoId($r->getCoche()) -> getMatricula(); ?>?
                                        </div>

                                        <!-- Modal footer -->
                                        <div class="modal-footer">
                                            <button type="submit" name="borrar" value="<?php echo $r->getId();?>" class="btn btn-danger" data-bs-dismiss="modal">Borrar</button>
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