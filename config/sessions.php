<?php

    if(getcwd()==dirname(__FILE__)){
        die('<h3>No Direct scripts access allowed</h3>');
    }
    
    if(!session_id()){
        session_start();
    }


?>