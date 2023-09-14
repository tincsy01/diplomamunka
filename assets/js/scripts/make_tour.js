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

            // Az eseménykezelő hozzáadása csak itt történik meg, miután betöltöttük a városokat a select-be.
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

    // Először ürítsd ki a Select2 mezőt
    attractionSelect.empty();

    if (!cityId) {
        // Üres értéket adj hozzá a Select2-hez, hogy megjelenjen, amikor nincs város kiválasztva
        attractionSelect.prepend('<option value="" disabled selected hidden>Select attractions</option>');
        // Most inicializáljuk a Select2-t
        attractionSelect.select2();
        return;
    }

    xhr.open('GET', '../assets/ajax/get_attraction_tours.php?city_id=' + cityId);
    xhr.onload = function() {
        if (xhr.status === 200) {
            var attractions = JSON.parse(xhr.response);

            // Az AJAX válaszban kapott látványosságokat hozzáadod a Select2-höz
            attractions.forEach(function(attraction) {
                var option = $('<option></option>')
                    .val(attraction.attraction_id)
                    .text(attraction.name);
                attractionSelect.append(option);
            });

            // Most inicializáljuk a Select2-t
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
        success: function (responseText) {
            try {
                var response = JSON.parse(responseText);
                if (response.success) {
                    alert(response.message);
                    window.location.reload();
                } else {
                    alert('Hiba: ' + response.message);
                }
            } catch (error) {
                alert('Hiba: Nem sikerült feldolgozni a választ.');
            }
        },
        error: function () {
            alert('Hiba: Nem sikerült kommunikálni a szerverrel.');
        }
    });
}

$(document).ready(function () {
    getCities();
    // loadAttractions(cityId);
    $('#login-form').submit(function (event) {
        event.preventDefault();
        saveTour();
    });
});

