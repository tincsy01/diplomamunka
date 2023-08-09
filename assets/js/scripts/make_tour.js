function getCities() {
    $.ajax({
        url: '../../assets/ajax/get_city_tour.php',
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

    if (!cityId) {
        document.querySelector('#attractionList').innerHTML = '';
        return;
    }

    xhr.open('GET', '../../assets/ajax/get_attraction_tours.php?city_id=' + cityId);
    xhr.onload = function() {
        if (xhr.status === 200) {
            // Az AJAX válaszban kapott látványosságokat checkbox-listává alakítjuk
            var attractions = JSON.parse(xhr.response);
            var attractionList = document.querySelector('#attractionList');
            attractionList.innerHTML = '';

            for (var i = 0; i < attractions.length; i++) {
                var attraction = attractions[i];
                var checkboxLabel = document.createElement('label');
                var checkbox = document.createElement('input');
                checkbox.type = 'checkbox';
                checkbox.name = 'attraction_ids[]';
                checkbox.value = attraction.attraction_id;
                checkboxLabel.appendChild(checkbox);
                checkboxLabel.appendChild(document.createTextNode(attraction.name));
                attractionList.appendChild(checkboxLabel);
                attractionList.appendChild(document.createElement('br'));
            }
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
    var attractionIds = [];
    $('input[name="attraction_ids[]"]:checked').each(function() {
        attractionIds.push($(this).val());
    });
    // console.log(attractionIds);
    var date = $('#date').val();
    var time = $('#time').val();
    console.log(time);
    // Ha nincs kiválasztva város vagy látványosság, vagy a dátum és idő nincs megadva, akkor hibaüzenetet jelenítünk meg
    if (!cityId || attractionIds.length === 0 || !date || !time) {
        alert('Kérlek töltsd ki az összes mezőt.');
        return;
    }

    $.ajax({
        url: '../../assets/ajax/insert_tour.php',
        method: 'POST',
        data: {
            city_id: cityId,
            attraction_ids: attractionIds,
            date: date,
            time: time
        },
        dataType: 'json',
        success: function(response) {
            alert('A túra sikeresen hozzáadva!');
        },
        error: function() {
            alert('Hiba történt a túra hozzáadása során.');
        }
    });
}
$(document).ready(function() {
    getCities();
    $('#login-form').submit(function(event) {
        event.preventDefault();
        saveTour();
    });
});