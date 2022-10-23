$(document).ready(function(){
    $("#save_event").click(function(e){
        e.preventDefault();
        
        if(validateInputs()==true){
           //Show Progress
           $("#save_event").hide(); //hide add button
           $("#LoadingImage").show(); //show loading image
            UploadEventImage();
        }
    });
})


function saveEvent(){
    var event_title = $("#event_title").val();
    var event_place = $("#event_place").val();
    var event_body = $("#event_body").val();
    var  event_date = $("#event_date").val();
    if(validateInputs()){
        $.ajax({
            url: "../api/save_event.php",
            method: "POST",
            dataType:"json",
            data:{
                event_title:event_title,
                event_place:event_place,
                event_body:event_body,
                event_date:event_date,
            },
            success:function(response){
                if(response.status=="Success"){
                    $("#save_event").show(); //show delete button
                    $("#LoadingImage").hide(); //hide loading image
                    //alert(response.message);
                    Toastify({
                        text: response.message,
                        backgroundColor: "linear-gradient(to right, #22E910, #055C05)",
                        className: "error",
                    }).showToast();
                    cleartextboxes()
                }else{
                    $("#save_event").show(); //show delete button
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

function UploadEventImage(){
    var file_data = $("#event_image").prop('files')[0];

    var form_data = new FormData();
    
    form_data.append('file',file_data);
    $.ajax({
        url:"../api/upload_event_image.php",
        dataType: 'json',
        cache:false,
        contentType:false,
        processData:false,
        data:form_data,
        type:'POST',
        success:function(response){
            saveEvent();

        },error:function(xhr,ajaxOptions,thrownError){
            $("#save_event").show(); //show delete button
            $("#LoadingImage").hide(); //hide loading image
            //alert("Error Uploading Image");
            Toastify({
                text: "Failed to Upload image",
                backgroundColor: "linear-gradient(to right, #E94D10, #F029CF)",
                className: "error",
              }).showToast();
        }
    })
}
function cleartextboxes() {
    $("input[type='text']").val("");
    $("#event_title").val('')
    $("#event_place").val('');
    $("#event_body").val('');
    $("#event_image").val('');
    $("#event_date").val('');
}
//Validate Events form
function validateInputs() {
    if ($('#event_title').val() == '') {

        $.notify("Event Title is required!", "error");
        return false;

    } else if ($('#event_place').val() == '') {

        $.notify("Place is required!", "error");
        return false;
    }else if ($('#event_body').val() == '') {

        $.notify("Event Body is required!", "error");
        return false;
    }else if ($('#event_date').val() == '') {
        
        $.notify("Event Date is required!", "error");
        return false;
    }else if(!validatePhotoSelected()){
        
        $.notify("Invalid file type, photo must be an image!", "error");
        return false;
    }
    else if ($('#event_image')[0].files.length === 0) {

        $.notify("Please attach an Image!", "error");
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
    var file = $('#event_image')[0].files[0]

    if (file == undefined) {
        $.notify("Latest Image is required", "error");
        return false;
    }

    var fileType = file.type; // holds the file types
    var validExtensions = ['jpg','png','jpeg']; //array of valid extensions
    var fileSize = file.size; // holds the file size
    var maxSize = 10 * 1024 * 1024; // defined the file max size
    
    var fileNameExt = $('#event_image').val().split('.').pop().toLowerCase();
    if ($.inArray(fileNameExt, validExtensions) == -1){
        return false;
    }else{
        return true;
    }

   
    // Checking the defined image size
    if (fileSize > maxSize) {
         $.notify("Photo Cannot exceed 10Mb !", "error");
        $('#event_image').val('');
        return false;
    }
}