$(document).ready(function() {
    $("#login-form").submit(function(e) {
        e.preventDefault();
        var couponCode = $("#code").val();
        $.ajax({
            type: "POST",
            url: "../assets/ajax/check_coupon.php",
            data: { code: couponCode },
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
                alert("Error submitting coupon code.");
            }
        });
    });
});