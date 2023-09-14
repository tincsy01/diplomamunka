document.addEventListener('DOMContentLoaded', function() {
    var form = document.getElementById('registration-form');

    form.addEventListener('submit', function(event) {
        event.preventDefault();

        var name = document.getElementById('name').value;
        var username = document.getElementById('username').value;
        var email = document.getElementById('email').value;
        var password = document.getElementById('password').value;
        var address = document.getElementById('address').value;
        var phone = document.getElementById('phone').value;

        if (name === '' || username === '' || email === '' || password === '' || address === '' || phone === '') {
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
        xhr.open('POST', '../assets/ajax/registration.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        var data = 'name=' + encodeURIComponent(name) +
            '&username=' + encodeURIComponent(username) +
            '&email=' + encodeURIComponent(email) +
            '&password=' + encodeURIComponent(password) +
            '&address=' + encodeURIComponent(address) +
            '&phone=' + encodeURIComponent(phone);

        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                if (response.success) {
                    window.location.reload();
                    alert(response.message);
                } else {
                    alert('An error occurred: ' + response.message);
                }
            }
        };

        xhr.send(data);
    });
});

function validateEmail(email) {
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}
