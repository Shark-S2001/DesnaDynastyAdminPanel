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

    saveBlog($conn);
    

    function saveBlog($conn){
        $response = array();
        $blog_title =clean_input($_POST["blog_title"]);
        $blog_subject = clean_input($_POST["blog_subject"]);
        $blog_body = clean_input($_POST["blog_body"]);
        $image_path = $_SESSION["blog_image_path"];
        //$_SESSION["id_number"] = $id_number;

        $myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
        fwrite($myfile, "File Name: " .$image_path);
        fclose($myfile);

        $sql = "INSERT INTO blog(blog_title,blog_subject,blog_body,image_path)VALUES(?,?,?,?)";
        $stmt = $conn->prepare($sql);

    try{
        $conn ->beginTransaction();
        $stmt->execute(array($blog_title,$blog_subject,$blog_body, $image_path));
        //Commit Transaction
        $conn->commit();

        $response['status'] ="Success";
        $response['message'] = "Blog Saved Successfully";

    }catch(PDOException $ex){
        //Roll back Transaction
        $conn->rollback();

        $ex->getMessage();

        $response['status'] ="Error";
        $response['message'] = "Failed to Save Blog";
    }

    //Return response to js
    header("Content-type:application/json;charset=UTF-8");
    echo json_encode($response);
}

?>