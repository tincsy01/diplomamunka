$(document).ready(function() {
    $("#login-form").submit(function(e) {
        e.preventDefault();

        var complaintMessage = $("#complaint").val();
        var status = $("#status").val();

        if (!complaintMessage || !status) {
            alert('Fill in all fields!');
            return;
        }

        $.ajax({
            type: "POST",
            url: "../assets/ajax/insert_complaint.php",
            data: { complaint: complaintMessage, status: status },
            success: function(response) {
                window.location.reload();
            },
            error: function() {
                alert("Error submitting complaint.");
            }
        });
    });
    function fetchComplaints() {
        $.ajax({
            type: "GET",
            url: "../assets/ajax/get_complaints.php",
            success: function(response) {
                $("#complaintList").empty();

                if (response.length > 0) {
                    $.each(response, function(index, complaint) {
                        var complaintItem = $("<div>", {
                            "class": "col-md-6 col-sm-6 fh5co-item-wrap"
                        });

                        var backgroundColor = "";
                        switch (complaint.status) {
                            case 4:
                                backgroundColor = "#AEC3AE";
                                break;
                            case 3:
                                backgroundColor = "#FF9B9B";
                                break;
                            case 1:
                                backgroundColor = "#F7E987";
                                break;
                            case 2:
                                backgroundColor = "#FFC95F";
                                break;
                            default:
                                backgroundColor = "white";
                        }

                        var complaintContent = $("<div>", {
                            "class": "fh5co-listing-item list-padding",
                            "css": {
                                "background-color": backgroundColor
                            }
                        }).append(
                            $("<h3>", {
                                "text": "Complaint #" + (index + 1)
                            }),
                            $("<p>", {
                                "text": complaint.complaint
                            }),
                            $("<p>", {
                                "text": "Date:" +complaint.date
                            }),
                        );

                        var editButton = $("<button>", {
                            "text": "Update",
                            "class": "btn btn-primary edit-button"
                        });

                        editButton.data("complaint-id", complaint.complaint_id);

                        complaintContent.append(editButton);

                        complaintItem.append(complaintContent);
                        $("#complaintList").append(complaintItem);

                        editButton.click(function() {
                            var complaintId = $(this).data("complaint-id");
                            $("#updateComplaintModal").modal("show");
                            $("#saveComplaintButton").click(function() {
                                var status = $("#statusUpdate").val();
                                $.ajax({
                                    type: "POST",
                                    url: "../assets/ajax/update_complaint.php",
                                    data: {
                                        status: status,
                                        complaint_id: complaintId
                                    },
                                    success: function(response) {
                                      window.location.reload();
                                    },
                                    error: function() {
                                        alert("Error updating complaint.");
                                    }
                                });
                                $("#updateComplaintModal").modal("hide");
                            });
                        });
                    });
                } else {
                    $("#complaintList").append($("<p>", {
                        "text": "No complaints found."
                    }));
                }
            },
            error: function() {
                alert("Error fetching complaints.");
            }
        });
    }
    fetchComplaints();
});
