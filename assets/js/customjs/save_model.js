$(document).ready(function(){
    
    $("#save_model").click(function(e){
        e.preventDefault();
        
        if(validateInputs()===true){
           
            //Show Progress
           $("#save_model").hide(); //hide add button
           $("#LoadingImage").show(); //show loading image
            UploadImage();
        }
    });
})


function saveModel(){
    var model_name = $("#name").val();
    var height = $("#height").val();
    var bust = $("#bust").val();
    var waist = $("#waist").val();
    var hips = $("#hips").val();
    var shoe_size = $("#shoe_size").val();
    var about_model = $("#about_model").val();
    var id_number = $("#id_number").val();

    if(validateInputs()){
        $.ajax({
            url: "../api/save_model.php",
            method: "POST",
            dataType:"json",
            data:{
                name:model_name,
                height:height,
                bust:bust,
                waist:waist,
                hips:hips,
                shoe_size:shoe_size,
                about_model:about_model,
                id_number:id_number
            },
            success:function(response){
                if(response.status=="Success"){
                    $("#save_model").show(); //show delete button
                    $("#LoadingImage").hide(); //hide loading image
                    //alert(response.message);
                    Toastify({
                        text: response.message,
                        backgroundColor: "linear-gradient(to right, #22E910, #055C05)",
                        className: "error",
                    }).showToast();
                    cleartextboxes()
                }else{
                    $("#save_model").show(); //show delete button
                    $("#LoadingImage").hide(); //hide loading image
                   
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

function UploadImage(){
    var file_data = $("#models_image").prop('files')[0];
    var id_number = $("#id_number").val();

    var form_data = new FormData();
    
    form_data.append('file',file_data);
    form_data.append('id_number',id_number);
    
    $.ajax({
        url:"../api/upload_model_image.php",
        dataType: 'json',
        cache:false,
        contentType:false,
        processData:false,
        data:form_data,
        type:'POST',
        success:function(response){
            if(response.status=="success"){
                saveModel();
            }else{
                $("#save_model").show(); //show delete button
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
function cleartextboxes() {
    $("input[type='text']").val("");
    $("#name").val('')
    $("#height").val('');
    $("#bust").val('');
    $("#waist").val('')
    $("#hips").val('');
    $("#shoe_size").val('');
    $("#about_model").val('')
    $("#id_number").val('');
    $("#models_image").val('');
}

//Validate Models form
function validateInputs() {
    if ($('#name').val() == '') {

        $.notify("Model Name is required!", "error");
        return false;

    }else if ($('#height').val() == '') {

        $.notify("Height is required!", "error");
        return false;
    }else if ($('#bust').val() == '') {

        $.notify("Bust is required!", "error");
        return false;
    }else if ($('#waist').val() == '') {

        $.notify("Waist Size is required!", "error");
        return false;
    }else if ($('#hips').val() == '') {

        $.notify("Hip Size is required!", "error");
        return false;
    }else if ($('#shoe_size').val() == '') {

        $.notify("Shoe Size is required!", "error");
        return false;
    }else if ($('#about_model').val() == '') {

        $.notify("About Model is required!", "error");
        return false;
    }else if ($('#id_number').val() == '') {

        $.notify("ID Number is required!", "error");
        return false;
    }else if ($('#id_number').val().length < 6) {

        $.notify("ID Number is Invalid!", "error");
        return false;

    }else if (isNaN($('#id_number').val())) {

        $.notify("Only number is required in ID field!", "error");
        return false;

    }else if(!validatePhotoSelected()){
        
        $.notify("Invalid file type, photo must be an image!", "error");
        return false;
    }else if ($('#models_image')[0].files.length === 0) {

        $.notify("Please attach Models Image!", "error");
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
    var file = $('#models_image')[0].files[0]

    if (file == undefined) {
        $.notify("Your latest Image is required", "error");
        return false;
    }

    var fileType = file.type; // holds the file types
    var validExtensions = ['jpg','png','jpeg']; //array of valid extensions
    var fileSize = file.size; // holds the file size
    var maxSize = 10 * 1024 * 1024; // defined the file max size
    
    var fileNameExt = $('#models_image').val().split('.').pop().toLowerCase();
    if ($.inArray(fileNameExt, validExtensions) == -1){
        return false;
    }else{
        return true;
    }

   
    // Checking the defined image size
    if (fileSize > maxSize) {
         $.notify("Photo Cannot exceed 10Mb !", "error");
        $('#models_image').val('');
        return false;
    }
}