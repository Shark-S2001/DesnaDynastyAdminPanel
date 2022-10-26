$(document).ready(function(){

    $(".btnDel").click(function(e){
        e.preventDefault();

        var id = $(this).attr('id');

        $.ajax({
            url: "../api/delete_model.php",
            method: "POST",
            dataType:"json",
            data: { id:id },
            success:function(response){
                if(response.status == "Success")
                {
                    Toastify({
                        text: response.message,
                        backgroundColor: "linear-gradient(to right, #22E910, #055C05)",
                        className: "success",
                    }).showToast();

                    location.reload();
                }else{
                    Toastify({
                        text: response.message,
                        backgroundColor: "linear-gradient(to right, #E94D10, #F029CF)",
                        className: "error",
                    }).showToast();
                }
            }
        })
    });
})
