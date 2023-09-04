$(document).ready(function() {

    $("#login-form").submit(function(e) {
        e.preventDefault(); // Prevent the form from submitting normally

        // Get the coupon code from the input field
        var email = $("#email").val();

        if(!email){
            alert("Fill in the email field.");
        }
        else{
            $.ajax({
                type: "POST",
                url: "../../assets/ajax/reset_password.php",
                data: { email: email },
                success: function(response) {
                    var jsonResponse = JSON.parse(response);
                    if (jsonResponse.success) {
                        alert(jsonResponse.message);
                        window.location.reload();
                    } else {
                        alert(jsonResponse.message);
                    }
                },
                error: function() {
                    alert("Error submitting email.");
                }
            });
        }

    });
});