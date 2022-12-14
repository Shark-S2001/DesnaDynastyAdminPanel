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
   

    uploadSlider();
  
    function uploadSlider(){
        $response = array();
        //Change to Session
        $current_timestamp = time();

        if(0<$_FILES['file']['error']){

            $response["status"] = "error";
            $response["message"] ="Error Uploading Slider";
            echo "Error:".$_FILES['file']['error'].'<br/>';

        }else{

            $filename = rename_image($_FILES['file']['name'],$current_timestamp);
            if(move_uploaded_file($_FILES['file']['tmp_name'],$_SESSION['path'].'/'.'sliders/'.$filename)){
                $response["status"] = "success";
                $response["message"] ="Slider Uploaded Successfully";
            }else{
                $response["status"] = "error";
                $response["message"] ="Error Occurred while uploading image";
            }
        }

        //Return response to js
        header("Content-type:application/json;charset=UTF-8");
        echo json_encode($response);
    }

?>