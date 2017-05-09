$(function() {

    /* Smooth Scrolling */

    $('a[href*="#"]').click((event) => {
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

    (function startTime() {
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

        setTimeout(startTime, 500);
    })();

    /* Make sure footer isn't overlaping body content */

    $('body').css('padding-bottom', $('footer').height() + 30);
    $(window).on('resize', function() {
        $('body').css('padding-bottom', $('footer').height() + 30);
    });

    /* Incomplete form validation */

    $('#submit').click(() => {
        let date =      $('#birth input').val();
        let username =  $('#username input').val();
        let email =     $('#email input').val();
        let pass1 =     $('#password input').val();
        let pass2 =     $('#repeat input').val();

        if (checkBirth(date) &&
            checkUsername(username) &&
            checkEmail(email) &&
            checkPassword(pass1, pass2)
        ) {
            // request to the server
            return true;
        }

        return false;

        function checkBirth(data) {
            let text = '';
            let message = $('#birth + div.alert');
            let date = new Date(data);

            if (!data) text += 'date should not be empty; ';
            if (isNaN(+date)) text += 'date should be correct value; ';
            if (date.getFullYear() < 1930) text += 'year should be greater that 1930; ';

            if (text) {
                if (!message.length) {
                    $('#birth').after(createMessage(text));
                } else {
                    // update text in alert message
                    message.html(text);
                }
                return false;
            }

            if (message.length) message.remove();
            return true;
        }

        function checkUsername(data) {
            let message = $('#username + div.alert');
            let regexp = /^[A-Za-z]([A-Za-z0-9-_]{2,5})$/;

            if (!regexp.test(data)) {
                if (!message.length) {
                    let text = 'username must start with a letter and must be between 3 and 6 characters long (inclusive)';
                    $('#username').after(createMessage(text));
                }
                return false;
            }

            if (message.length) message.remove();
            return true;
        }

        function checkEmail(data) {
            let message = $('#email + div.alert');
            let regexp = /^([A-Za-z]{2,32})@([\da-z\.-]{2,10})\.([a-z\.]{2,6})$/;

            if (!regexp.test(data)) {
                if (!message.length) {
                    let text = 'first part must consist only letters, then \'@\' symbol and correct domain (with dot and 16 characters maximum)';
                    $('#email').after(createMessage(text));
                }
                return false;
            }

            if (message.length) message.remove();
            return true;
        }

        function checkPassword(pass1, pass2) {
            let message = $('#repeat + div.alert');

            if ((pass1 != '') && (pass2 != '') && (pass1 !== pass2)) {
                if (!message.length) {
                    let text = 'passwords must match and not be empty';
                    $('#repeat').after(createMessage(text));
                }
                return false;
            }

            if (message.length) message.remove();
            return true;
        }

        function createMessage(text) {
            let message = $("<div></div>").text(text);
            message.addClass('alert alert-danger');
            return message;
        }
    });

});