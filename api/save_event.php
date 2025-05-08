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

    saveEvent($conn);

    function saveEvent($conn){
        $response = array();
        $event_title =clean_input($_POST["event_title"]);
        $event_place = clean_input($_POST["event_place"]);
        $event_body = clean_input($_POST["event_body"]);
        $event_date = clean_input($_POST["event_date"]);
        $image_path = $_SESSION["event_image_path"];
        //$_SESSION["id_number"] = $id_number;

        $myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
        fwrite($myfile, "File Name: " .$image_path);
        fclose($myfile);

        $sql = "INSERT INTO events(events_title,events_place,events_body,event_date,image_path)VALUES(?,?,?,?,?)";
        $stmt = $conn->prepare($sql);

    try{
        $conn ->beginTransaction();
        $stmt->execute(array($event_title,$event_place,$event_body,$event_date,$image_path));
        //Commit Transaction
        $conn->commit();

        $response['status'] ="Success";
        $response['message'] = "Event Saved Successfully";

    }catch(PDOException $ex){
        //Roll back Transaction
        $conn->rollback();

        $ex->getMessage();

        $response['status'] ="Error";
        $response['message'] = "Failed to Save Event";
    }

    //Return response to js
    header("Content-type:application/json;charset=UTF-8");
    echo json_encode($response);
}

?>