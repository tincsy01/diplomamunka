document.getElementById('login-form').addEventListener('submit', function (event) {
    event.preventDefault(); // Ne küldje el az űrlapot hagyományos módon

    // Kinyerjük a "code" GET paramétert az URL-ből
    const urlParams = new URLSearchParams(window.location.search);
    const code = urlParams.get('code');

    // Kinyerjük a jelszó mező értékét
    const newPassword = document.getElementById('newPassword').value;

    // AJAX kérés elküldése
    const xhr = new XMLHttpRequest();
    xhr.open('POST', '../assets/ajax/reset_password_confirm.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Itt kezelhetjük a választ, ha szükséges
            console.log(xhr.responseText);
        }
    };

    // Elküldjük a "code" és a jelszó mező értékét
    const data = `code=${encodeURIComponent(code)}&newPassword=${encodeURIComponent(newPassword)}`;
    xhr.send(data);
});