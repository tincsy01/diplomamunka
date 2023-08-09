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
                    '<img src="' + response.image + '" alt="' + response.name + '">' +
                    '<p>Description: ' + response.description + '</p>' +
                    '<p>Address: ' + response.address + '</p>';
                attractionDataDiv.html(dataHtml);

                // A térkép inicializálásának hívása az AJAX sikerült válasza után
                initMap(response);
            },
            error: function() {
                alert('Error while fetching data.');
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
//                 attractionDataDiv.html('');
//                 var dataHtml = '<h2>' + response.name + '</h2>' +
//                     '<p>Attraction ID: ' + response.attraction_id + '</p>' +
//                     '<p>Popular: ' + response.popular + '</p>' +
//                     '<img src="' + response.image + '" alt="' + response.name + '">' +
//                     // '<p>Longitude: ' + response.longitude + '</p>' +
//                     // '<p>Latitude: ' + response.lattitude + '</p>' +
//                     '<p>Description: ' + response.description + '</p>' +
//                     '<p>Address: ' + response.address + '</p>';
//                 attractionDataDiv.html(dataHtml);
//             },
//             error: function() {
//                 alert('Error while fetching data.');
//             }
//         });
//     }
//
//     // Hívjuk meg a függvényt
//     getAttractionData();
//     var markers_array = [];
//     const center = { lat: 47.4977975, lng: 19.0403225 };
//
//     function initMap() {
//         var map = new google.maps.Map(document.getElementById('map'), {
//             center: center,
//             zoom: 8
//         });
//
//         $.ajax({
//             url: "../../assets/ajax/get_attraction_data.php",
//             method: "GET",
//             data: { attraction_id: attractionId },
//             dataType: "JSON",
//         }).done(function (data) {
//             manage_markers(map, data);
//         }).fail(function (err) {
//             console.log("error");
//         });
//     }
//
//     function manage_markers(map, data) {
//         for (var x in data) {
//             draw_markers(map, data[x]);
//         }
//     }
//
//     function draw_markers(map, positions) {
//         new google.maps.Marker({
//             position: { lat: parseFloat(positions['lattitude']), lng: parseFloat(positions['longitude']) },
//             map: map
//         });
//     }
// });
