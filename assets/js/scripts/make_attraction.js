function getCategories() {
    $.ajax({
        url: '../../assets/ajax/get_categories.php',
        method: 'GET',
        dataType: 'json',
        success: function(data) {
            var categorySelect = $('#category');
            data.forEach(function(categories) {
                var option = $('<option></option>')
                    .val(categories.category_id)
                    .text(categories.category);
                categorySelect.append(option);
            });

            categorySelect.on('change', function() {
                var category_id = $(this).val();
                loadAttractions(category_id);
            });
        },
        error: function() {
            alert('Hiba történt a városok lekérése során.');
        }
    });
}
$(document).ready(function() {
    // A form elküldésének eseménykezelője
    $('#login-form').submit(function (e) {
        e.preventDefault(); // Megakadályozza az alapértelmezett űrlap küldését

        var attractionName = $('#attraction').val();
        var category = $('#category').val();
        var longitude = $('#longitude').val();
        var latitude = $('#lattitude').val();
        var address = $('#address').val();
        var description = $('#description').val();
        var photo = $('#photo')[0].files[0]; // Ezt a részt a feltöltött fájl kezelésére használjuk

        // Új FormData példány létrehozása az űrlap adatainak tárolásához
        var formData = new FormData();
        formData.append('attraction', attractionName);
        formData.append('category', category);
        formData.append('longitude', longitude);
        formData.append('lattitude', latitude);
        formData.append('address', address);
        formData.append('description', description);
        formData.append('photo', photo);

        // Ajax kérés küldése a szerver felé
        $.ajax({
            url: '../../assets/ajax/insert_attraction.php',
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                // Sikeres válasz esetén itt lehet folytatni
                alert('A látnivaló sikeresen hozzáadva az adatbázishoz!');
                // További teendők, például adatok újratöltése vagy átirányítás
            },
            error: function () {
                alert('Hiba történt az adatok küldése során.');
            }
        });
    });
    getCategories();

});
