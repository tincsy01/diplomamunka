$(document).ready(function() {
    // Az AJAX kérés elküldése és az adatok megjelenítése
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
                    '<img src="/assets/images/attractions/' + response.image + '" alt="' + response.name + '">' +
                    '<p>Description: ' + response.description + '</p>' +
                    '<p>Address: ' + response.address + '</p>';
                attractionDataDiv.html(dataHtml);

                // A térkép inicializálásának hívása az AJAX sikerült válasza után
                initMap(response);

                // Kedvencekhez adás állapotának ellenőrzése
                checkFavouriteStatus(attractionId);
            },
            error: function() {
                alert('Error while fetching data.');
            }

        });
        $.ajax({
            url: '../../assets/ajax/check_favorite.php',
            type: 'GET',
            dataType: 'json',
            data: { user_id: YOUR_USER_ID, attraction_id: attractionId },
            success: function(response) {
                var favoriteCheckbox = $('#favoriteCheckbox');

                if (response.is_favorite) {
                    favoriteCheckbox.prop('checked', true);
                } else {
                    favoriteCheckbox.prop('checked', false);
                }
            },
            error: function() {
                console.log('Error while checking favorite status.');
            }
        });
    }

    // Hívjuk meg a függvényt
    getAttractionData();

    function initMap(response) {
        var map = new google.maps.Map(document.getElementById('map'), {
            center: { lat: parseFloat(response.lattitude), lng: parseFloat(response.longitude) },
            zoom: 8
        });

        draw_markers(map, response);
    }

    function draw_markers(map, positions) {
        new google.maps.Marker({
            position: { lat: parseFloat(positions['lattitude']), lng: parseFloat(positions['longitude']) },
            map: map
        });
    }

    // Kedvencekhez adás állapotának ellenőrzése
    // function checkFavouriteStatus(attractionId) {
    //     $.ajax({
    //         url: '../../ajax/check_favourite.php',
    //         type: 'GET',
    //         dataType: 'json',
    //         data: { attraction_id: attractionId },
    //         success: function(response) {
    //             var option1 = $('.option-1');
    //             var option2 = $('.option-2');
    //
    //             if (response) {
    //                 option1.hide();
    //                 option2.show();
    //             } else {
    //                 option1.show();
    //                 option2.hide();
    //             }
    //         },
    //         error: function() {
    //             alert('Error while checking favourite status.');
    //         }
    //     });
    // }
});



// $(document).ready(function() {
//     // Az AJAX kérés elküldése és az adatok megjelenítése
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
//                     '<img src="' + response.image + '" alt="' + response.name + '">' +
//                     '<p>Description: ' + response.description + '</p>' +
//                     '<p>Address: ' + response.address + '</p>';
//                 attractionDataDiv.html(dataHtml);
//
//                 // A térkép inicializálásának hívása az AJAX sikerült válasza után
//                 initMap(response);
//             },
//             error: function() {
//                 alert('Error while fetching data.');
//             }
//         });
//     }
//
//     // Hívjuk meg a függvényt
//     getAttractionData();
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