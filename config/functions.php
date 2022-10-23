<?php

    function clean_input($data){
        $data = trim($data);
        $data=stripcslashes($data);
        $data=htmlspecialchars($data);

        return $data;
    }

    function rename_image($filename,$id_number){

        $file = explode(".",$filename);
        $image_name = str_replace("_","-",$file[0]);
        //Remove underscore(_) if any

        $image_ext = $file[1];

        $new_filename = $image_name."_".$id_number.".".$image_ext;

        return $new_filename;
    }
    
    function calculateAge($start_date,$end_date){
        $date1 = new DateTime($start_date);
        $date2 = new DateTime($end_date);
        $interval = $date1->diff($date2);
    
        return $interval->y; 
    }
    
?>