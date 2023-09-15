$(document).ready(function() {

    $.ajax({
        url: '../assets/ajax/get_attraction_worker.php',
        method: 'GET',
        dataType: 'json',
        success: function(data) {
            if (data.success) {
                var attractions = data.attractions;
                var select = $('#workingAt');
                $.each(attractions, function(index, attraction) {
                    select.append($('<option>', {
                        value: attraction.attraction_id,
                        text: attraction.name
                    }));
                });
            }
        }
    });

    $('#registration-form').submit(function(event) {
        event.preventDefault(); // Előnyomja az alapértelmezett oldalfrissítést

        // Űrlapadatok összegyűjtése
        var name = $('#name').val();
        var username = $('#username').val();
        var email = $('#email').val();
        var password = $('#password').val();
        var address = $('#address').val();
        var phone = $('#phone').val();
        var workingAt = $('#workingAt').val();

        // Ellenőrizd, hogy az űrlapmezők ki vannak-e töltve
        if (!name || !username || !email || !password || !address || !phone || !workingAt) {
            alert('Please fill in all fields.');
            return;
        }

        // Űrlapadatok elküldése a worker_registration.php fájlnak
        var formData = $(this).serialize();
        $.ajax({
            url: '../assets/ajax/worker_registration.php',
            method: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    window.location.reload();
                    alert(response.message);

                } else {
                    alert('Error: ' + response.message);
                }
            }
        });
    });
    // // Űrlap beküldésének kezelése
    // $('#registration-form').submit(function(event) {
    //     event.preventDefault(); // Előnyomja az alapértelmezett oldalfrissítést
    //
    //     // Űrlapadatok összegyűjtése
    //     var formData = $(this).serialize();
    //
    //     // Űrlapadatok elküldése a worker_registration.php fájlnak
    //     $.ajax({
    //         url: '../assets/ajax/worker_registration.php',
    //         method: 'POST',
    //         data: formData,
    //         dataType: 'json',
    //         success: function(response) {
    //             if (response.success) {
    //                 alert(response.message);
    //             } else {
    //                 alert('Error: ' + response.message);
    //             }
    //         }
    //     });
    // });
});