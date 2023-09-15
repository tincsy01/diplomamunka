document.addEventListener('DOMContentLoaded', function() {
    var urlParams = new URLSearchParams(window.location.search);
    var code = urlParams.get('code');
    console.log(code);

    if (code) {
        $.ajax({
            url: '../assets/ajax/active.php',
            method: 'GET',
            data: { code: code },
            dataType: 'json',
            success: function(response) {
                var cardTitle = $('.cardWelcome .card__title');
                var messageSpan = $('<span>' + response.message + '</span>');
                cardTitle.html(messageSpan);
            },
            error: function(xhr, status, error) {
                console.error('AJAX hiba:', error);
            }
        });
    }
});