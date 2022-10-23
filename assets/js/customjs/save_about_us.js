$(document).ready(function(){
    $("#submit_about").click(function(e){
        e.preventDefault();
        
        if(ValidateAboutUs()==true){
             //Show Progress
            $("#submit_about").hide(); //hide add button
            $("#LoadingImage").show(); //show loading image
            saveAbout();  
        }
    })
    return true;
})


function saveAbout(){
    var about_title = $("#about_title").val();
    var aboutus_body = $("#aboutus_body").val();
    if(ValidateAboutUs()){
        $.ajax({
            url: "../api/save_about.php",
            method: "POST",
            dataType:"json",
            data:{
                about_title:about_title,
                aboutus_body:aboutus_body
            },
            success:function(response){
                if(response.status=="Success"){
                    $("#submit_about").show(); //show delete button
                    $("#LoadingImage").hide(); //hide loading image
                    Toastify({
                        text: response.message,
                        backgroundColor: "linear-gradient(to right, #22E910, #055C05)",
                        className: "success",
                    }).showToast();
 

                    cleartextboxes()
                
                }else{

                $("#submit_about").show(); //show delete button
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

function cleartextboxes() {
    $("input[type='text']").val("");
    $("#about_title").val('');
    $("#aboutus_body").val('');
}

//Re-validate basic info form
function ValidateAboutUs() {
    if ($('#about_title').val() == '') {

        $.notify("Title is required!", "error");
        return false;

    } else if ($('#aboutus_body').val() == '') {

        $.notify("Body is required!", "error");
        return false;
    } else {
        return true;
    }
}