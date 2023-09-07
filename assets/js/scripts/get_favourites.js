$(document).ready(function() {
    // Az AJAX kérés elküldése és a kedvencek listázása
    function getFavorites() {
        $.ajax({
            url: '../../assets/ajax/get_favourites.php',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    var favoritesList = $('#favoritesList');

                    // Töltse fel a kedvencek listáját
                    response.favorites.forEach(function(favorite) {
                        var cardAttractionDiv = $('<div class="cardAttraction"></div>');
                        var cardContent = $('<div class="cardContent"></div>');

                        var image = $('<img src="/assets/images/attractions/' + favorite.image + '" alt="' + favorite.name + '" class="col-lg-4 col-sm-4 col-xs-8">');
                        var nameLink = $('<a class="black-link" href="attraction.php?attraction_id=' + favorite.attraction_id + '">' + favorite.name + '</a>');

                        cardContent.append(image);
                        cardContent.append(nameLink);
                        cardAttractionDiv.append(cardContent);
                        favoritesList.append(cardAttractionDiv);
                    });
                } else {
                    // Nincsenek kedvencek
                    $('#favoritesList').html('<p>Nincsenek kedvencek.</p>');
                }
            },
            error: function() {
                alert('Error while fetching favorites.');
            }
        });
    }

    // Hívjuk meg a függvényt a kedvencek listázásához
    getFavorites();
});



// $(document).ready(function() {
//     // Az AJAX kérés elküldése és a kedvencek listázása
//     function getFavorites() {
//         $.ajax({
//             url: '../../assets/ajax/get_favourites.php',
//             type: 'GET',
//             dataType: 'json',
//             success: function(response) {
//                 if (response.success) {
//                     var favoritesList = $('#favoritesList');
//
//                     // Töltse fel a kedvencek listáját
//                     response.favorites.forEach(function(favorite) {
//                         var listItem = $('<li><a href="attraction.php?attraction_id=' + favorite.attraction_id + '">' + favorite.name + '</a></li>');
//                         favoritesList.append(listItem);
//                     });
//                 } else {
//                     // Nincsenek kedvencek
//                     $('#favoritesList').html('<p>Nincsenek kedvencek.</p>');
//                 }
//             },
//             error: function() {
//                 alert('Error while fetching favorites.');
//             }
//         });
//     }
//
//     // Hívjuk meg a függvényt a kedvencek listázásához
//     getFavorites();
// });
