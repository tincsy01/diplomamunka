$(document).ready(function() {
    function getComments() {
        var urlParams = new URLSearchParams(window.location.search);
        var attractionId = urlParams.get('attraction_id');
        $.ajax({
            url: '../../assets/ajax/get_comments.php',
            type: 'GET',
            dataType: 'json',
            data: { attraction_id: attractionId },
            success: function(response) {
                if (response.success) {
                    var commentsList = $('#comments');

                    // Kommentek kilistázása
                    var comments = response.comments;
                    var commentsHtml = '';
                    for (var i = 0; i < comments.length; i++) {
                        var comment = comments[i];
                        commentsHtml += '<li class="comment">';
                        commentsHtml += '<p>' + comment.comment + '</p>';
                        commentsHtml += '<p class="comment-author">' + comment.username + '</p>';
                        commentsHtml += '<p class="comment-date">' + comment.date + '</p>';
                        commentsHtml += '</li>';
                    }

                    commentsList.html(commentsHtml);
                } else {
                    console.error('Failed to load comments.');
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX request failed:', error);
            }
        });
    }
    function checkVisit() {
        var urlParams = new URLSearchParams(window.location.search);
        var attractionId = urlParams.get('attraction_id');

        $.ajax({
            url: '../../assets/ajax/check_visit.php',
            type: 'GET',
            dataType: 'json',
            data: { attraction_id: attractionId },
            success: function(response) {
                if (response.visited) {
                    // Felhasználó már volt az attrakciónál, lehetőség a komment írására
                    var commentForm = '<form id="comment-form" method="post" class="form" id="login-form">';
                    commentForm += '<textarea name="comment" placeholder="Leave a comment.." id="comment" class="form-control"></textarea>';
                    commentForm += '<input type="hidden" name="attraction_id" value="' + attractionId + '">';

                    // Csillagok hozzáadása az űrlaphoz
                    commentForm += '<div class="rating">';
                    commentForm += '<input value="5" name="rate" id="star5" type="radio">';
                    commentForm += '<label title="text" for="star5"></label>';
                    commentForm += '<input value="4" name="rate" id="star4" type="radio">';
                    commentForm += '<label title="text" for="star4"></label>';
                    commentForm += '<input value="3" name="rate" id="star3" type="radio" checked="">';
                    commentForm += '<label title="text" for="star3"></label>';
                    commentForm += '<input value="2" name="rate" id="star2" type="radio">';
                    commentForm += '<label title="text" for="star2"></label>';
                    commentForm += '<input value="1" name="rate" id="star1" type="radio">';
                    commentForm += '<label title="text" for="star1"></label>';
                    commentForm += '</div>';

                    commentForm += '<button type="submit" class="btn btn-bd-primary">Submit</button>';
                    commentForm += '</form>';

                    $('#comment-section').html(commentForm);

                    // Az űrlap elküldése AJAX segítségével
                    $('#comment-form').submit(function(e) {
                        e.preventDefault();

                        var formData = $(this).serialize();

                        $.ajax({
                            url: '../../assets/ajax/add_comment.php', // Frissítsd az URL-t a PHP fájlnak
                            type: 'POST',
                            dataType: 'json',
                            data: formData,
                            success: function(response) {
                                if (response.success) {
                                    // Komment sikeresen elküldve, frissítsük a kommenteket
                                    getComments();
                                    // Töröljük a mezőket vagy csinálj valami egyéb módosítást, ha szükséges
                                    $('#comment').val('');
                                    $('input[type="radio"]').prop('checked', false);
                                } else {
                                    console.error('Failed to submit comment and rating.');
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error('AJAX request failed:', error);
                            }
                        });
                    });
                } else {
                    // Felhasználó még nem volt az attrakciónál, nem lehet kommentet írni
                    var notVisitedMessage = '<p>You need to visit this attraction to be able to leave a comment.</p>';

                    $('#comment-section').html(notVisitedMessage);
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX request failed:', error);
            }
        });
    }

    // Hívjuk meg a függvényeket
    getComments();
    checkVisit();
});