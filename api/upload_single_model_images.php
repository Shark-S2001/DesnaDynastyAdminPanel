<?php
    if(isset($_SERVER['HTTP_REFERER'])){
        $pos = strpos($_SERVER['HTTP_REFERER'],getenv('HTTP_HOST'));

    if($pos ===false)
        die('<h3>No Direct script access allowed!</h3>');

    }else{
        exit('<h3>No Direct script access allowed!</h3>');
    }

    require_once("../config/sessions.php");
    require_once("../config/functions.php");
   
   
    $response = array();
    //Count total files
    $countphotos =count($_FILES['files']['name']);

    /*Store number of uploaded files in a session */

    $_SESSION['no_of_images']= $countphotos;

    //Upload Directory
    $upload_location = "../../images/single_model_photos/";

    //To Store uploaded files path
    $files_arr = array();

    //Get applicant's IDNumber
    $id_number = $_POST['id_number'];

    //Store it in a session

    if(!isset($_SESSION['id_number'])){
        $_SESSION['id_number'] = $id_number;
    }

    if(0<$_FILES['files']['name']['error']){

        $response["status"] = "error";
        $response["message"] ="Error Uploading Photos";
        // echo "Error:".$_FILES['files']['error'].'<br/>';

    }else{
        //loop all images
        for($index=0; $index < $countphotos; $index++){
            if(isset($_FILES['files']['name'][$index])&&$_FILES['files']['name'][$index] !=''){
                //filename
                $filename = rename_image($_FILES['files']['name'][$index],$id_number);

                //Save the photos in an array
                $_SESSION['photos'][]=$filename;

                //Get Extension
                $ext = strtolower(pathinfo($filename,PATHINFO_EXTENSION));

                //Valid image extension
                $valid_ext = array('jpg');
                
                //Check extension
                if(in_array($ext,$valid_ext)){
                    //filepath
                    $path = $upload_location.$filename;

                    //upload Photos
                    if(move_uploaded_file($_FILES['files']['tmp_name'][$index],$path)){
                        
                        $files_arr[] = $path;
                        
                        $response["status"] = "success";
                        $response["message"] ="Photo Uploaded Successfully";
                    }else{
                        $response["status"] = "error";
                        $response["message"] ="Error Occurred while uploading image";
                    }
                }
            }
        }
        $response['status']="success";
        $response["message"] = "Photos Uploaded Successfully";

    }

     //Return response to js
     header("Content-type:application/json;charset=UTF-8");
     echo json_encode($response);

?>