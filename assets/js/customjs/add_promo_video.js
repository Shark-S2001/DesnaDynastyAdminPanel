$(document).ready(function(){
    $("#submit_video").click(function(e){
        if(validateInputs()==true){
            //Show Progress
           $("#submit_video").hide(); //hide add button
           $("#LoadingImage").show(); //show loading image
            UploadPromoVideo();
        }
    })
})


function UploadPromoVideo(){
    var file_data = $("#promo_video").prop('files')[0];

    if(validateInputs()){
        var form_data = new FormData();
        form_data.append('file',file_data);
        $.ajax({
            url:"../api/upload_promo_videos.php",
            dataType: 'json',
            cache:false,
            contentType:false,
            processData:false,
            data:form_data,
            type:'POST',
            success:function(response){
                if(response.status=="success"){
                    $("#submit_video").show(); //show delete button
                    $("#LoadingImage").hide(); //hide loading image
                    //alert(response.message);
                    Toastify({
                        text: response.message,
                        backgroundColor: "linear-gradient(to right, #22E910, #055C05)",
                        className: "error",
                    }).showToast();
                    cleartextboxes();
                }else{
                    $("#submit_video").show(); //show delete button
                    $("#LoadingImage").hide(); //hide loading image
                // alert(response.message);
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
    $("#promo_video").val('');
}
//Validate Promo Video form
function validateInputs() {
  if ($('#promo_video')[0].files.length === 0) {

        $.notify("Please attach a Video!", "error");
        return false;
        
    }else if(!validatePhotoSelected()){
        
        $.notify("Invalid file type, photo must be an image!", "error");
        return false;
    } else {
        return true;
    }
}

/*
 * Ensure the selected image is in the correct format
 */

function validatePhotoSelected() {
    var file = $('#promo_video')[0].files[0]

    if (file == undefined) {
        $.notify("Latest Video is required", "error");
        return false;
    }

    var fileType = file.type; // holds the file types
    var validExtensions = ['MP4','webm','avi']; //array of valid extensions
    var fileSize = file.size; // holds the file size
    var maxSize = 25 * 1024 * 1024; // defined the file max size
    
    var fileNameExt = $('#promo_video').val().split('.').pop().toLowerCase();
    if ($.inArray(fileNameExt, validExtensions) == -1){
        return false;
    }else{
        return true;
    }

   
    // Checking the defined image size
    if (fileSize > maxSize) {
         $.notify("Photo Cannot exceed 10Mb !", "error");
        $('#promo_video').val('');
        return false;
    }
}