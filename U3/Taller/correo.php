<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require_once '../../../vendor/autoload.php';

    function enviarCorreo(Modelo $bd, $r, $detalle, Propietario $propietario){
        $resultado = false;

        try {
            $correo = new PHPMailer(true);
            //Configurar datos del servidor saliente
            $correo->isSMTP();
            $correo->Host=('smtp.gmail.com');
            $correo->SMTPAuth=true;
            $correo->Username='mbotez01@educarex.es';
            $correo->Password='';
            $correo->SMTPSecure= PHPMailer::ENCRYPTION_SMTPS;
            $correo->Port=465;
            //$correo->CharSet = 'UTF-8';
            
            //Configuracion del correo que vamos a escribir
            $correo->setFrom('mbotez01@educarex.es', 'Manuel');
            $correo->addAddress($propietario->getEmail(), $propietario->getNombre());

            //Configuracion del contenido del mensaje
            $correo->isHTML(true);
            $correo->Subject = "Factura Reparacion Nº".$r->getId();
            $correo->Body = '<h1>Hola Mundo</h1>';
            $correo->AltBody = '<h1>Hola Mundo</h1>';

            //Enviar correo
            if($correo->send()){
                $resultado = true;
            }


        } catch (Exception $e) {
            echo $e->getMessage();
        }

        return $resultado;
    }

?>