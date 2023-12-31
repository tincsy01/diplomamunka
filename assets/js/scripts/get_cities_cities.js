$(document).ready(function() {
    $.ajax({
        url: '../assets/ajax/get_cities_cities.php',
        method: 'GET',
        dataType: 'json',
        success: function(data) {
            for (var i = 0; i < data.length; i++) {
                var city = data[i];
                var divHtml = '<div class="col-md-4 col-sm-4 fh5co-item-wrap">';
                divHtml += '<a class="fh5co-listing-item" href="./city_data.php?city_id=' + city.city_id + '">';
                divHtml += '<img src="../assets/images/cities/' + city.image + '" alt="Image" class="img-responsive">';
                divHtml += '<div class="fh5co-listing-copy">';
                divHtml += '<h2 class="cityName">' + city.city_name + '</h2>';
                divHtml += '<span class="icon">';
                divHtml += '<i class="icon-chevron-right"></i>';
                divHtml += '</span>';
                divHtml += '</div></a></div>';
                $('#cityList').append(divHtml);
            }
        },
        error: function() {
            alert('Hiba történt a városok lekérése során.');
        }
    });
});