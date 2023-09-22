<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ej11</title>
</head>
<body>

    <?php

        $array=array();

        for($num=0;$num<11;$num++){
            $array[$num]=$num**2;
        }

        foreach($array as $x=>$total){
            echo $x.'^2: '.$total.'<br/>';
        }

    ?>
    
</body>
</html>