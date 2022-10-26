$(document).ready(function(){
    $("#submit_testimony").click(function(e){
        e.preventDefault();
        
        if(validateInputs()==true){
             //Show Progress
           $("#submit_testimony").hide(); //hide add button
           $("#LoadingImage").show(); //show loading image
            saveTestimony();
        }
        
 
    });
})


function saveTestimony(){
    var client_title = $("#client_title").val();
    var client_name = $("#client_name").val();
    var testimony_heading = $("#testimony_heading").val();
    var testimony_body = $("#testimony_body").val();

    if(validateInputs()){
        $.ajax({
            url: "../api/add_testimony.php",
            method: "POST",
            dataType:"json",
            data:{
                client_title:client_title,
                client_name:client_name,
                testimony_heading:testimony_heading,
                testimony_body:testimony_body

            },
            success:function(response){
                if(response.status=="Success"){
                    $("#submit_testimony").show(); //show delete button
                    $("#LoadingImage").hide(); //hide loading image
                    UploadTestimonyImage();
                    //alert(response.message);
                    Toastify({
                        text: response.message,
                        backgroundColor: "linear-gradient(to right, #22E910, #055C05)",
                        className: "error",
                    }).showToast();
                    cleartextboxes()
                }else{
                    $("#submit_testimony").show(); //show delete button
                    $("#LoadingImage").hide(); //hide loading image
                    //alert(response.message);
                    Toastify({
                        text: response.message,
                        backgroundColor: "linear-gradient(to right, #E94D10, #F029CF)",
                        className: "error",
                    }).showToast();
                }
            }
        })
    }
}

function UploadTestimonyImage(){
    var file_data = $("#client_photo").prop('files')[0];

    var form_data = new FormData();
    
    form_data.append('file',file_data);
    $.ajax({
        url:"../api/upload_testimonial_image.php",
        dataType: 'json',
        cache:false,
        contentType:false,
        processData:false,
        data:form_data,
        type:'POST',
        success:function(response){


        },error:function(xhr,ajaxOptions,thrownError){

            //alert("Error Uploading Image");
            Toastify({
                text: "Error Uploading Image",
                backgroundColor: "linear-gradient(to right, #E94D10, #F029CF)",
                className: "error",
              }).showToast();
        }
    })
}
function cleartextboxes() {
    $("input[type='text']").val("");
    $("#client_title").val('');
    $("#client_name").val('');
    $("#testimony_heading").val('');
    $("#testimony_body").val('');
    $("#client_photo").val('');
}

//Validate Models form
function validateInputs() {
    if ($('#client_title').val() == '') {

        $.notify("Client Title is required!", "error");
        return false;

    } else if ($('#client_name').val() == '') {

        $.notify("Client Name is required!", "error");
        return false;
    }else if ($('#testimony_heading').val() == '') {

        $.notify("Heading is required!", "error");
        return false;
    }else if ($('#testimony_body').val() == '') {

        $.notify("Testimony Body is required!", "error");
        return false;
    }else if ($('#client_photo')[0].files.length === 0) {

        $.notify("Please attach Client's Image!", "error");
        return false;
    }else if(!validatePhotoSelected()){
        
        $.notify("Invalid file type, photo must be an image!", "error");
        return false;
    } 
     else {
        return true;
    }
}

/*
 * Ensure the selected image is in the correct format
 */

function validatePhotoSelected() {
    var file = $('#client_photo')[0].files[0]

    if (file == undefined) {
        $.notify("Latest Image is required", "error");
        return false;
    }

    var fileType = file.type; // holds the file types
    var validExtensions = ['jpg','png','jpeg']; //array of valid extensions
    var fileSize = file.size; // holds the file size
    var maxSize = 10 * 1024 * 1024; // defined the file max size
    
    var fileNameExt = $('#client_photo').val().split('.').pop().toLowerCase();
    if ($.inArray(fileNameExt, validExtensions) == -1){
        return false;
    }else{
        return true;
    }

   
    // Checking the defined image size
    if (fileSize > maxSize) {
         $.notify("Photo Cannot exceed 10Mb !", "error");
        $('#client_photo').val('');
        return false;
    }
}