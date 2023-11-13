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
                            <select name="propietario">
                                <?php 
                                foreach($propietario as $p){
                                    echo '<option value="'.$p->getId().'">'.$p->getDni().' - '.$p->getNombre().'</option>';
                                }
                                ?>
                            </select>
                             <button type="button" name="crearP" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#crearPropietario">+</button>
                            
                        </div>
                        <div class="col">
                            <input type="text" name="matricula" placeholder="1234AAA" pattern="[0-9]{4}[A-Z]{3}">
                        </div>
                        <div class="col">
                            <input type="color" name="color">
                        </div> 
                        <div class="col">
                            <input type="submit" name="crear" value="Crear" class="btn btn-outline-success">
                            <input type="submit" name="mostrarV" value="Mostrar" class="btn btn-outline-primary">
                            <input type="reset" name="limpiar" value="Cancelar" class="btn btn-outline-dark">
                            
                        </div>
                    </div>
                        <!--Btn-->
                       
                    </div>
                </form>
            </div>

            <div class="modal" id="crearPropietario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Nuevo propietario</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form action="" method="post">
                        <div class="modal-body">
                            <div class="form-group">
                                <label>DNI</label>
                                <input type="text" name="dni" placeholder="DNI" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Nombre</label>
                                <input type="text" name="nombre" placeholder="Nombre" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Telfono</label>
                                <input type="text" name="telefono" placeholder="Telefono" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>email</label>
                                <input type="text" name="email" placeholder="email" class="form-control">
                            </div>

                        </div>
                        <div class="modal-footer">
                            <input type="submit" name="insertP" value="Insertar Propietario" class="btn btn-success"  data-bs-dismiss="modal">
                            <input type="submit" name="cerrar" value="Cancelar" class="btn btn-danger" data-bs-dismiss="modal">
                        </div>
                    </form>
                    </div>
                </div>
            </div>