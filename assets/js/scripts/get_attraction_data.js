$(document).ready(function() {
    // AJAX hívás az adatok lekérdezéséhez
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
            },
            error: function() {
                alert('Error while fetching data.');
            }
        });
    }

    // Hívjuk meg a függvényt
    getAttractionData();

    // AJAX hívás a kedvencek lekérdezéséhez és a gombok hozzáadásához
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

                // Adj egy attraction-id attribútumot a kedvencek gombhoz, hogy azonosítható legyen a későbbi hívásokban
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

    // AJAX hívás a kedvencekhez adás/eltávolítás funkcióhoz
    function toggleFavourite(attractionId) {
        $.ajax({
            url: '../../assets/ajax/toggle_favorite.php',
            type: 'POST',
            dataType: 'json',
            data: { attraction_id: attractionId },
            success: function(response) {
                // Frissítsük a gomb szövegét az új állapothoz
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


// $(document).ready(function() {
//
//
//     function getAttractionData() {
//         var urlParams = new URLSearchParams(window.location.search);
//         var attractionId = urlParams.get('attraction_id');
//
//         $.ajax({
//             url: '../../assets/ajax/get_attraction_data.php',
//             type: 'GET',
//             dataType: 'json',
//             data: { attraction_id: attractionId },
//             success: function(response) {
//                 // Adatok megjelenítése a div-ben
//                 var attractionDataDiv = $('.attractionData');
//                 var dataHtml = '<h2>' + response.name + '</h2>' +
//                     '<p>Attraction ID: ' + response.attraction_id + '</p>' +
//                     '<p>Popular: ' + response.popular + '</p>' +
//                     '<img src="/assets/images/attractions/' + response.image + '" alt="' + response.name + '" class="col-lg-4 col-sm-4 col-xs-8">' +
//                     '<p>Description: ' + response.description + '</p>' +
//                     '<p>Address: ' + response.address + '</p>';
//                 attractionDataDiv.html(dataHtml);
//
//                 // A térkép inicializálásának hívása az AJAX sikerült válasza után
//                 initMap(response);
//
//                 // Kedvencekhez adás állapotának ellenőrzése
//                 checkFavouriteStatus(attractionId);
//             },
//             error: function() {
//                 alert('Error while fetching data.');
//             }
//
//         });
//     }
//
//     // Hívjuk meg a függvényt
//     getAttractionData();
//
//
//     function initMap(response) {
//         var map = new google.maps.Map(document.getElementById('map'), {
//             center: { lat: parseFloat(response.lattitude), lng: parseFloat(response.longitude) },
//             zoom: 8
//         });
//
//         draw_markers(map, response);
//     }
//
//     function draw_markers(map, positions) {
//         new google.maps.Marker({
//             position: { lat: parseFloat(positions['lattitude']), lng: parseFloat(positions['longitude']) },
//             map: map
//         });
//     }
// });
