document.addEventListener("DOMContentLoaded", function() {
    const urlParams = new URLSearchParams(window.location.search);
    const attractionId = urlParams.get('attraction_id');

    if (attractionId) {
        const option1 = document.querySelector(".option-1");
        const option2 = document.querySelector(".option-2");

        // Inicializálás az AJAX válasz alapján
        checkFavouriteStatus(attractionId, option1, option2);
    }
});

function checkFavouriteStatus(attractionId, option1, option2) {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", `../../assets/ajax/get_favourite.php?attraction_id=${attractionId}`, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            const response = JSON.parse(xhr.responseText);

            if (response) {
                option1.style.display = "none";
                option2.style.display = "block";
            } else {
                option1.style.display = "block";
                option2.style.display = "none";
            }
        }
    };
    xhr.send();
}
