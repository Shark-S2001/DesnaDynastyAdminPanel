<?php

    // define("BASEPATH",true);
    // defined('BASEPATH')OR exit('<h3>Nodirectscriptaccessallowed</h3>');


    $server ="154.12.227.14";
    $db="desnadynasty";
    $uid ="steve";
    $pwd ="Kiarithaini@7066";
    $port = 3306;

    try{
        $conn = new PDO("mysql:host=$server;dbname=$db;port=$port",$uid,$pwd); 
		
        //Set the pdo eeror to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    }catch(PDOException $e){

        throw new Exception($e->getMessage());

    }

?>