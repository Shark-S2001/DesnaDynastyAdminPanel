$(document).ready(function(){
    $("#save_slider").click(function(e){
        e.preventDefault();

        if(validateInputs()){
             //Show Progress
           $("#save_slider").hide(); //hide add button
           $("#LoadingImage").show(); //show loading image
           UploadSlider();
        }
        

    });
})

function UploadSlider(){
    var file_data = $("#slider_image").prop('files')[0];

    var form_data = new FormData();
    
    if(validateInputs()){
        form_data.append('file',file_data);
        $.ajax({
            url:"../api/upload_slider.php",
            dataType: 'json',
            cache:false,
            contentType:false,
            processData:false,
            data:form_data,
            type:'POST',
            success:function(response){
                if(response.status == "success"){
                    $("#save_slider").show(); //show delete button
                    $("#LoadingImage").hide(); //hide loading image
                    //alert(response.message);
                    Toastify({
                        text: response.message,
                        backgroundColor: "linear-gradient(to right, #22E910, #055C05)",
                        className: "error",
                    }).showToast();
                    cleartextboxes()
                }else{
                    $("#save_slider").show(); //show delete button
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
function cleartextboxes() {
    $("#slider_image").val('');
}
//Validate Slider form
function validateInputs() {
    if ($('#slider_image')[0].files.length === 0) {

        $.notify("Please attach a Slider!", "error");
        return false;
        
    }else if(!validatePhotoSelected()){
        
        $.notify("Invalid file type, photo must be an image!", "error");
        return false;
    }else {
        return true;
    }
}

/*
 * Ensure the selected image is in the correct format
 */

function validatePhotoSelected() {
    var file = $('#slider_image')[0].files[0]

    if (file == undefined) {
        $.notify("Latest Image is required", "error");
        return false;
    }

    var fileType = file.type; // holds the file types
    var validExtensions = ['jpg','png','jpeg']; //array of valid extensions
    var fileSize = file.size; // holds the file size
    var maxSize = 10 * 1024 * 1024; // defined the file max size
    
    var fileNameExt = $('#slider_image').val().split('.').pop().toLowerCase();
    if ($.inArray(fileNameExt, validExtensions) == -1){
        return false;
    }else{
        return true;
    }

   
    // Checking the defined image size
    if (fileSize > maxSize) {
         $.notify("Photo Cannot exceed 10Mb !", "error");
        $('#slider_image').val('');
        return false;
    }
}