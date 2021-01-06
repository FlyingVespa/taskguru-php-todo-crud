    //scroll fucntion
    $(window).scroll(function() {
        let position = $(window).scrollTop();

        if (position >= 250) {
            $('#top').addClass('show');
        } else {
            $('#top').removeClass('show');
        }
    });
    $('#top').click(function() {
        $('html, body').animate({
            scrollTop: 0
        }, 800);
    });

  