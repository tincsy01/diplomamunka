$(document).ready(function() {
    // Az AJAX kérés elküldése és a kedvencek listázása
    function getFavorites() {
        $.ajax({
            url: '../../assets/ajax/get_favourites.php',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                var favoritesList = $('#favoritesList');

                // Először törölje az összes elemet a kedvencek listából
                favoritesList.empty();

                // Töltse fel a kedvencek listáját
                if (response.success && response.favorites.length > 0) {
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
                    var cardAttractionDiv = $('<div class="cardAttraction"></div>');
                    var cardContent = $('<div class="cardContent"></div>');
                    var text = $('<p>No favorites have been added to the list yet.</p>')
                    cardContent.append(text);
                    cardAttractionDiv.append(cardContent);
                    favoritesList.append(cardAttractionDiv);

                }
            },
            error: function() {
                alert('Error while fetching favorites.');
            }
        });
    }
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
//                         var cardAttractionDiv = $('<div class="cardAttraction"></div>');
//                         var cardContent = $('<div class="cardContent"></div>');
//
//                         var image = $('<img src="/assets/images/attractions/' + favorite.image + '" alt="' + favorite.name + '" class="col-lg-4 col-sm-4 col-xs-8">');
//                         var nameLink = $('<a class="black-link" href="attraction.php?attraction_id=' + favorite.attraction_id + '">' + favorite.name + '</a>');
//
//                         cardContent.append(image);
//                         cardContent.append(nameLink);
//                         cardAttractionDiv.append(cardContent);
//                         favoritesList.append(cardAttractionDiv);
//                     });
//                 } else {
//                     $('#favoritesList').html('<p>No favorites have been added to the list yet.</p>');
//                 }
//             },
//             error: function() {
//                 alert('Error while fetching favorites.');
//             }
//         });
//     }
//     getFavorites();
// });