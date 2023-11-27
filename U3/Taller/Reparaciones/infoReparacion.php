            <div class="container p-5 my-2 border">


                <form action="" method="post">
                    <label>Codigo Reparacion: <?php echo $r->getId() ?></label>
                    <label>Matricula: <?php echo $r->getCoche() ?></label>
                    <label>Fecha: <?php echo $r->getFecha() ?></label>
                    <label>Tiempo: <?php echo $r->getTiempo() ?></label>
                    <label>Pagado: <?php echo $r->getPagado() ?></label>
                    <label>Usuario: <?php echo $r->getUsuario() ?></label>
                    <label>PrecioH: <?php echo $r->getPrecioH() ?></label>

                </form>

            </div>