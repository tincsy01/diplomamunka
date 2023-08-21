$(document).ready(function() {
    $.ajax({
        url: "/admin/ajax/get_cities.php",
        method: "GET",
        dataType: "json"
    }).done(function(data) {
        var table = $('#dataTable').DataTable();
        table.clear().draw();

        $.each(data, function(index, value) {
            var updateBtn = '<button class="btn btn-primary btn-sm updateBtn" data-city-id="' + value.city_id + '" data-city-name="' + value.city_name + '">Update</button>';
            var deleteBtn = '<button class="btn btn-danger btn-sm deleteBtn" data-city-id="' + value.city_id + '" data-city-name="' + value.city_name + '">Delete</button>';

            table.row.add([
                value.organization_name,
                value.city_name,
                updateBtn,
                deleteBtn
            ]).draw(false);
        });
    }).fail(function(err) {
        console.log("Error:", err);
    });

    $("#newCity").click(function () {
        $("#newCityModal").modal("show");
    });

    // Add City gombra kattintás eseménykezelő
    // Add City gombra kattintás eseménykezelő
    $("#addCityBtn").click(function () {
        // Új város adatainak begyűjtése
        var cityName = $("#cityName").val();
        var longitude = $("#longitude").val();
        var lattitude = $("#lattitude").val();
        var image = $("#image").val();

        // AJAX hívás az adatok továbbításához
        $.ajax({
            url: "/admin/ajax/insert_new_city.php",
            method: "POST",
            data: {
                cityName: cityName,
                longitude: longitude,
                lattitude: lattitude,
                image: image
            },
            dataType: "json",
            success: function (response) {
                if (response.success) {
                    // Sikeres válasz esetén végrehajtandó tevékenységek
                    alert(response.message);
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
        $("#newCityModal").modal("hide");
    });
});