$(document).ready(function() {
    $.ajax({
        url: "../admin/ajax/get_organizations.php",
        method: "GET",
        dataType: "json"
    }).done(function(data) {
        var table = $('#dataTable').DataTable();
        table.clear().draw();

        $.each(data, function(index, value) {
            var updateBtn = '<button class="btn btn-primary btn-sm updateBtn" data-org-id="' + value.org_id + '" data-org-name="' + value.org_name + '"  data-phone="' + value.phone + '" data-address="' + value.address + '" data-description="' + value.description + '" data-status="' + value.status + '" data-active="' + value.active + '">Update</button>';
            var deleteBtn = '<button class="btn btn-danger btn-sm deleteBtn" data-org-id="' + value.org_id + '">Delete</button>';

            table.row.add([
                value.org_name,
                value.city_name,
                value.active,
                value.status,
                updateBtn,
                deleteBtn
            ]).draw(false);
        });
    }).fail(function(err) {
        console.log("Error:", err);
    });

    $("#newOrg").click(function () {
        $("#newOrgModal").modal("show");
    });
    $.ajax({
        url: "../admin/ajax/get_cities_org.php",
        method: "GET",
        dataType: "json",
        success: function(data) {
            var citySelect = $("#city");
            citySelect.empty();
            citySelect.append($("<option>", {
                value: "",
                text: "Select"
            }));
            $.each(data, function(index, city) {
                citySelect.append($("<option>", {
                    value: city.city_id,
                    text: city.city_name
                }));
            });
        },
        error: function(err) {
            console.log("Error:", err);
        }
    });
    $("#addOrgBtn").click(function () {
        var orgName = $("#orgName").val();
        var email = $("#email").val();
        var city = $("#city").val();
        var username = $("#username").val();
        var password = $("#password").val();
        var address = $("#address").val();
        var phone = $("#phone").val();
        if (!orgName || !email || !city || !username || !password || !address || !phone) {
            alert("All fields must be filled in!");
            return;
        }
        var formData = new FormData();
        formData.append("orgName", orgName);
        formData.append("email", email);
        formData.append("city", city);
        formData.append("username", username);
        formData.append("password", password);
        formData.append("address", address);
        formData.append("phone", phone);

        $.ajax({
            url: "../admin/ajax/insert_new_org.php",
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
        $("#newOrgModal").modal("hide");
    });
    $(document).on("click", ".updateBtn", function () {
        var orgId = $(this).data("org-id");
        var orgName = $(this).data("org-name");
        var phone = $(this).data("phone");
        var address = $(this).data("address");
        var description = $(this).data("description");
        var status = $(this).data("status");
        var active = $(this).data("active");

        $("#updateOrgId").val(orgId);
        $("#updateName").val(orgName);
        $("#updatePhone").val(phone);
        $("#updateStatus").val(status);
        $("#updateActive").val(active);
        $("#updateAddress").val(address);
        $("#updateDescription").val(description);

        $("#updateOrgModal").modal("show");
    });

    $("#updateOrgBtn").click(function () {
        var orgId = $("#updateOrgId").val();
        var updatedName = $("#updateName").val();
        var updatedPhone = $("#updatePhone").val();
        var updatedStatus = $("#updateStatus").val();
        var updatedActive = $("#updateActive").val();
        var updatedAddress = $("#updateAddress").val();
        var updatedDescription = $("#updateDescription").val();
        $.ajax({
            url: "../admin/ajax/update_organization.php",
            method: "POST",
            data: {
                orgId: orgId,
                updatedName: updatedName,
                updatedPhone: updatedPhone,
                updatedStatus: updatedStatus,
                updatedActive: updatedActive,
                updatedAddress: updatedAddress,
                updatedDescription: updatedDescription
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
        $("#updateOrgModal").modal("hide");
    });

    $(document).on("click", ".deleteBtn", function() {
        var orgId = $(this).data("org-id");
        $("#deleteOrgModal").modal("show");
        $("#confirmDeleteBtn").click(function () {
            $.ajax({
                url: "../admin/ajax/delete_organization.php",
                method: "POST",
                data: {
                    org_id: orgId
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
            $("#deleteOrgModal").modal("hide");
        });
    });
});