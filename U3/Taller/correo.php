<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    function enviarCorreo($r, $detalle){
        $resultado = false;

        try {
            $correo = new PHPMailer(true);
            //Configurar datos del servidor saliente
            $correo->isSMTP();
            $correo->Host=('smtp.gmail.com');
            $correo->SMTPAuth=true;
            $correo->Username='mbotez01@educarex.es';
            $correo->Password='';

        } catch (Exception $e) {
            echo $e->getMessage();
        }

        return $resultado;
    }

?>