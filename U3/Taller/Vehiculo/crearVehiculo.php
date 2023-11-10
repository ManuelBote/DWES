<br>
            <div class="container p-2 my-5 border">
                <form action="" method="post">
                    <div class="row">
                        <!--Codigo-->
                        <div class="col">
                            <label>Propietarios</label>
                        </div>
                        <!--Clase-->
                        <div class="col">
                            <label>Matricula</label>
                        </div>
                        <!--Descripcion-->
                        <div class="col">
                            <label>Color</label>
                        </div>
                        <div class="col">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <?php $propietario = $bd->obtenerPropietarios() ?>
                            <input type="button" name="crearP" class="btn btn-secondary" data-bs-modal="modal" data-bs-target="#crearPropietario" value="+">
                            <select name="propietario">
                                <?php 
                                foreach($propietario as $p){
                                    echo '<option value="'.$p->getId().'">'.$p->getDni().' - '.$p->getNombre().'</option>';
                                }
                                ?>
                            </select>
                            
                        </div>
                        <div class="col">
                            <input type="text" name="nombre" placeholder="Nombre Usuario">
                        </div>
                        <div class="col">
                            <select name="perfil" class="form-select form-select-sm">
                                <option value="A">Administrador</option>
                                <option value="M">Mecánico</option>
                            </select>
                        </div> 
                        <div class="col">
                            <input type="submit" name="crear" value="Crear" class="btn btn-outline-primary">
                            <input type="reset" name="limpiar" value="Cancelar" class="btn btn-outline-primary">
                        </div>
                    </div>
                        <!--Btn-->
                       
                    </div>
                </form>
            </div>

            <div class="modal fade" id="crearPropietario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Nuevo propietario</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="" method="post">
                        <div class="modal-body">
                            <div class="form-group">
                                <label>DNI</label>
                                <input type="text" name="dni" placeholder="DNI">
                            </div>
                            <div class="form-group">
                                <label>Nombre</label>
                                <input type="text" name="nombre" placeholder="Nombre">
                            </div>
                            <div class="form-group">
                                <label>Telfono</label>
                                <input type="text" name="telefono" placeholder="Telefono">
                            </div>
                            <div class="form-group">
                                <label>email</label>
                                <input type="text" name="email" placeholder="email">
                            </div>

                        </div>
                        <div class="modal-footer">
                            <input type="submit" name="insertP" value="Insertar Propietario" class="btn btn-primary">
                        </div>
                    </form>
                    </div>
                </div>
            </div>