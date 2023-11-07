            <br>
            <div class="container p-2 my-5 border">
                <form action="" method="post">
                    <div class="row">
                        <!--Codigo-->
                        <div class="col">
                            <label>DNI</label>
                        </div>
                        <!--Clase-->
                        <div class="col">
                            <label>Nombre</label>
                        </div>
                        <!--Descripcion-->
                        <div class="col">
                            <label>Perfil</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <input type="text" name="dni" placeholder="01234567A" maxlength="9">
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
                    </div>
                        <!--Btn-->
                        <div class="col">
                            <input type="submit" name="crear" value="Crear" class="btn btn-outline-primary">
                            <input type="reset" name="limpiar" value="Cancelar" class="btn btn-outline-primary">
                        </div>
                    </div>
                </form>
            </div>