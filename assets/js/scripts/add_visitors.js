document.addEventListener("DOMContentLoaded", function () {
    var numberField = document.getElementById("number-field");
    var descriptionField = document.getElementById("description"); // Hozzáadott mező
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

    submitBtn.addEventListener("click", function (e) {
        e.preventDefault(); // Megakadályozza az űrlap alapértelmezett viselkedését (oldalfrissítés)

        var currentValue = parseInt(numberField.value);
        var descriptionValue = descriptionField.value; // TextArea érték

        // AJAX kérés fetch API-val
        fetch("../../assets/ajax/add_visitors.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded",
            },
            body: new URLSearchParams({
                visitors: currentValue,
                description: descriptionValue,
            }),
        })
            .then(function (response) {
                if (response.ok) {
                    return response.json();
                } else {
                    throw new Error("Hiba történt a kérés során.");
                }
            })
            .then(function (data) {
                if (data.success) {
                    alert("Látogatók száma sikeresen frissítve.");
                    window.location.reload();
                } else {
                    alert("Hiba történt a látogatók számának frissítése közben.");
                }
            })
            .catch(function (error) {
                alert("Hiba történt: " + error.message);
            });
    });
});
