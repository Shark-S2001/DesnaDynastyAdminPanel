<?php

        // define("BASEPATH",true);
        // defined('BASEPATH')OR exit('<h3>Nodirectscriptaccessallowed</h3>');


    $server ="172.104.187.96";
    $db="ddmodels";
    $uid ="root";
    $pwd ="Kiarithaini";
    $port = 3308;

    try{
        $conn = new PDO("mysql:host=$server;dbname=$db;port=$port",$uid,$pwd); 
		
        //Set the pdo eeror to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    }catch(PDOException $e){

        throw new Exception($e->getMessage());

    }

?>