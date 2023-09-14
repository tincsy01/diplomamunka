$(document).ready(function() {

    $("#login-form").submit(function(e) {
        e.preventDefault(); // Prevent the form from submitting normally

        // Get the coupon code from the input field
        var couponCode = $("#code").val();
        $.ajax({
            type: "POST",
            url: "../assets/ajax/check_coupon.php",
            data: { code: couponCode },
            success: function(response) {
                var jsonResponse = JSON.parse(response); // A JSON választ parse-oljuk
                if (jsonResponse.success) {
                    alert(jsonResponse.message);
                    window.location.reload();
                } else {
                    alert(jsonResponse.message); // Kiírjuk az üzenetet
                }
            },
            error: function() {
                alert("Error submitting coupon code.");
            }
        });
    });
});