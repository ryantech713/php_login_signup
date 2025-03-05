$(document).ready(function, (){
    $("#username").blur(function, (){
        const username = $(this).val();

        if(username !== ""){
            $.ajax({
                url: "check_username.php",
                type: "POST",
                data: { username: username },
                dataType: "json",
                success: function(response){
                    if(response.status === "taken"){
                        $("#response").html("<span style='color: red;'>" + response.message + "</span>")
                    } else {
                        $("#response").html("<span style='color: green;'>" + response.message + "</span>");
                    }
                },
                error: function
            })
        }
    })
})