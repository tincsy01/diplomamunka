$(document).ready(function() {
    var map;
    function getAttractionData() {
        var urlParams = new URLSearchParams(window.location.search);
        var attractionId = urlParams.get('attraction_id');

        $.ajax({
            url: '../../assets/ajax/get_attraction_data.php',
            type: 'GET',
            dataType: 'json',
            data: { attraction_id: attractionId },
            success: function(response) {
                // Adatok megjelenítése a div-ben
                var attractionDataDiv = $('.attractionData');
                var dataHtml = '<h2>' + response.name + '</h2>' +
                    '<p>Attraction ID: ' + response.attraction_id + '</p>' +
                    '<p>Popular: ' + response.popular + '</p>' +
                    '<img src="/assets/images/attractions/' + response.image + '" alt="' + response.name + '" class="col-lg-4 col-sm-4 col-xs-8">' +
                    '<p>Description: ' + response.description + '</p>' +
                    '<p>Address: ' + response.address + '</p>';
                attractionDataDiv.html(dataHtml);

                // Kedvencekhez adás/eltávolítás funkció és gomb hozzáadása
                checkFavouriteStatus(attractionId);

                // Inicializáljuk a térképet az adott látványosság koordinátáival
                var attractions = [response]; // Egyetlen látványosság adataival tömbben
                initMap(attractions);
            },
            error: function() {
                alert('Error while fetching data.');
            }
        });
    }
    getAttractionData();

    function initMap(attractions) {
        var center = {lat: 47.4977975, lng: 19.0403225};
        var map = new google.maps.Map(document.getElementById('tourMap'), {
            center: center,
            zoom: 8
        });

        // Markerek hozzáadása a térképhez
        attractions.forEach(function (attraction, index) {
            var marker = new google.maps.Marker({
                position: {lat: parseFloat(attraction.lattitude), lng: parseFloat(attraction.longitude)},
                map: map,
                title: attraction.name
            });
        });
    }

    function checkFavouriteStatus(attractionId) {
        $.ajax({
            url: '../../assets/ajax/check_favorite.php',
            type: 'GET',
            dataType: 'json',
            data: { attraction_id: attractionId },
            success: function(response) {
                var favoriteButton = $('<button id="favorite-button" class="btn">Add to Favorites</button>');

                if (response.is_favorite) {
                    favoriteButton.text('Remove from Favorites');
                }

                favoriteButton.attr('attraction-id', attractionId);

                $('.attractionData').append(favoriteButton);

                favoriteButton.click(function() {
                    toggleFavourite(attractionId);
                });
            },
            error: function() {
                alert('Error while checking favorite status.');
            }
        });
    }
    function toggleFavourite(attractionId) {
        $.ajax({
            url: '../../assets/ajax/toggle_favorite.php',
            type: 'POST',
            dataType: 'json',
            data: { attraction_id: attractionId },
            success: function(response) {
                var favoriteButton = $('#favorite-button[attraction-id="' + attractionId + '"]');
                if (favoriteButton.text() === 'Add to Favorites') {
                    favoriteButton.text('Remove from Favorites');
                } else {
                    favoriteButton.text('Add to Favorites');
                }
            },
            error: function() {
                alert('Error while toggling favorite status.');
            }
        });
    }
});