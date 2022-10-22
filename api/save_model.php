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

    saveModel($conn);
    
    function checkIfModelExist($conn,$id_number){
        $model_exist = false;

        $stmt = $conn->prepare("SELECT * FROM model WHERE id_number='$id_number'");
        $stmt->execute();
        $data = $stmt->fetch();
    
        if(!empty($data)){
            $model_exist = true;
        }
    
        return $model_exist;
    }
    
    function saveModel($conn){
        $response = array();
        $model_name =clean_input($_POST["name"]);
        $height = clean_input($_POST["height"]);
        $bust = clean_input($_POST["bust"]);
        $waist = clean_input($_POST["waist"]);
        $hips = clean_input($_POST["hips"]);
        $shoe_size = clean_input($_POST["shoe_size"]);
        $about_model = clean_input($_POST["about_model"]);
        $id_number = clean_input($_POST["id_number"]);
        $image_path =  $_SESSION["model_image_path"];
        $_SESSION["id_number"] = $id_number;

        if(checkIfModelExist($conn,$id_number)){
            $response["status"] = "error";
            $response["message"] ="Model Already Exists";
           
             //Return response to js
             header("Content-type:application/json;charset=UTF-8");
             echo json_encode($response);

             exit();
        }{
            $sql = "INSERT INTO model(model_name,height,bust,waist,hips,shoe_size,about_model,id_number,image_path)VALUES(?,?,?,?,?,?,?,?,?)";
            $stmt = $conn->prepare($sql);
    
            try{
                $conn ->beginTransaction();
                $stmt->execute(array($model_name,$height,$bust,$waist,$hips,$shoe_size,$about_model,$id_number,$image_path));
                //Commit Transaction
                $conn->commit();
        
                $response['status'] ="Success";
                $response['message'] = "Model Saved Successfully";
        
            }catch(PDOException $ex){
                //Roll back Transaction
                $conn->rollback();
        
                $ex->getMessage();
        
                $response['status'] =$image_path ;
                $response['message'] = "Failed to Save Model";
            }
            //Return response to js
            header("Content-type:application/json;charset=UTF-8");
            echo json_encode($response);
        }

}


?>