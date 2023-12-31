function getCategories() {
    $.ajax({
        url: '../assets/ajax/get_categories.php',
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
            alert('Error.');
        }
    });
}
$(document).ready(function() {
    $('#login-form').submit(function (e) {
        e.preventDefault();

        var attractionName = $('#attraction').val();
        var category = $('#category').val();
        var longitude = parseFloat($('#longitude').val());
        var latitude = parseFloat($('#lattitude').val());
        var address = $('#address').val();
        var description = $('#description').val();
        var photo = $('#photo')[0].files[0];

        if (!attractionName || !category || !longitude || isNaN(longitude) || !latitude || isNaN(latitude) || !address || !description || !photo) {
            alert('Fill in all fields and ensure latitude and longitude are numbers.');
            return;
        }

        var formData = new FormData();
        formData.append('attraction', attractionName);
        formData.append('category', category);
        formData.append('longitude', longitude);
        formData.append('lattitude', latitude);
        formData.append('address', address);
        formData.append('description', description);
        formData.append('photo', photo);

        $.ajax({
            url: '../assets/ajax/insert_attraction.php',
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                alert('The point of interest has been successfully added.');
                window.location.reload();
            },
            error: function () {
                alert('Hiba történt az adatok küldése során.');
            }
        });
    });
    getCategories();
});