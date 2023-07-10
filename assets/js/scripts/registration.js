document.addEventListener('DOMContentLoaded', function() {
    var form = document.getElementById('registration-form');

    form.addEventListener('submit', function(event) {
        event.preventDefault();

        var name = document.getElementById('name').value;
        var username = document.getElementById('username').value;
        var email = document.getElementById('email').value;
        var password = document.getElementById('password').value;
        var address = document.getElementById('address').value;

        if (name === '' || username === '' || email === '' || password === '' || address === '') {
            alert('All fields must be filled in!');
            return;
        }

        if (!validateEmail(email)) {
            alert('Invalid email address!');
            return;
        }
        if (password.length < 7) {
            alert('The password must be at least 7 characters long!');
            return;
        }

        var xhr = new XMLHttpRequest();
        xhr.open('POST', '../../assets/ajax/registration.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded'); // Módosítás itt

        var data = 'name=' + encodeURIComponent(name) +
            '&username=' + encodeURIComponent(username) +
            '&email=' + encodeURIComponent(email) +
            '&password=' + encodeURIComponent(password) +
            '&address=' + encodeURIComponent(address);

        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                console.log(response);

            }
        };

        xhr.send(data);
    });
});

function validateEmail(email) {
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}
