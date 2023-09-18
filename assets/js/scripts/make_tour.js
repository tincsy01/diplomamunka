function getCities() {
    $.ajax({
        url: '../assets/ajax/get_city_tour.php',
        method: 'GET',
        dataType: 'json',
        success: function(data) {
            var citySelect = $('#city');
            data.forEach(function(city) {
                var option = $('<option></option>')
                    .val(city.city_id)
                    .text(city.city_name);
                citySelect.append(option);
            });
            citySelect.on('change', function() {
                var cityId = $(this).val();
                loadAttractions(cityId);
            });
        },
        error: function() {
            alert('Hiba történt a városok lekérése során.');
        }
    });
}
function loadAttractions(cityId) {
    var xhr = new XMLHttpRequest();
    var attractionSelect = $('#attractions select');

    attractionSelect.empty();

    if (!cityId) {
        attractionSelect.prepend('<option value="" disabled selected hidden>Select attractions</option>');
        attractionSelect.select2();
        return;
    }

    xhr.open('GET', '../assets/ajax/get_attraction_tours.php?city_id=' + cityId);
    xhr.onload = function() {
        if (xhr.status === 200) {
            var attractions = JSON.parse(xhr.response);
            attractions.forEach(function(attraction) {
                var option = $('<option></option>')
                    .val(attraction.attraction_id)
                    .text(attraction.name);
                attractionSelect.append(option);
            });
            attractionSelect.select2();
        } else {
            console.error('Hiba történt: ' + xhr.statusText);
        }
    };
    xhr.onerror = function() {
        console.error('Hiba történt az AJAX kérés során');
    };
    xhr.send();
}
function saveTour() {
    var cityId = $('#city').val();
    var selectedAttractionIds = $('#attractions select').val();
    var date = $('#date').val();
    var time = $('#time').val();
    if (!cityId || !selectedAttractionIds || selectedAttractionIds.length === 0 || !date || !time) {
        alert('Please fill in all fields.');
        return;
    }
    $.ajax({
        url: '../assets/ajax/insert_tour.php',
        method: 'POST',
        data: {
            city_id: cityId,
            attraction_ids: selectedAttractionIds,
            date: date,
            time: time
        },
        success: function (response) {
            console.log(response);
            if (response.success) {
                alert(response.message);
                window.location.reload();
            } else {
                alert('Hiba: ' + response.message);
            }
        },
        error: function (xhr, status, error) {
            console.log(xhr.responseText);
            alert('Hiba történt a kommunikáció során: ' + error);
        }
    });
}
function checkLoginStatus() {
    $.ajax({
        url: '../assets/ajax/get_login.php',
        method: 'GET',
        dataType: 'json',
        success: function(response) {
            if (response === true) {
                $('.user-logged-in').show();
            } else {
                $('.user-logged-in').hide();
                $('.logout').show();

            }
        },
        error: function() {
            alert('Error while checking login status.');
        }
    });
}
checkLoginStatus();
$(document).ready(function () {
    getCities();
    $('#login-form').submit(function (event) {
        event.preventDefault();
        saveTour();
    });
});

