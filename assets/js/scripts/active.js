document.addEventListener('DOMContentLoaded', function() {
    // Kiolvassuk a 'code' értékét a URL-ből
    var urlParams = new URLSearchParams(window.location.search);
    var code = urlParams.get('code');

    if (code) {
        // Elküldjük a kódot az 'active.php'-ra AJAX segítségével
        $.ajax({
            url: '../../assets/ajax/active.php',
            method: 'GET',
            data: { code: code },
            dataType: 'html',
            success: function(response) {
                // Az AJAX választ betöltjük a '.card__title' elembe
                $('.card__title').html(response);
            },
            error: function(xhr, status, error) {
                console.error('AJAX hiba:', error);
            }
        });
    }
});