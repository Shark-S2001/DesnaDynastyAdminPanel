<?php
     if(isset($_SERVER['HTTP_REFERER'])){
        $pos = strpos($_SERVER['HTTP_REFERER'],getenv('HTTP_HOST'));

        if($pos ===false)
            die('<h3>No Direct script access allowed!</h3>');
        
    }else{
        exit('<h3>No Direct script access allowed!</h3>');
    }

    require_once("../../config/sessions.php");
    
    if(session_destroy()){
        header("Location:https://www.desnadynastyagency.co.ke/admin");
    }

?>