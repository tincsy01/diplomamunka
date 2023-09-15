$(document).ready(function () {
    var urlParams = new URLSearchParams(window.location.search);
    var cityId = urlParams.get('city_id');

    $.ajax({
        url: '../assets/ajax/get_city_data.php',
        method: 'GET',
        data: { city_id: cityId },
        dataType: 'json',
        success: function (data) {
            // Városi adatok megjelenítése
            var cityDataDiv = $('.cityData');
            var cityDataHtml = '<div class="row">';
            cityDataHtml += '<div class="col-lg-10 col-sm-10 col-xs-10">';
            cityDataHtml += '<h2>'+data.city_name+'</h2>';
            cityDataHtml += '<br>';
            cityDataHtml += '<div class="cityImage">';
            cityDataHtml += '<img src="../assets/images/cities/' + data.image + '" alt="" class="cityImage ">';
            cityDataHtml += '</div>';
            cityDataHtml += '</div>';
            cityDataHtml += '<div class="col-lg-8 col-sm-8 col-xs-8">';
            cityDataHtml += '<div id="tourMap" style="height: 400px;"></div>';
            cityDataHtml += '</div>';
            cityDataHtml += '</div>';
            cityDataDiv.html(cityDataHtml);

            if (data.longitude && data.lattitude) {
                // Térkép inicializálása
                var center = { lat: parseFloat(data.lattitude), lng: parseFloat(data.longitude) };
                var map = new google.maps.Map(document.getElementById('tourMap'), {
                    center: center,
                    zoom: 8
                });

                // Város megjelenítése a térképen
                var marker = new google.maps.Marker({
                    position: center,
                    map: map,
                    title: data.city_name
                });
            }

            // Látványosságok listázása
            if (data.attractions.length > 0) {
                var attractionsDiv = $('#attractions');
                for (var i = 0; i < data.attractions.length; i++) {
                    var attraction = data.attractions[i];
                    var attractionHTML = '<div class="attractionsData">';
                    attractionHTML += '<h4 class="attractionName"><a href="#" class="attractionLink" data-attraction-id="' + attraction.attraction_id + '">' + attraction.name + '</a></h4>';
                    attractionHTML += '</div>';
                    attractionsDiv.append(attractionHTML);
                }

                $('.attractionLink').on('click', function (event) {
                    event.preventDefault();
                    var attractionId = $(this).data('attraction-id');
                    window.location.href = './attraction.php?attraction_id=' + attractionId;
                });
            } else {
                $('#attractions').html('<p>There are no attractions in this city yet.</p>');
            }
        },
        error: function () {
            alert('Hiba történt a város adatok lekérése során.');
        }
    });
});