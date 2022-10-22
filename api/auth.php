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

userLogin($conn);

function userLogin($conn){
    $response = array();
    $user_email = clean_input($_POST["user_email"]);
    $user_password = clean_input($_POST["user_password"]);

    $sql = "SELECT username,email,password FROM user WHERE username=? AND password=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute(array($user_email,$user_password));
    $row =  $stmt->rowCount();
    $data=$stmt->fetch();

    if($row>0){
        $response['status']="Success";

        $_SESSION["user"] = $data["username"];

        $response['message']="Successfully logged In";
    }else{
        $response['status'] ="Error";

        $response['message']="An error occured while logging in";
    }

    //Return response to js
    header("Content-type:application/json;charset=UTF-8");
    echo json_encode($response);
}   

function userRegistation(){
    
}

?>