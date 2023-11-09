<!--Motrar piezas y dar opcion a modificar o borrar-->
<?php
    function marcarOptionSeleccionada($option, $optionSelect){
        if($option == $optionSelect){
            return 'selected=selected';
        }
    }

                //Obtener piezas
                if($bd->getConexion()!=null){
                    $usuario = $bd->obtenerUsuarios();
            ?>
            <div class="container p-5 my-5 border">
                <form action="" method="post">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>DNI</th>
                                <th>Nombre</th>
                                <th>Perfil</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach($usuario as $u){
                                    echo '<tr>';
                                    if(isset($_POST['modif']) and $_POST['modif']==$u->getId()){
                                        //Pintar campos para modificar
                                        echo '<td><input type="text" name="id" value="'.$u->getId().'" disabled="disabled"/></td>';
                                        echo '<td><input type="text" name="dni" value="'.$u->getDni().'"/></td>';
                                        echo '<td><input type="text" name="nombre" value="'.$u->getNombre().'"/></td>';
                                        echo '<td><select name="perfil">';
                                            echo '<option '.marcarOptionSeleccionada('A', $u->getPerfil()).' value="A">Administrador</option>';
                                            echo '<option '.marcarOptionSeleccionada('M', $u->getPerfil()).' value="M">Mecánico</option>';
                                        echo '</select></td>';                                    
                                        echo '<td>'; 
                                            echo '<button type="submit" class="btn btn-outline-secondary" name="update" value="'.$u->getId().'">Guardar</button>';
                                            echo '<button type="submit" class="btn btn-outline-secondary" name="cancelar">Cancelar</button>';
                                        echo'</td>';
                                    }else{
                                        switch($u->getPerfil()){
                                            case 'A': $perfil = 'Administrador'; break;
                                            case 'M': $perfil = 'Mecánico'; break;

                                        }
                                        echo '<td>'.$u->getId().'</td>';
                                        echo '<td>'.$u->getDni().'</td>';
                                        echo '<td>'.$u->getNombre().'</td>';
                                        echo '<td>'.$perfil.'</td>';
                                        echo '<td>'; 
                                            echo '<button type="submit" class="btn btn-outline-secondary" name="modif" value="'.$u->getId().'"><img src="../img/modif25.png"></button>';
                                            echo '<button type="button" class="btn btn-outline-secondary" name="avisar" value="" data-bs-toggle="modal" data-bs-target="#a'.$u->getId().'"><img src="../img/delete25.png"></button>';
                                        echo'</td>';
                                    }
                                    echo '</tr>';

                                    //Definir ventana modal
                            ?>
                                <!-- The Modal -->
                                <div class="modal" id="a<?php echo $u->getId(); ?>">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">Borrar usuario</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>

                                        <!-- Modal body -->
                                        <div class="modal-body">
                                            ¿Está seguro de borrar el Usuario <?php echo $u->getDni().', '.$u->getNombre() ?>?
                                        </div>

                                        <!-- Modal footer -->
                                        <div class="modal-footer">
                                            <button type="submit" name="borrar" value="<?php echo $u->getId();?>" class="btn btn-danger" data-bs-dismiss="modal">Borrar</button>
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