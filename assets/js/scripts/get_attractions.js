document.addEventListener("DOMContentLoaded", function() {
    const attractionsTable = document.getElementById("attractionsTable").getElementsByTagName("tbody")[0];

    const xhr = new XMLHttpRequest();
    xhr.open("GET", "../../assets/ajax/get_attractions.php", true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            const attractions = JSON.parse(xhr.responseText);
            populateAttractionsTable(attractions);
        } else {
            console.error("Error fetching attractions data");
        }
    };
    xhr.send();

    function populateAttractionsTable(attractions) {
        attractions.forEach(attraction => {
            const row = attractionsTable.insertRow();
            row.innerHTML = `
                <td>${attraction.name}</td>
                <td>${attraction.category}</td>
                <td>${attraction.num_of_visitors}</td>
                <td>${attraction.popular}</td>
                <td><button class="btn btn-primary btn-sm updateBtn" id-data="${attraction.attraction_id}" name-data="${attraction.name}" cat-data="${attraction.category}" address-data="${attraction.address}" lat-data="${attraction.lattitude}" long-data="${attraction.longitude}" desc-data="${attraction.description}">Update</button></td>
                <td><button class="btn btn-danger btn-sm deleteBtn" id-data="${attraction.attraction_id}">Delete</button></td>
            `;
        });
    }
});
$(document).on("click", ".updateBtn", function() {
    var attractionId = $(this).attr('id-data');
    var attractionName = $(this).attr('name-data');
    var category = $(this).attr('cat-data');
    var longitude = $(this).attr('long-data');
    var lattitude = $(this).attr('lat-data');
    // var address = $(this).attr('address-data');
    var description = $(this).attr('desc-data');
    $('input[name="attraction"]').val(attractionName);

    // Hívjuk a getCategories függvényt, hogy a kategóriák betöltődjenek
    getCategories(function(data) {
        var categorySelect = $('select[name="category"]');
        var originalCategory = $('<option></option>')
            .val(category)
            .text(category);

        // Töröljük a korábbi opciókat és hozzáadjuk az eredeti kategóriát
        categorySelect.empty();
        categorySelect.append(originalCategory);

        // Hozzáadjuk az összes kategóriát az eredeti kategória után
        data.forEach(function(categories) {
            if (categories.category !== category) {
                var option = $('<option></option>')
                    .val(categories.category_id)
                    .text(categories.category);
                categorySelect.append(option);
            }
        });

        // Az alábbi rész az eredeti kódból származik
        $('input[name="longitude"]').val(longitude);
        $('input[name="lattitude"]').val(lattitude);
        // $('input[name="address"]').val(address);
        $('textarea[name="description"]').val(description);
        $('#updateWindow').css({
            display: "block"
        });
        $('.backdrop').css({
            display: "block"
        });
        $('.update_save').click(function() {
            var attractionName = $('input[name="attraction"]').val();
            var category = $('select[name="category"]').val();
            var longitude = $('input[name="longitude"]').val();
            var lattitude = $('input[name="lattitude"]').val();
            // var address = $('input[name="address"]').val();
            var description = $('textarea[name="description"]').val();
            $.post("../../assets/ajax/update_attraction.php", {
                attraction_id: attractionId,
                name: attractionName,
                category: category,
                longitude: longitude,
                lattitude: lattitude,
                // address: address,
                description: description
            }, function(data) {
                if (data.success) {
                    alert(data.msg);
                    location.reload();
                } else {
                    alert(data.msg);
                }
            }, 'json');

        });
        $('.close').click(function() {
            $('.modal').css({
                display: "none"
            });
            $('.backdrop').css({
                display: "none"
            });
        });
    });
});
$(document).on("click", ".deleteBtn", function() {
    var attractionId = $(this).attr('id-data');

    // Megjelenítjük a kérdéses ablakot
    $('.questionWindow').css({
        display: "block"
    });

    // Delete gombra kattintva elküldjük az attraction_id-t
    $('.deleteConf').click(function() {
        $.post("../../assets/ajax/delete_attraction.php", {
            attraction_id: attractionId
        }, function(data) {
            if (data.success) {
                alert(data.msg);
                window.location.reload();
            } else {
                alert(data.msg);
            }
        }, 'json');
    });
    $('.close').click(function() {
        $('.modals').css({
            display: "none"
        });
        $('.backdrop').css({
            display: "none"
        });
    });
});
/*Functions*/
function getCategories(callback) {
    $.ajax({
        url: '../../assets/ajax/get_categories.php',
        method: 'GET',
        dataType: 'json',
        success: function(data) {
            // Hívjuk meg a callback függvényt, és adjuk át a kategóriákat
            if (typeof callback === 'function') {
                callback(data);
            }
        },
        error: function() {
            alert('Hiba történt a kategóriák lekérése során.');
        }
    });
}