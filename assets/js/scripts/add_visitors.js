document.addEventListener("DOMContentLoaded", function () {
    var numberField = document.getElementById("number-field");
    var plusBtn = document.getElementById("plus-btn");
    var minusBtn = document.getElementById("minus-btn");
    var submitBtn = document.getElementById("submit-btn");

    plusBtn.addEventListener("click", function () {
        var currentValue = parseInt(numberField.value);
        numberField.value = currentValue + 1;
    });

    minusBtn.addEventListener("click", function () {
        var currentValue = parseInt(numberField.value);
        if (currentValue > 0) {
            numberField.value = currentValue - 1;
        }
    });

    submitBtn.addEventListener("click", function () {
        var currentValue = parseInt(numberField.value);

        // AJAX kérés inicializálása
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "../../assets/ajax/add_visitors.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        // AJAX válasz eseménykezelője
        xhr.onload = function () {
            if (xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                if (response.success) {
                    alert("Látogatók száma sikeresen frissítve.");
                } else {
                    alert("Hiba történt a látogatók számának frissítése közben.");
                }
            } else {
                alert("Hiba történt. Kérlek, próbáld újra.");
            }
        };

        // AJAX kérés elküldése az adatokkal
        xhr.send("visitors=" + currentValue);
    });
});