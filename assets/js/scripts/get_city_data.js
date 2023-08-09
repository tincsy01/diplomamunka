$(document).ready(function() {
    var urlParams = new URLSearchParams(window.location.search);
    var cityId = urlParams.get('city_id');

    $.ajax({
        url: '../../assets/ajax/get_city_data.php',
        method: 'GET',
        data: { city_id: cityId },
        dataType: 'json',
        success: function(data) {

            $('.cityImage img').attr('src', data.image);
            $('.cityDescription').text(data.city_name);

            // Az attracions tömb a városhoz tartozó turista látnivalókat tartalmazza
            for (var i = 0; i < data.attractions.length; i++) {
                var attraction = data.attractions[i];
                // Itt kezelheted és megjelenítheted a turista látnivalók adatait a weboldalon, pl. a #attractions elembe
                var attractionHTML = '<div class="attractionsData">';
                // var attractionHTML = '<img src="../../images/attractions' + attraction.image + '" alt="" class="attractionImage">';
                // A turista látnivaló linkjénél hozzáadjuk az attraction_id-t egy adatként, hogy elküldhessük az attraction.php oldalnak
                attractionHTML += '<h4 class="attractionName"><a href="#" class="attractionLink" data-attraction-id="'+ attraction.attraction_id +'">' + attraction.name + '</a></h4>';
                attractionHTML += '<img src="./images/attractions/' + attraction.image + '" alt="" class="attractionImage">';
                attractionHTML += '</div>';
                $('#attractions').append(attractionHTML);
            }

            // Az AJAX hívás során létrehoztuk a turista látnivaló linkjeit. Itt hozzárendeljük az onclick eseménykezelőt
            $('.attractionLink').on('click', function(event) {
                event.preventDefault();
                var attractionId = $(this).data('attraction-id');
                // Itt irányítjuk át az oldalt az attraction.php oldalra az attraction_id paraméterrel
                window.location.href = './attraction.php?attraction_id=' + attractionId;
            });
        },
        error: function() {
            alert('Hiba történt a város adatok lekérése során.');
        }
    });
});