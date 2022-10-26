<?php

require_once("../config/database.php");
require_once("../config/functions.php");
require_once("../config/sessions.php");

DeleteModel($conn);

 function DeleteModel($conn){
    $model_id = $_POST["id"];

    $sql ="UPDATE model SET approved=2 WHERE id =?";

    $stmt = $conn->prepare($sql);

    try{
        $conn ->beginTransaction();
        $stmt->execute(array($model_id));
        //Commit Transaction
        $conn->commit();

        $response['status'] ="Success";
        $response['message'] = "Model Deleted Successfully";

    }catch(PDOException $ex){
        //Roll back Transaction
        $conn->rollback();

        $ex->getMessage();

        $response['status'] ="Error";
        $response['message'] = "Failed to delete model";
    }

    //Return response to js
    header("Content-type:application/json;charset=UTF-8");
    echo json_encode($response);
 }


?>