<?php
//Ver si hay usuario logueado
session_start();
$us = null;
if (isset($_SESSION['usuario'])) {
  $us = $_SESSION['usuario'];
} else {
  //Redirigir a login
  header('location:../Usuario/login.php');
}
?>
<!-- Grey with black text -->
<nav class="navbar navbar-expand-sm bg-light navbar-light">
  <div class="container-fluid">
    <ul class="navbar-nav">
      <?php
      if ($us->getPerfil() == 'A') {
        echo '<li class="nav-item">
                <a class="nav-link active" href="../Usuario/cUsuario.php">Usuarios</a>
              </li>';
      }
      ?>
      <li class="nav-item">
        <a class="nav-link active" href="../Pieza/cPieza.php">Piezas</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="../Cliente/cCliente.php">Clientes</a>
      </li>
      <?php
      if ($us->getPerfil() == 'M') {
        echo '<li class="nav-item">
                <a class="nav-link active" href="../Reparacion/cReparacion.php">Reparaciones</a>
              </li>';
      }
      ?>
    </ul>

    <ul class="navbar-nav ms-auto">
      <li class="nav-item">
        <span class="nav-link"><?php echo $us->getNombre() ?></span>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="../Usuario/login.php?accion=cerrar">Salir</a>
      </li>
    </ul>
  </div>
</nav>