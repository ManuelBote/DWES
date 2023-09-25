<h1>FECHA Y HORA ACTUAL</h1>

<?php

    echo '<p>Hoy es : '.date('d/m/Y H:i').'</p>';
    echo '<p>Hoy es : '.date('d/m/Y H:i', time()).'</p>';

?>

<h1>FECHA Y HORA DE AYER</h1>

<?php

    echo '<p>Ayer fue : '.date('d/m/Y', strtotime('2023-09-21')).'</p>';

?>