<h1>FECHA Y HORA</h1>

<?php
    //Mostrar fecha actual con formato
    echo '<p>Hoy es : '.date('d/m/Y H:i').'</p>';

    //Mostrar fecha actual con formato, pero usadno la funcion time
    //que devuelve el instante actual
    echo '<p>Hoy es : '.date('d/m/Y H:i', time()).'</p>';

    //Mostrar lo que devuelve la funcion time
    //nº de segundos desde 01/01/1970 hasta ahora
    echo '<p>Retorno de la funcion time: '.time().'</p>';

    //Convertir una fecha a nº y mostrarla
    echo '<p>Ayer fue : '.date('d/m/Y H:i', strtotime('2023-09-21')).'</p>';

    //Sumar 1 dia (representado en segundos 24*60*60) al momento actual (time())
    echo '<p>Mañana será: '.date('d/m/Y H:i', time()+(24*60*60)).'</p>';

?>