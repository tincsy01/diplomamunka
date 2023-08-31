$(document).ready(function() {
    $("#login-form").submit(function(e) {
        e.preventDefault(); // Prevent the form from submitting normally

        // Get the complaint message from the textarea
        var complaintMessage = $("#complaint").val();

        // Perform AJAX request to submit the complaint
        $.ajax({
            type: "POST",
            url: "../../assets/ajax/insert_complaint.php",
            data: { complaint: complaintMessage },
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
            url: "../../assets/ajax/get_complaints.php", // Replace with the actual URL to fetch complaints
            success: function(response) {
                $("#complaintList").empty(); // Töröljük az előző tartalmat

                if (response.length > 0) {
                    // Iterálunk a panaszokon és hozzáadjuk a listához
                    $.each(response, function(index, complaint) {
                        var complaintItem = $("<div>", {
                            "class": "col-md-6 col-sm-6 fh5co-item-wrap"
                        });

                        var complaintContent = $("<div>", {
                            "class": "fh5co-listing-item"
                        }).append(
                            $("<h3>", {
                                "text": "Complaint #" + (index + 1)
                            }),
                            $("<p>", {
                                "text": complaint.complaint
                            })
                        );

                        complaintItem.append(complaintContent);
                        $("#complaintList").append(complaintItem);
                    });
                } else {
                    // Ha nincsenek panaszok
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

    // Panaszok lekérésének és megjelenítésének indítása
    fetchComplaints();
});


// $(document).ready(function() {
//     $("#login-form").submit(function(e) {
//         e.preventDefault(); // Prevent the form from submitting normally
//
//         // Get the complaint message from the textarea
//         var complaintMessage = $("#complaint").val();
//
//         // Perform AJAX request to submit the complaint
//         $.ajax({
//             type: "POST",
//             url: "../../assets/ajax/insert_complaint.php",
//             data: { complaint: complaintMessage },
//             success: function(response) {
//               window.location.reload();
//             },
//             error: function() {
//                 alert("Error submitting complaint.");
//             }
//         });
//     });
//     function fetchComplaints() {
//         $.ajax({
//             type: "GET",
//             url: "../../assets/ajax/get_complaints.php", // Replace with the actual URL to fetch complaints
//             success: function(response) {
//                 $("#complaintList").empty(); // Töröljük az előző tartalmat
//
//                 if (response.length > 0) {
//                     // Iterálunk a panaszokon és hozzáadjuk a listához
//                     $.each(response, function(index, complaint) {
//                         var complaintItem = $("<div>", {
//                             "class": "col-md-6 col-sm-6 fh5co-item-wrap"
//                         });
//
//                         var complaintContent = $("<div>", {
//                             "class": "fh5co-listing-item"
//                         }).append(
//                             $("<h3>", {
//                                 "text": "Complaint #" + (index + 1)
//                             }),
//                             $("<p>", {
//                                 "text": complaint.complaint
//                             })
//                         );
//
//                         complaintItem.append(complaintContent);
//                         $("#complaintList").append(complaintItem);
//                     });
//                 } else {
//                     // Ha nincsenek panaszok
//                     $("#complaintList").append($("<p>", {
//                         "text": "No complaints found."
//                     }));
//                 }
//             },
//             error: function() {
//                 alert("Error fetching complaints.");
//             }
//         });
//     }
//
//     // Panaszok lekérésének és megjelenítésének indítása
//     fetchComplaints();
// });