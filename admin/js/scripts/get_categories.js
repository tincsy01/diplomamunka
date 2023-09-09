$(document).ready(function() {
    $.ajax({
        url: "/admin/ajax/get_categories.php",
        method: "GET",
        dataType: "json"
    }).done(function(data) {
        var table = $('#dataTable').DataTable();
        table.clear().draw();

        $.each(data, function(index, value) {
            // var updateBtn = '<button class="btn btn-primary btn-sm updateBtn" data-city-id="' + value.category_id + '" data-city-name="' + value.city_name + '" data-longitude="' + value.longitude + '" data-lattitude="' + value.lattitude + '">Update</button>';
            var deleteBtn = '<button class="btn btn-danger btn-sm deleteBtn" data-category-id="' + value.category_id + '">Delete</button>';

            table.row.add([
                value.category,
                deleteBtn
            ]).draw(false);
        });
    }).fail(function(err) {
        console.log("Error:", err);
    });

    $("#newCategory").click(function () {
        $("#newCategoryModal").modal("show");
    });

    // Add City gombra kattintás eseménykezelő
    $("#addCategoryBtn").click(function () {
        // Új város adatainak begyűjtése
        var category = $("#category").val();

        // AJAX hívás az adatok továbbításához
        var formData = new FormData();
        formData.append("category", category);

        $.ajax({
            url: "/admin/ajax/insert_new_category.php",
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
        $("#newCategoryModal").modal("hide");
    });

    $(document).on("click", ".deleteBtn", function() {
        var categoryId = $(this).data("category-id");
        $("#deleteCategoryModal").modal("show");

        // Az üzenet visszaigazolásának gombra kattintás eseménykezelő
        $("#confirmDeleteBtn").click(function () {
            // AJAX hívás
            $.ajax({
                url: "/admin/ajax/delete_category.php",
                method: "POST",
                data: {
                    category_id: categoryId
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
            $("#deleteCategoryModal").modal("hide");
        });
    });


});