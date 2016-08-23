(function ($) {
    $(function () {

        $('.button-collapse').sideNav();

        //slider start
        $('.slider').slider({full_width: true});


        //slider start

        //scroll top start

        $(window).scroll(function () {
            if ($(this).scrollTop() > 1) {
                $('.scroll-top-wrapper').addClass("show");
            }
            else {
                $('.scroll-top-wrapper').removeClass("show");
            }
        });
        $(".scroll-top-wrapper").on("click", function () {
            $("html, body").animate({scrollTop: 0}, 800);
            return false;
        });
        //scroll top end

        //dropdown start


        $('.dropdown-button').dropdown({
                inDuration: 300,
                outDuration: 225,
                constrain_width: false, // Does not change width of dropdown to that of the activator
                hover: true, // Activate on hover
                gutter: 0, // Spacing from edge
                belowOrigin: false, // Displays dropdown below the button
                alignment: 'left' // Displays dropdown with edge aligned to the left of button
            }
        );

        //dropdown end

        // tooltip start
        $('.tooltipped').tooltip({delay: 20});
        // tooltip end

        //scrollspy end

        $('.scrollspy').scrollSpy();

        //scrollspy end

        //nice scroll start

        $("html").niceScroll({
            mousescrollstep: 50
        });
        // nice scroll end


//gallery start
        $('.materialboxed').materialbox();
//gallery end

//owl slider start  

        $("#project-projects").owlCarousel({
            items: 1,
            singleItem: true,
            itemsCustom: false,
            autoPlay: 5000
        });

<<<<<<< HEAD

//$(".hotel_inquiry a").on("click", function() {
//$("html, body").animate({ scrollTop: 0 }, 800);
//return false;
//});
=======
// owl slider end

>>>>>>> 324aebded839f4c5a8c35dee79abcb0df54ae779

        $(".hotel_inquiry a").on("click", function () {
            $("html, body").animate({scrollTop: 0}, 800);
            return false;
        });

$( ".hotel_inquiry a" ).click(function() {
$("html, body").animate({ scrollTop: 0 }, 800);
});

    }); // end of document ready
})(jQuery); // end of jQuery name space