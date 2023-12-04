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
            $correo->CharSet='UTF-8';
            $correo->Subject = "Factura Reparacion Nº".$r->getId();
            $texto = textoReparacion($r, $detalle, $propietario);
            $correo->Body = $texto;
            $correo->AltBody = 'Hola Mundo';
            $correo->addAttachment('../img/logo.png');

            //Enviar correo
            if($correo->send()){
                $resultado = true;
            }


        } catch (Exception $e) {
            echo $e->getMessage();
        }

        return $resultado;
    }

    function textoReparacion(Reparacion $r, $detalle, Propietario $propietario){
        $texto = "<div style='font-weight:bold;'>Nombre: ".$propietario->getNombre()."<br/>";
        $texto .= "DNI: ".$propietario->getDni()."</div>";
        $texto .= "<div style='font-weight:bold;'>Nº Reparacion: ".$r->getId()."<br/>";
        $texto .= "Fecha: ".date("d/m/Y",strtotime($r->getFecha()))."<br/><div>";
        $texto .= "<table border='1' width='50%' rules='all'><tr><th>Concepto</th><th>Cantidad</th><th>Precio Udad</th><th>Total</th></tr>";

        foreach($detalle as $d){
            $texto .= "<tr><td>".$d['Concepto']."</td><td>".$d['Cantidad']."</td><td>".$d['Importe']."€</td><td>".$d['Total']."€</td></tr>";
        }

        $texto .= "<tr><th colspan='3'>Total Reparacion</th><td>".$r->getImporteTotal()."€</td></tr></table>";

        return $texto;

    }

?>