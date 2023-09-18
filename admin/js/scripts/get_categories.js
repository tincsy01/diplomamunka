$(document).ready(function() {
    $.ajax({
        url: "../admin/ajax/get_categories.php",
        method: "GET",
        dataType: "json"
    }).done(function(data) {
        var table = $('#dataTable').DataTable();
        table.clear().draw();
        $.each(data, function(index, value) {
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
    $("#addCategoryBtn").click(function () {
        var category = $("#category").val();

        var formData = new FormData();
        formData.append("category", category);

        $.ajax({
            url: "../admin/ajax/insert_new_category.php",
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
        $("#newCategoryModal").modal("hide");
    });

    $(document).on("click", ".deleteBtn", function() {
        var categoryId = $(this).data("category-id");
        $("#deleteCategoryModal").modal("show");
        $("#confirmDeleteBtn").click(function () {
            $.ajax({
                url: "../admin/ajax/delete_category.php",
                method: "POST",
                data: {
                    category_id: categoryId
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
            $("#deleteCategoryModal").modal("hide");
        });
    });
});