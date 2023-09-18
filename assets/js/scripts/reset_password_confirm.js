document.getElementById('login-form').addEventListener('submit', function (event) {
    event.preventDefault();

    const urlParams = new URLSearchParams(window.location.search);
    const code = urlParams.get('code');
    const newPassword = document.getElementById('newPassword').value;

    const xhr = new XMLHttpRequest();
    xhr.open('POST', '../assets/ajax/reset_password_confirm.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            console.log(xhr.responseText);
        }
    };
    const data = `code=${encodeURIComponent(code)}&newPassword=${encodeURIComponent(newPassword)}`;
    xhr.send(data);
});