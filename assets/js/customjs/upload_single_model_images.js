$(document).ready(function(){
    $("#model_images").click(function(e){
        e.preventDefault();
        if(validateInputs()){
             //Show Progress
           $("#model_images").hide(); //hide add button
           $("#LoadingImage").show(); //show loading image
            uploadImages();
        }
       
    })
})

function uploadImages(){
    var id_number = $("#id_number").val();
    //Forusein name uploaded images

    var form_data = new FormData();
    form_data.append("id_number",id_number);

    var totalimages = document.getElementById('single_model_images').files.length;

    for(var index = 0; index < totalimages; index++){
        form_data.append("files[]",document.getElementById("single_model_images").files[index]);
    }
    if(validateInputs()){
        $.ajax({
            url:"../api/upload_single_model_images.php",
            dataType: "text",
            cache:false,
            contentType:false,
            processData:false,
            data: form_data,
            type:"POST",
            success:function(response){
                if(response.status=="success"){
                    $("#model_images").show(); //show delete button
                    $("#LoadingImage").hide(); //hide loading image
                    //alert("Images Uploaded Successfully");
                    Toastify({
                        text: "Images Uploaded Successfully",
                        backgroundColor: "linear-gradient(to right, #22E910, #055C05)",
                        className: "error",
                    }).showToast();
                    cleartextboxes()
                }else{
                    $("#model_images").show(); //show delete button
                    $("#LoadingImage").hide(); //hide loading image
                    //alert("Failed to Upload images");
                    Toastify({
                        text: "Failed to Upload images",
                        backgroundColor: "linear-gradient(to right, #E94D10, #F029CF)",
                        className: "error",
                    }).showToast();
                }
            }
        })
    }
}

function cleartextboxes() {
    $("input[type='text']").val("");
    $("#id_number").val('');
    $("#single_model_images").val('');
}
//Validate Model form
function validateInputs() {
    if ($('#id_number').val() == '') {

        $.notify("ID Number is required!", "error");
        return false;

    } else if ($('#single_model_images')[0].files.length === 0) {

        $.notify("Please attach an Image!", "error");
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
    var file = $('#single_model_images')[0].files[0]

    if (file == undefined) {
        $.notify("Latest Image is required", "error");
        return false;
    }

    var fileType = file.type; // holds the file types
    var validExtensions = ['jpg','png','jpeg']; //array of valid extensions
    var fileSize = file.size; // holds the file size
    var maxSize = 10 * 1024 * 1024; // defined the file max size
    
    var fileNameExt = $('#single_model_images').val().split('.').pop().toLowerCase();
    if ($.inArray(fileNameExt, validExtensions) == -1){
        return false;
    }else{
        return true;
    }

   
    // Checking the defined image size
    if (fileSize > maxSize) {
         $.notify("Photo Cannot exceed 10Mb !", "error");
        $('#single_model_images').val('');
        return false;
    }
}