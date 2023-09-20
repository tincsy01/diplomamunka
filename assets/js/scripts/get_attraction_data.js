$(document).ready(function() {
    var map;
    $('.user-logged-in').hide();
    checkLoginStatus();

    function getAttractionData() {
        var urlParams = new URLSearchParams(window.location.search);
        var attractionId = urlParams.get('attraction_id');

        $.ajax({
            url: '../assets/ajax/get_attraction_data.php',
            type: 'GET',
            dataType: 'json',
            data: { attraction_id: attractionId },
            success: function(response) {
                var attractionDataDiv = $('.attractionData');
                var dataHtml = '<div class="row">' +
                    '<div class="col-lg-10 col-sm-10 col-xs-10">' +
                    '<h2>' + response.name + '</h2>' +
                    '<p>Attraction ID: ' + response.attraction_id + '</p>' +
                    '<p>Popular: ' + response.popular + '</p>' +
                    '<img src="../assets/images/attractions/' + response.image + '" alt="' + response.name + '" class="col-lg-4 col-sm-4 col-xs-8">' +
                    '<p>Description: ' + response.description + '</p>' +
                    '<p>Address: ' + response.address + '</p>' +
                    '</div>' +
                    '<div class="col-lg-8 col-sm-8 col-xs-8">' +
                    '<div id="tourMap" style="height: 400px;"></div>' +
                    '</div>' +
                    '</div>';
                attractionDataDiv.prepend(dataHtml);

                checkFavouriteStatus(attractionId);
                var attractions = [response];
                initMap(attractions);
            },
            error: function() {
                alert('Error while fetching data.');
            }
        });
    }
    getAttractionData();
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
                }
            },
            error: function() {
                alert('Error while checking login status.');
            }
        });
    }

    function initMap(attractions) {
        var center = {lat: 47.4977975, lng: 19.0403225};
        var map = new google.maps.Map(document.getElementById('tourMap'), {
            center: center,
            zoom: 8
        });
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
            url: '../assets/ajax/check_favorite.php',
            type: 'GET',
            dataType: 'json',
            data: { attraction_id: attractionId },
            success: function(response) {

                if (response.is_favorite) {
                    $('#favorite-button').text('Remove from Favorites');
                } else {
                    $('#favorite-button').text('Add to Favorites');
                }
                $('#favorite-button').attr('attraction-id', attractionId)
            },
            error: function() {
                alert('Error while checking favorite status.');
            }
        });
    }

    function toggleFavourite(attractionId) {
        $.ajax({
            url: '../assets/ajax/toggle_favorite.php',
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

    checkLoginStatus();

    $('#favorite-button').click(function() {
        toggleFavourite($(this).attr('attraction-id'));
    });
});
