            <br>
            <div class="container p-2 my-5 border">
                <form action="" method="post">
                    <div class="row">
                        <!--Codigo-->
                        <div class="col">
                            <label>Codigo</label>
                            <input type="text" name="codigo" placeholder="F01" ->
                        </div>
                        <!--Clase-->
                        <div class="col">
                            <label>Clase</label>
                            <select name="clase" class="form-select form-select-sm">
                                <option>Refrigeración</option>
                                <option>Filtro</option>
                                <option>Motor</option>
                                <option>Otros</option>
                            </select>
                        </div>
                        <!--Descripcion-->
                        <div class="col">
                            <label>Descripcion</label>
                        <input type="text" name="desc">
                        </div>
                        <div class="col">
                            <label>Precio</label>
                            <input type="number" name="precio" step="0.01">
                        </div>
                        <!--Stock-->
                        <div class="col">
                            <label>Stock</label>
                        <input type="number" name="stock">
                        </div>
                        <!--Btn-->
                        <div class="col">
                            <input type="submit" name="crear" value="Crear" class="btn btn-outline-primary">
                            <input type="reset" name="limpiar" value="Cancelar" class="btn btn-outline-primary">
                        </div>
                    </div>
                </form>
            </div>