(function() {
    $(document).foundation();
    $(document).ready(function() {

        // SVG fallback
        if (!Modernizr.svg)
        {
            $("img[src$='.svg']").each(function() {
                $(this).attr('src', $(this).data('fallback'));
            });
        }

        // Numpad keypad
        if (matchMedia)
        {
            if (window.matchMedia("(max-device-width: 768px), (max-device-width: 1024px) and (orientation: portrait)").matches)
            {
                var inputs = document.getElementsByClassName('mobile-numpad');
                for (var i = 0; i < inputs.length; i++)
                {
                    inputs[i].setAttribute("pattern","[0-9]*");
                    inputs[i].setAttribute("type","number");
                }
            }
        }

        // External links
        $('a[rel=external]').click(function() {
            window.open($(this).attr('href'));
            return false;
        });

        // Slick carousel
        $('.article-main').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            dots: true,
            infinite: true,
            speed: 500,
            fade: true,
            cssEase: 'linear',
            autoplay: true,
            prevArrow: $('.article-left'),
            nextArrow: $('.article-right'),
            responsive: [
                {
                    breakpoint: (16 * 64), // Medium breakpoint is 64em in Foundation, base font size is 16px
                    settings: {
                        dots: false
                    }
                }
            ]
        });

        // Off-canvas navigation icon switch
        $('.right-off-canvas-toggle').on('click', function() {
            $(this).toggleClass('menu-open');
        });

        // Weather
        // Met Office API Key
        /*var apiKey = 'a2166243-7f03-4151-9e07-de9e8ac48ea3';
        var url = 'http://datapoint.metoffice.gov.uk/public/data/val/wxobs/all/json/3772?res=hourly&key=' + apiKey;

        var request = $.ajax({
            url: url,
            dataType: "json"
        });

        console.log(request);*/

    });
})();
