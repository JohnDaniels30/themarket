$(() => {

    /* Smooth Scrolling */

    $('a[href*="#"]').click(function(event) {
        let target = $(this.hash);
        target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');

        if (target.length) {
            event.preventDefault();

            $('html, body').animate(
              { scrollTop: target.offset().top - $('nav').outerHeight() }, 
              1000, 
              () => {
                  let $target = $(target);
                  $target.focus();
                  if ($target.is(":focus")) {
                    return false;
                  } else {
                    $target.attr('tabindex','-1');
                    $target.focus();
                  }
            });
        }
    });

    /* Clock widget */

    (function clockWidget() {
        function checkTime(i) {
            return (i < 10) ? ('0' + i) : i;
        }

        let today = new Date();
        let h = today.getHours();
        let m = today.getMinutes();
        let s = today.getSeconds();
        m = checkTime(m);
        s = checkTime(s);
        $('#clock').html(h + ":" + m + ":" + s);

        setTimeout(clockWidget, 500);
    })();

    /* Make sure footer isn't overlaping body content */

    $('body').css('padding-bottom', $('footer').height() + 30);
    $(window).on('resize', () => {
        $('body').css('padding-bottom', $('footer').height() + 30);
    });

});