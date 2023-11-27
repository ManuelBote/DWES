<?php

    function marcarOptionSeleccionado($option, $optionSelect){
        if($option == $optionSelect){
            return 'selected=selected';
        }
    }

?>

            <div class="container p-2 my-5 border">
                <form action="" method="post">
                    <div class="row">
                        <!--Codigo-->
                        <div class="col">
                            <label>Pieza</label>
                        </div>
                        <!--Clase-->
                        <div class="col">
                            <label>Cantidad</label>
                        </div>
                        <div class="col">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <?php $piezas = $bd->obtenerPiezas() ?>
                            <select name="piezas">
                                <?php 
                                foreach($piezas as $p){
                                    echo '<option value="'.$p->getCodigo().'">'.
                                    $p->getClase().' - '.$p->getDescripcion().'</option>';
                                }
                                ?>
                            </select>
                        </div>

                        <div class="col">
                            <input type="number" name="cantidad" value="1">
                        </div>
                        <div class="col">
                            <input type="submit" name="crearPR" value="Crear" class="btn btn-outline-success">
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