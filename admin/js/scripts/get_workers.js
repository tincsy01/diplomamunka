$(document).ready(function() {
    $.ajax({
        url: "/admin/ajax/get_workers.php",
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
    // Add Worker gombra kattintás eseménykezelő
    $("#addWorkerBtn").click(function () {
        // Új város adatainak begyűjtése
        // var name = $("#name").val();
        // var username = $("#username").val();
        var email = $("#email").val();
        // var password = $("#password").val();
        // var address = $("#address").val();
        // var phone = $("#phone").val();

        // AJAX hívás az adatok továbbításához
        var formData = new FormData();
        // formData.append("name", name);
        // formData.append("username", username);
        formData.append("email", email);
        // formData.append("password", password);
        // formData.append("address", address);
        // formData.append("phone", phone);

        $.ajax({
            // url: "/admin/ajax/insert_new_worker.php",
            url: "/admin/ajax/send_mail_worker.php",
            method: "POST",
            data: formData,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (response) {
                if (response.success) {
                    // Sikeres válasz esetén végrehajtandó tevékenységek
                    alert(response.message);
                    window.location.reload();
                } else {
                    // Sikertelen válasz esetén végrehajtandó tevékenységek
                    alert(response.error);
                }
            },
            error: function (xhr, status, error) {
                // Hiba esetén végrehajtandó tevékenységek
                console.log("AJAX Error:", error);
            }
        });

        // Modal ablak bezárása
        $("#newWorkerModal").modal("hide");
    });
});