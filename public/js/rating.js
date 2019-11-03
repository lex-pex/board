$(document).ready(function() {
    var rating_1 = $('#rating_1');
    var rating_2 = $('#rating_2');
    var rating_3 = $('#rating_3');
    var rating_4 = $('#rating_4');
    var rating_5 = $('#rating_5');
    var token = $("[name=csrf-token]").attr('content');
    var post_id = $('.rating-block').attr('data-rating-id');
    var stars = $('#stars');
    var displayedRating = 0;

    getRating();

    function getRating() {
        stars.animate({"margin": "5px", "font-size": "20"}, 1000);
        $.post('/rating/index',
            {_token: token, id: post_id},
            function (data) {
                setRate(+data);
            }
        );
        stars.animate({"margin": "1px", "font-size": "18"}, 1000);
    }

    function setRate(rate) {
        displayedRating = rate;
        drawRate(rate);
    }

    function drawRate() {
        switch (displayedRating) {
            case 1: ratingOne();
            break;
            case 2: ratingTwo();
            break;
            case 3: ratingThree();
            break;
            case 4: ratingFour();
            break;
            case 5: ratingFive();
            break;
        }
    }

    function ratingOne() {
        rating_1.removeClass('fa-star-o').addClass("fa-star");
        rating_2.removeClass('fa-star').addClass("fa-star-o");
        rating_3.removeClass('fa-star').addClass("fa-star-o");
        rating_4.removeClass('fa-star').addClass("fa-star-o");
        rating_5.removeClass('fa-star').addClass("fa-star-o");
    }

    function ratingTwo() {
        rating_1.removeClass('fa-star-o').addClass("fa-star");
        rating_2.removeClass('fa-star-o').addClass("fa-star");
        rating_3.removeClass('fa-star').addClass("fa-star-o");
        rating_4.removeClass('fa-star').addClass("fa-star-o");
        rating_5.removeClass('fa-star').addClass("fa-star-o");
    }

    function ratingThree() {
        rating_1.removeClass('fa-star-o').addClass("fa-star");
        rating_2.removeClass('fa-star-o').addClass("fa-star");
        rating_3.removeClass('fa-star-o').addClass("fa-star");
        rating_4.removeClass('fa-star').addClass("fa-star-o");
        rating_5.removeClass('fa-star').addClass("fa-star-o");
    }

    function ratingFour() {
        rating_1.removeClass('fa-star-o').addClass("fa-star");
        rating_2.removeClass('fa-star-o').addClass("fa-star");
        rating_3.removeClass('fa-star-o').addClass("fa-star");
        rating_4.removeClass('fa-star-o').addClass("fa-star");
        rating_5.removeClass('fa-star').addClass("fa-star-o");
    }

    function ratingFive() {
        rating_1.removeClass('fa-star-o').addClass("fa-star");
        rating_2.removeClass('fa-star-o').addClass("fa-star");
        rating_3.removeClass('fa-star-o').addClass("fa-star");
        rating_4.removeClass('fa-star-o').addClass("fa-star");
        rating_5.removeClass('fa-star-o').addClass("fa-star");
    }

    rating_1.hover(function(){
        ratingOne();
    });
    rating_1.mouseleave(function(){
        rating_1.removeClass('fa-star').addClass("fa-star-o");
        drawRate();
    });
    rating_2.hover(function(){
        ratingTwo();
    });
    rating_2.mouseleave(function(){
        rating_1.removeClass('fa-star').addClass("fa-star-o");
        rating_2.removeClass('fa-star').addClass("fa-star-o");
        drawRate();
    });
    rating_3.hover(function(){
        ratingThree();
    });
    rating_3.mouseleave(function(){
        rating_1.removeClass('fa-star').addClass("fa-star-o");
        rating_2.removeClass('fa-star').addClass("fa-star-o");
        rating_3.removeClass('fa-star').addClass("fa-star-o");
        drawRate();
    });
    rating_4.hover(function(){
        ratingFour();
    });
    rating_4.mouseleave(function(){
        rating_1.removeClass('fa-star').addClass("fa-star-o");
        rating_2.removeClass('fa-star').addClass("fa-star-o");
        rating_3.removeClass('fa-star').addClass("fa-star-o");
        rating_4.removeClass('fa-star').addClass("fa-star-o");
        drawRate();
    });
    rating_5.hover(function(){
        ratingFive();
    });
    rating_5.mouseleave(function(){
        rating_1.removeClass('fa-star').addClass("fa-star-o");
        rating_2.removeClass('fa-star').addClass("fa-star-o");
        rating_3.removeClass('fa-star').addClass("fa-star-o");
        rating_4.removeClass('fa-star').addClass("fa-star-o");
        rating_5.removeClass('fa-star').addClass("fa-star-o");
        drawRate();
    });

    rating_1.click(function () {
        ratingStore(1);
        drawRate();
        setTimeout(getRating, 1500);
    });

    rating_2.click(function () {
        ratingStore(2);
        drawRate();
        setTimeout(getRating, 1500);
    });

    rating_3.click(function () {
        ratingStore(3);
        drawRate();
        setTimeout(getRating, 1500);
    });

    rating_4.click(function () {
        ratingStore(4);
        drawRate();
        setTimeout(getRating, 1500);
    });

    rating_5.click(function () {
        ratingStore(5);
        drawRate();
        setTimeout(getRating, 1500);
    });

    function ratingStore(rate) {
        $.post('/rating/store', { _token: token, id: post_id, rating: rate },
            function (data) {
                if (data) alert(data);
            });
        displayedRating = rate;
    }
});












