$(document).ready(function(){
    $("#save_blog").click(function(e){
        e.preventDefault();
        
        if(validateInputs()==true){
              //Show Progress
              $("#save_blog").hide(); //hide add button
              $("#LoadingImage").show(); //show loading image
            UploadBlogImage();
        }
        // alert("Clicked");
        

    });
})


function saveBlog(){
    var blog_title = $("#blog_title").val();
    var blog_subject = $("#blog_subject").val();
    var blog_body = $("#blog_body").val();
    if(validateInputs()){
        $.ajax({
            url: "../api/save_blog.php",
            method: "POST",
            dataType:"json",
            data:{
                blog_title:blog_title,
                blog_subject:blog_subject,
                blog_body:blog_body,
            },
            success:function(response){
                if(response.status=="Success"){
                    $("#save_blog").show(); //show delete button
                    $("#LoadingImage").hide(); //hide loading image
                    //alert(response.message);
                    Toastify({
                        text: response.message,
                        backgroundColor: "linear-gradient(to right, #22E910, #055C05)",
                        className: "error",
                    }).showToast();
                    cleartextboxes()
                }else{
                    $("#save_blog").show(); //show delete button
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

function UploadBlogImage(){
    var file_data = $("#blog_image").prop('files')[0];

    var form_data = new FormData();
    
    form_data.append('file',file_data);
    $.ajax({
        url:"../api/upload_blog_image.php",
        dataType: 'json',
        cache:false,
        contentType:false,
        processData:false,
        data:form_data,
        type:'POST',
        success:function(response){
            saveBlog();
           

        },error:function(xhr,ajaxOptions,thrownError){

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
    $("#blog_title").val('');
    $("#blog_subject").val('');
    $("#blog_body").val('');
    $("#blog_image").val('');
}
//Validate Blog form
function validateInputs() {
    if ($('#blog_title').val() == '') {

        $.notify("Blog Title is required!", "error");
        return false;

    } else if ($('#blog_subject').val() == '') {

        $.notify("Subject is required!", "error");
        return false;
    }else if ($('#blog_body').val() == '') {

        $.notify("Blog Body is required!", "error");
        return false;
    }else if(!validatePhotoSelected()){
        
        $.notify("Invalid file type, photo must be an image!", "error");
        return false;
    }else if ($('#blog_image')[0].files.length === 0) {

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
    var file = $('#blog_image')[0].files[0]

    if (file == undefined) {
        $.notify("Your latest Image is required", "error");
        return false;
    }

    var fileType = file.type; // holds the file types
    var validExtensions = ['jpg','png','jpeg']; //array of valid extensions
    var fileSize = file.size; // holds the file size
    var maxSize = 10 * 1024 * 1024; // defined the file max size
    
    var fileNameExt = $('#blog_image').val().split('.').pop().toLowerCase();
    if ($.inArray(fileNameExt, validExtensions) == -1){
        return false;
    }else{
        return true;
    }

   
    // Checking the defined image size
    if (fileSize > maxSize) {
         $.notify("Photo Cannot exceed 10Mb !", "error");
        $('#blog_image').val('');
        return false;
    }
}