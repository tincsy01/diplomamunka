function redirectToTourPage(tourId) {
    window.location.href = 'tour_data.php?tour_id=' + tourId;
}

function getTours() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '../../assets/ajax/get_tours.php');
    xhr.onload = function() {
        if (xhr.status === 200) {
            var tours = JSON.parse(xhr.responseText);
            var toursList = document.querySelector('.tours-list');
            toursList.innerHTML = '';

            if (tours.length === 0) {
                var noToursMessage = document.createElement('p');
                noToursMessage.textContent = 'No tours have been created yet.';
                toursList.appendChild(noToursMessage);
            } else {
                for (var i = 0; i < tours.length; i++) {
                    var tour = tours[i];
                    var tourElement = document.createElement('div');
                    tourElement.setAttribute('class', 'tour');
                    var cityHeader = document.createElement('h2');
                    cityHeader.textContent = tour.city_name;
                    cityHeader.setAttribute('data-tour-id', tour.tour_id);
                    cityHeader.addEventListener('click', function() {
                        var tourId = this.getAttribute('data-tour-id');
                        redirectToTourPage(tourId);
                    });
                    tourElement.appendChild(cityHeader);
                    var tourId = document.createElement('p');
                    tourId.textContent = 'Tour ID: ' + tour.tour_id;
                    tourElement.appendChild(tourId);
                    var date = document.createElement('p');
                    date.textContent = 'Date and time: ' + tour.date;
                    tourElement.appendChild(date);
                    var attractionsHeader = document.createElement('p');
                    attractionsHeader.textContent = 'Attractions:';
                    tourElement.appendChild(attractionsHeader);
                    var attractionsList = document.createElement('ul');
                    var attractions = tour.attractions;
                    for (var j = 0; j < attractions.length; j++) {
                        var attraction = attractions[j];
                        var attractionItem = document.createElement('li');
                        attractionItem.textContent = attraction.name;
                        attractionsList.appendChild(attractionItem);
                    }
                    tourElement.appendChild(attractionsList);
                    toursList.appendChild(tourElement);
                }
            }
        } else {
            console.error('Hiba történt: ' + xhr.statusText);
        }
    };
    xhr.onerror = function() {
        console.error('Hiba történt az AJAX kérés során');
    };
    xhr.send();
}

window.onload = function() {
    getTours();
};
