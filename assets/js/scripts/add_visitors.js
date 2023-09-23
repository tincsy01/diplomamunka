
document.addEventListener("DOMContentLoaded", function () {
    var numberField = document.getElementById("number-field");
    var descriptionField = document.getElementById("description");
    var plusBtn = document.getElementById("plus-btn");
    var minusBtn = document.getElementById("minus-btn");
    var submitBtn = document.getElementById("submit-btn");
    var errorAlert = document.getElementById("error-alert");
    var successAlert = document.getElementById("success-alert");

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
        e.preventDefault();
        var currentValue = parseInt(numberField.value);
        var descriptionValue = descriptionField.value;

        fetch("../assets/ajax/add_visitors.php", {
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
                    throw new Error("Error");
                }
            })
            .then(function (data) {
                if (data.success) {
                    successAlert.style.display = "block";
                    errorAlert.style.display = "none";
                    window.location.reload();
                } else {
                    errorAlert.style.display = "block";
                    successAlert.style.display = "none";
                }
            })
            .catch(function (error) {
                errorAlert.style.display = "block";
                successAlert.style.display = "none";
                errorAlert.textContent = "Hiba történt: " + error.message;
            });
    });
});