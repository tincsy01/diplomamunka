$(document).ready(function() {
    $.ajax({
        url: "../admin/ajax/get_users_statistics.php",
        method: "GET",
        dataType: "json"
    }).done(function(data) {
        var table = $('#dataTable').DataTable();
        table.clear().draw();

        $.each(data, function(index, value) {
            var couponBtn = '<button class="btn btn-info btn-sm couponBtn" data-user-id="' + value.user_id + '" data-phone="' + value.phone + '">Add coupon</button>';

            table.row.add([
                value.name,
                value.email,
                value.phone,
                value.tours,
                couponBtn
            ]).draw(false);
        });
    }).fail(function(err) {
        console.log("Error:", err);
    });
    $(document).on("click", ".couponBtn", function () {
        var userId = $(this).data("user-id");
        var phone = $(this).data("phone");

        $("#userId").val(userId);
        $("#phone").val(phone);
        $("#newCouponModal").modal("show");
    });
    $("#addCouponBtn").click(function () {
        var userId = $("#userId").val();
        var phone = $("#phone").val();
        var discount = $("#discount").val();
        $.ajax({
            url: "../admin/ajax/insert_new_coupon.php",
            method: "POST",
            data: {
                userId: userId,
                phone: phone,
                discount: discount
            },
            dataType: "json",
            success: function (response) {
                if (response.success) {
                    alert(response.message);
                    window.location.reload();
                } else {
                    alert(response.error);
                }
            },
            error: function (xhr, status, error) {
                console.log("AJAX Error:", error);
            }
        });
        $("#newCouponModal").modal("hide");
    });
});

