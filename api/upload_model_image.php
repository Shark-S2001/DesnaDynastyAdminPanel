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
   
     //Change to Session
     $id_number = clean_input($_POST["id_number"]);

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
    

    uploadImage($conn,$id_number);
  
    function uploadImage($conn,$id_number){
            if(0<$_FILES['file']['error']){

                $response["status"] = "error";
                $response["message"] ="Error Uploading Model Image";
                echo "Error:".$_FILES['file']['error'].'<br/>';

            }else{
                if(checkIfModelExist($conn,$id_number)){
                    $response["status"] = "error";
                    $response["message"] ="Model Already Exists";

                    echo json_encode($response);
                    exit();

                }else{
                    $filename = rename_image($_FILES['file']['name'],$id_number);
                    
                    $_SESSION["model_image_path"] = $filename;

                    if(move_uploaded_file($_FILES['file']['tmp_name'],$_SESSION['path'].'/'.'images/models/'.$filename)){
                        $response["status"] = "success";
                        $response["message"] ="Model Image Uploaded Successfully";
                    }else{
                        $response["status"] = "error";
                        $response["message"] ="Error Occurred while uploading image";
                    }
                    
                }
                echo json_encode($response);
            }          
        
    }

?>