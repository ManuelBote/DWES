<?php
    if(isset($mensaje)){
        if($mensaje[0]=='e'){
            echo ' <div class="container p-5 my-5 border"><h3 class="text-danger">'.$mensaje[1].'<h3></div>';
        } else{
            echo ' <div class="container p-5 my-5 border"><h3 class="text-success">'.$mensaje[1].'<h3></div>';
        }
    }
?>