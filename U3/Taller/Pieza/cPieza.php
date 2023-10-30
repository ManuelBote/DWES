<?php
    require_once '../ModeloDAO.php';
    $bd = new Modelo();
    if($bd->getConexion()==null){
        $mensaje = array('e','Error no hay conexion con la base de datos');
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Control de pieza</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    </head>
    <body>
        <header>
            <?php
                require_once '../menu.php';
            ?>
            <br>
            <h3 style="text-align:center;">GESTION DE PIEZAS</h3>

        </header>

        <section>
            <!--Crear Pieza-->

        </section>
        <section>
            <!--Comunicar mensajes-->
            <?php
                if(isset($mensaje)){
                    if($mensaje[0]=='e'){
                        echo ' <div class="container p-5 my-5 border"><h3 class="text-danger">'.$mensaje[1].'<h3></div>';
                    } else{
                        echo ' <div class="container p-5 my-5 border"><h3 class="text-success">'.$mensaje[1].'<h3></div>';
                    }
                }
            ?>
        </section>
        <section>
            <!--Motrar piezas y dar opcion a modificar o borrar-->
            <?php
                //Obtener piezas
                if($bd->getConexion()!=null){
                    $piezas = $bd->obtenerPiezas();
            ?>
            <div class="container p-5 my-5 border">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Codigo</th>
                            <th>Clase</th>
                            <th>Descripcion</th>
                            <th>Precio</th>
                            <th>Stock</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach($piezas as $p){
                                echo '<tr>';
                                echo '<td>'.$p->getCodigo().'</td>';
                                echo '<td>'.$p->getClase().'</td>';                                    
                                echo '<td>'.$p->getDescripcion().'</td>';
                                echo '<td>'.$p->getPrecio().'</td>';
                                echo '<td>'.$p->getStock().'</td>';
                                echo '</tr>';
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            <?php
                }
            ?>
        </section>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    </body>
</html>