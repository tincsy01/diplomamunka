$(document).ready(function() {
    // Az AJAX kérés elküldése és a túra látványosságok listázása
    function getTourAttractions() {
        var urlParams = new URLSearchParams(window.location.search);
        var tourId = urlParams.get('tour_id');

        $.ajax({
            url: '../assets/ajax/get_tour_data.php',
            type: 'GET',
            dataType: 'json',
            data: { id: tourId },
            success: function(response) {
                if (response.success) {
                    var attractions = response.attractions;
                    var checklistHtml = '<div id="checklist">';
                    attractions.forEach(function(attraction, index) {
                        var checkboxId = 'attraction_' + attraction.attraction_id;
                        checklistHtml += '<input checked="" value="' + attraction.attraction_id + '" name="r" type="checkbox" id="' + checkboxId + '">';
                        checklistHtml += '<label for="' + checkboxId + '">' + attraction.name + '</label>';
                    });
                    checklistHtml += '</div>';

                    $('.tourAttractions').html(checklistHtml);
                    initMap(attractions);
                } else {
                    console.error('Failed to load tour attractions.');
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX request failed:', error);
            }
        });
    }
    getTourAttractions();
    function initMap(attractions) {
        var center = { lat: 47.4977975, lng: 19.0403225 };
        var map = new google.maps.Map(document.getElementById('tourMap'), {
            center: center,
            zoom: 8
        });
        attractions.forEach(function(attraction, index) {
            var marker = new google.maps.Marker({
                position: { lat: parseFloat(attraction.lattitude), lng: parseFloat(attraction.longitude) },
                map: map,
                title: attraction.name
            });
        });
    }
});