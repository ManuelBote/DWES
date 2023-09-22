<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ej6</title>
</head>
<body>
    
    <?php

        $num1 = rand(0,10);
        $num2 = rand(0,10);

        if(is_int($num1) && is_int($num2)){

            echo 'La suma de '.$num1.'+'.$num2.' es: '.$num1+$num2.'<br/>';
            echo 'La resta de '.$num1.'-'.$num2.' es: '.$num1-$num2.'<br/>';
            echo 'La multiplicacion de '.$num1.'*'.$num2.' es: '.$num1*$num2.'<br/>';
            if($num2==0){
                echo 'La division de '.$num1.'/'.$num2.' es: infinito<br/>';
                echo 'El resto de '.$num1.'%'.$num2.' es: infinito<br/>';
            } else{
                echo 'La division de '.$num1.'/'.$num2.' es: '.$num1/$num2.'<br/>';
                echo 'El resto de '.$num1.'%'.$num2.' es: '.$num1%$num2.'<br/>';
            }
            echo 'La potencia de '.$num1.'^'.$num2.' es: '.$num1**$num2.'<br/>';
    
        } else {
            echo 'Los numeros no son enteros';
        }

       
    ?>

</body>
</html>