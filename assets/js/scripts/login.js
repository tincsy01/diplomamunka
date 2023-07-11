document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("login-form").addEventListener("submit", function(event) {
        event.preventDefault(); // Az alapértelmezett form viselkedés megakadályozása (oldal frissítése)

        // Űrlapadatok összegyűjtése
        var username = document.getElementById("username").value;
        var password = document.getElementById("password").value;

        // AJAX kérés inicializálása
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "../../assets/ajax/login.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        // AJAX válasz eseménykezelője
        xhr.onload = function() {
            if (xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                if (response.success) {
                    window.location.href = "../../views_website/index.php";
                } else {
                    alert(response.message);
                }
            } else {
                // Hiba esetén megjelenítjük a hibaüzenetet
                alert("Hiba történt. Kérlek, próbáld újra.");
            }
        };

        // AJAX kérés elküldése az adatokkal
        xhr.send("username=" + encodeURIComponent(username) + "&password=" + encodeURIComponent(password));
    });
});