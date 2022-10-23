<?php
    if(isset($_SERVER['HTTP_REFERER'])){
        $pos = strpos($_SERVER['HTTP_REFERER'],getenv('HTTP_HOST'));

    if($pos ===false)
        die('<h3>No Direct script access allowed!</h3>');
    
    }else{
        exit('<h3>No Direct script access allowed!</h3>');
    }

    require_once("../config/database.php");
    require_once("../config/functions.php");
    require_once("../config/sessions.php");

    saveTestimony($conn);
    

    function saveTestimony($conn){
        $response = array();
        $client_title =clean_input($_POST["client_title"]);
        $client_name = clean_input($_POST["client_name"]);
        $testimony_heading = clean_input($_POST["testimony_heading"]);
        $testimony_body = clean_input($_POST["testimony_body"]);


        $sql = "INSERT INTO testimony(client_title,client_name,testimony_heading,testimony_body)VALUES(?,?,?,?)";
        $stmt = $conn->prepare($sql);

    try{
        $conn ->beginTransaction();
        $stmt->execute(array($client_title,$client_name,$testimony_heading,$testimony_body));
        //Commit Transaction
        $conn->commit();

        $response['status'] ="Success";
        $response['message'] = "Testimony Saved Successfully";

    }catch(PDOException $ex){
        //Roll back Transaction
        $conn->rollback();

        $ex->getMessage();

        $response['status'] ="Error";
        $response['message'] = "Failed to Save Testimony";
    }

    //Return response to js
    header("Content-type:application/json;charset=UTF-8");
    echo json_encode($response);
}

?>