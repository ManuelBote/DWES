<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario</title>
</head>
<body>

    <?php

        echo '<h1>TRATAMIENTO DE FORMULARIO EJERCICIO 14</h1>';

        //Comprobar si se llama por POST
        if(isset($_POST['validar'])){

            //Chequear que todos los campos se han rellenado
        if(empty($_POST['nombre']) or empty($_POST['apellido']) or empty($_POST['ps']) or empty($_POST['fechaN']) or
        empty($_FILES['foto']['name']) or empty($_POST['Comentario']) or !isset($_POST['aficc'])){

            echo'<h3 style="color:red">Debes rellenar todos los campos</h3>';
         }
        } elseif(isset($_POST['enviar'])){

            //Mostrar los valores de los campos de mi formulario
            echo '<div>Nombre: '.$_POST['nombre'].'</div>';
            echo '<div>Apellidos: '.$_POST['apellido'].'</div>';
            echo '<div>Constraseña: '.$_POST['ps'].'</div>';
            echo '<div>Sexo: '.$_POST['sexo'].'</div>';
            //Fecha de nacimiento con el formato HTML yyyy-mm-dd
            echo '<div>Fecha nacimiento: '.$_POST['fechaN'].'</div>';
            //Fecha de nacimiento con formato dd-mm-yyyy
            $fecha = strtotime($_POST['fechaN']); //Convertir en texto a fecha
            echo '<div>Fecha Nacimiento: '.date('d/m/Y',$fecha).'</div>';
            echo '<div>Pais: ';
                foreach($_POST['pais'] as $p){
                    echo $p." ";
                }
            echo '</div>';
            echo '<div>Número de hijos: '.$_POST['nHijos'].'</div>';
            echo '<div>Foto: '.$_FILES['foto']['name'].'</div>';
            echo '<div>Aficciones: ';
                foreach($_POST['aficc'] as $a){
                    echo $a." ";
                }
            echo '</div>';
            echo '<div>Comentario: '.$_POST['Comentario'].'</div>'; 

            //Subir foto
            if(isset($_FILES['foto'])){
                //Copiar el fichero subido en una carpeta del sitio web
                $ficheroDestino ='img/'.$_FILES['foto']['name'];
                if(move_uploaded_file($_FILES['foto']['tmp_name'],$ficheroDestino)){
                    //Pintar imagen subida
                    echo '<img src="'.$ficheroDestino.'">';
                }

            } else{
                echo'<h3 style="color:red">Se ha producido un error en la foto</h3>';
            }


        } else{
            echo'<h3 style="color:red">Error en metodo de llamada</h3>';
        }

       

    ?>

</body>
</html>