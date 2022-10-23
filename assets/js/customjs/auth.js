$(document).ready(function(){
    $("#loginBtn").click(function(e){
        e.preventDefault();
        
        //Define variables
        var user_email = $("#email_address").val();
        var user_password = $("#password").val();
        
        if(validateInputs()){
            $.ajax({
                url:"../api/auth.php",
                method:"POST",
                dataType: "json",
                data:{
                    user_email:user_email,
                    user_password:user_password
                },
                success:function(response){
                    if(response.status=="Success"){
                        //Redirect the user to Dashboard
                        window.location.href="../pages/dashboard.php";
                        
                    }else{
                        Toastify({
                            text: "Username or Password is wrong",
                            backgroundColor: "linear-gradient(to right, #E94D10, #F029CF)",
                            className: "error",
                        }).showToast();
                        
                    }
                }
            })
        }
    });

    $("#logoutBtn").click(function(e){
        e.preventDefault();
        
        $.ajax({
            url:"../api/logout.php",
            success:function(response){
                window.location.href="../auth/login.php";
            }
        })
    });
})
//Validate Login form
function validateInputs() {
    if ($('#email_address').val() == '') {

        $.notify("Username is required!", "error");
        return false;

    } else if ($('#password').val() == '') {

        $.notify("Password is required!", "error");
        return false;
    } 
     else {
        return true;
    }
}