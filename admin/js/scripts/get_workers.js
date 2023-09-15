$(document).ready(function() {
    $.ajax({
        url: "../admin/ajax/get_workers.php",
        method: "GET",
        dataType: "json"
    }).done(function (data) {
        var table = $('#dataTable').DataTable();
        table.clear().draw();

        $.each(data, function (index, value) {
            var updateBtn = '<button class="btn btn-primary btn-sm updateBtn" data-city-id="' + value.city_id + '" data-city-name="' + value.city_name + '" data-longitude="' + value.longitude + '" data-lattitude="' + value.lattitude + '">Update</button>';
            var deleteBtn = '<button class="btn btn-danger btn-sm deleteBtn" data-city-id="' + value.city_id + '" data-city-name="' + value.city_name + '">Delete</button>';

            table.row.add([
                value.name,
                value.email,
                value.active,
                value.phone,
                updateBtn,
                deleteBtn
            ]).draw(false);
        });
    }).fail(function (err) {
        console.log("Error:", err);
    });

    $("#newWorker").click(function () {
        $("#newWorkerModal").modal("show");
    });
    $("#addWorkerBtn").click(function () {

        var email = $("#email").val();


        var formData = new FormData();
        formData.append("email", email);

        $.ajax({
            url: "../admin/ajax/send_mail_worker.php",
            method: "POST",
            data: formData,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (response) {
                if (response.success) {
                    window.location.reload();
                    alert(response.message);
                } else {
                    alert(response.error);
                }
            },
            error: function (xhr, status, error) {
                console.log("AJAX Error:", error);
            }
        });

        $("#newWorkerModal").modal("hide");
    });
});