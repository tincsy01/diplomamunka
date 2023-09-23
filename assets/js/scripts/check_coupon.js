$(document).ready(function() {
    $("#login-form").submit(function(e) {
        e.preventDefault();
        var couponCode = $("#code").val();
        var errorAlert = $("#error-alert");
        var successAlert = $("#success-alert");
        $.ajax({
            type: "POST",
            url: "../assets/ajax/check_coupon.php",
            data: { code: couponCode },
            success: function(response) {
                var jsonResponse = JSON.parse(response);
                if (jsonResponse.success) {
                    successAlert.text(jsonResponse.message);
                    successAlert.show();
                    errorAlert.hide();
                    window.location.reload();
                } else {
                    errorAlert.text(jsonResponse.message);
                    errorAlert.show();
                    successAlert.hide();
                }
            },
            error: function() {
                errorAlert.text("Error submitting coupon code.");
                errorAlert.show();
                successAlert.hide();
            }
        });
    });
});