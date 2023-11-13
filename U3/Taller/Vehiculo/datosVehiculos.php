
<?php
    function marcarOptionSeleccionada($option, $optionSelect){
        if($option == $optionSelect){
            return 'selected=selected';
        }
    }

                if(isset($vehiculos)){
            ?>
            <div class="container p-5 my-5 border">
                <form action="" method="post">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Codifo</th>
                                <th>Propietario</th>
                                <th>Matricula</th>
                                <th>Color</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach($vehiculos as $v){
                                    echo '<tr>';
                                    if(isset($_POST['modif']) and $_POST['modif']==$v->getId()){
                                        //Pintar campos para modificar
                                        echo '<td><input type="text" name="id" value="'.$v->getId().'" disabled="disabled"/></td>';
                                        echo '<td><input type="text" name="dni" value="'.$v->getDni().'"/></td>';
                                        echo '<td><input type="text" name="nombre" value="'.$v->getNombre().'"/></td>';
                                        echo '<td><select name="perfil">';
                                            echo '<option '.marcarOptionSeleccionada('A', $v->getPerfil()).' value="A">Administrador</option>';
                                            echo '<option '.marcarOptionSeleccionada('M', $v->getPerfil()).' value="M">Mecánico</option>';
                                        echo '</select></td>';                                    
                                        echo '<td>'; 
                                            echo '<button type="submit" class="btn btn-outline-secondary" name="update" value="'.$v->getId().'">Guardar</button>';
                                            echo '<button type="submit" class="btn btn-outline-secondary" name="cancelar">Cancelar</button>';
                                        echo'</td>';
                                    }else{
                                        switch($v->getPerfil()){
                                            case 'A': $perfil = 'Administrador'; break;
                                            case 'M': $perfil = 'Mecánico'; break;

                                        }
                                        echo '<td>'.$v->getId().'</td>';
                                        echo '<td>'.$v->getDni().'</td>';
                                        echo '<td>'.$v->getNombre().'</td>';
                                        echo '<td>'.$perfil.'</td>';
                                        echo '<td>'; 
                                            echo '<button type="submit" class="btn btn-outline-secondary" name="modif" value="'.$v->getId().'"><img src="../img/modif25.png"></button>';
                                            echo '<button type="button" class="btn btn-outline-secondary" name="avisar" value="" data-bs-toggle="modal" data-bs-target="#a'.$v->getId().'"><img src="../img/delete25.png"></button>';
                                        echo'</td>';
                                    }
                                    echo '</tr>';

                                    //Definir ventana modal
                            ?>
                                <!-- The Modal -->
                                <div class="modal" id="a<?php echo $v->getId(); ?>">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">Borrar usuario</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>

                                        <!-- Modal body -->
                                        <div class="modal-body">
                                            ¿Está seguro de borrar el Usuario <?php echo $v->getDni().', '.$v->getNombre() ?>?
                                        </div>

                                        <!-- Modal footer -->
                                        <div class="modal-footer">
                                            <button type="submit" name="borrar" value="<?php echo $v->getId();?>" class="btn btn-danger" data-bs-dismiss="modal">Borrar</button>
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