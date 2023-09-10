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

            if(data.attractions.length > 0){
                for (var i = 0; i < data.attractions.length; i++) {
                    var attraction = data.attractions[i];
                    var attractionHTML = '<div class="attractionsData">';
                    attractionHTML += '<h4 class="attractionName"><a href="#" class="attractionLink" data-attraction-id="'+ attraction.attraction_id +'">' + attraction.name + '</a></h4>';
                    attractionHTML += '<img src="./images/attractions/' + attraction.image + '" alt="" class="attractionImage">';
                    attractionHTML += '</div>';
                    $('#attractions').append(attractionHTML);
                }

                $('.attractionLink').on('click', function(event) {
                    event.preventDefault();
                    var attractionId = $(this).data('attraction-id');
                    window.location.href = './attraction.php?attraction_id=' + attractionId;
                });
            }
            else{
                $('#attractions').html('<p>Nincsenek látnivalók ebben a városban.</p>');

            }
        },
        error: function() {
            alert('Hiba történt a város adatok lekérése során.');
        }
    });
});