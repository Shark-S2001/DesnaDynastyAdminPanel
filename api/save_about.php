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

    saveAbout($conn);
    

    function saveAbout($conn){
        $response = array();
        $about_title =clean_input($_POST["about_title"]);
        $aboutus_body = clean_input($_POST["aboutus_body"]);

        //$_SESSION["id_number"] = $id_number;

        $sql = "INSERT INTO about(about_title,aboutus_body)VALUES(?,?)";
        $stmt = $conn->prepare($sql);

    try{
        $conn ->beginTransaction();
        $stmt->execute(array($about_title,$aboutus_body));
        //Commit Transaction
        $conn->commit();

        $response['status'] ="Success";
        $response['message'] = "About Us Saved Successfully";

    }catch(PDOException $ex){
        //Roll back Transaction
        $conn->rollback();

        $ex->getMessage();

        $response['status'] ="Error";
        $response['message'] = "Failed to Save About Us";
    }

    //Return response to js
    header("Content-type:application/json;charset=UTF-8");
    echo json_encode($response);
}

?>