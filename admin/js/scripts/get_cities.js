$(document).ready(function() {
    $.ajax({
        url: "../admin/ajax/get_cities.php",
        method: "GET",
        dataType: "json"
    }).done(function(data) {
        var table = $('#dataTable').DataTable();
        table.clear().draw();

        $.each(data, function(index, value) {
            var updateBtn = '<button class="btn btn-primary btn-sm updateBtn" data-city-id="' + value.city_id + '" data-city-name="' + value.city_name + '" data-longitude="' + value.longitude + '" data-lattitude="' + value.lattitude + '">Update</button>';
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
    $("#addCityBtn").click(function () {
        var cityName = $("#cityName").val();
        var longitude = parseFloat($("#longitude").val());
        var lattitude = parseFloat($("#lattitude").val());
        var image = $("#image")[0].files[0];

        if (!cityName || isNaN(longitude) || isNaN(lattitude) || !image) {
            alert('Fill in all fields and ensure longitude and lattitude are numbers.');
            return;
        }

        var formData = new FormData();
        formData.append("cityName", cityName);
        formData.append("longitude", longitude);
        formData.append("lattitude", lattitude);
        formData.append("image", image);

        $.ajax({
            url: "../admin/ajax/insert_new_city.php",
            method: "POST",
            data: formData,
            contentType: false,
            processData: false,
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

        $("#newCityModal").modal("hide");
    });

    $(document).on("click", ".updateBtn", function () {
        var cityId = $(this).data("city-id");
        var cityName = $(this).data("city-name");
        var longitude = $(this).data("longitude");
        var lattitude = $(this).data("lattitude");

        $("#updateCityId").val(cityId);
        $("#updateCityName").val(cityName);
        $("#updateLongitude").val(longitude);
        $("#updateLattitude").val(lattitude);

        $("#updateCityModal").modal("show");
    });

    $("#updateCityBtn").click(function () {
        var cityId = $("#updateCityId").val();
        var updatedCityName = $("#updateCityName").val();
        var updatedLongitude = $("#updateLongitude").val();
        var updatedLattitude = $("#updateLattitude").val();

        $.ajax({
            url: "../admin/ajax/update_city.php",
            method: "POST",
            data: {
                cityId: cityId,
                updatedCityName: updatedCityName,
                updatedLongitude: updatedLongitude,
                updatedLattitude: updatedLattitude
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
                // Hiba esetén végrehajtandó tevékenységek
                console.log("AJAX Error:", error);
            }
        });

        // Modal ablak bezárása
        $("#updateCityModal").modal("hide");
    });


    $(document).on("click", ".deleteBtn", function() {
        var cityId = $(this).data("city-id");
        var cityName = $(this).data("city-name");

        // Megerősítő ablakhoz tartozó modal megjelenítése
        $("#cityNameToDelete").text(cityName);
        $("#deleteCityModal").modal("show");

        // Az üzenet visszaigazolásának gombra kattintás eseménykezelő
        $("#confirmDeleteBtn").click(function () {
            // AJAX hívás
            $.ajax({
                url: "../admin/ajax/delete_city.php",
                method: "POST",
                data: {
                    city_id: cityId
                },
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
            $("#deleteCityModal").modal("hide");
        });
    });


});