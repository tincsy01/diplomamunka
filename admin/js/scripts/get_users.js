$(document).ready(function() {
    $.ajax({
        url: "../admin/ajax/get_users.php",
        method: "GET",
        dataType: "json"
    }).done(function(data) {
        var table = $('#dataTable').DataTable();
        table.clear().draw();

        $.each(data, function(index, value) {
            var updateBtn = '<button class="btn btn-primary btn-sm updateBtn" data-user-id="' + value.user_id + '" data-name="' + value.name + '" data-permission="' + value.permission + '" data-email="' + value.email + '">Update</button>';
            var deleteBtn = '<button class="btn btn-danger btn-sm deleteBtn" data-user-id="' + value.user_id + '" data-name="' + value.name + '">Delete</button>';

            table.row.add([
                value.name,
                value.email,
                value.active,
                value.permission,
                updateBtn,
                deleteBtn
            ]).draw(false);
        });
    }).fail(function(err) {
        console.log("Error:", err);
    });

    // Update City gombra kattintás eseménykezelő
    $(document).on("click", ".updateBtn", function () {
        var userId = $(this).data("user-id");
        var name = $(this).data("name");
        var email = $(this).data("email");
        var permission = $(this).data("permission");

        $("#updateUserId").val(userId); // Corrected ID selector
        $("#updateName").val(name);
        $("#updateEmail").val(email);
        $("#updatePermission").val(permission);

        $("#updateUserModal").modal("show");
    });

    // Update User gombra kattintás eseménykezelő
    $("#updateUserBtn").click(function () {
        var userId = $("#updateUserId").val(); // Corrected ID selector
        var updatedName = $("#updateName").val();
        var updatedEmail = $("#updateEmail").val();
        var updatedPermission = $("#updatePermission").val();
        var updatedActive = $("#updateActive").val();

        $.ajax({
            url: "../admin/ajax/update_user.php",
            method: "POST",
            data: {
                userId: userId,
                updatedName: updatedName,
                updatedEmail: updatedEmail,
                updatedPermission: updatedPermission,
                updatedActive: updatedActive
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
        $("#updateUserModal").modal("hide");
    });


    $(document).on("click", ".deleteBtn", function() {
        var userId = $(this).data("user-id");

        // Megerősítő ablakhoz tartozó modal megjelenítése
        $("#deleteUserModal").modal("show");

        // Az üzenet visszaigazolásának gombra kattintás eseménykezelő
        $("#confirmDeleteBtn").click(function () {
            // AJAX hívás
            $.ajax({
                url: "../admin/ajax/delete_user.php",
                method: "POST",
                data: {
                    user_id: userId
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
            $("#deleteUserModal").modal("hide");
        });
    });
});

