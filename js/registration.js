$(() => {
	
	/* Incomplete form validation */

    $('#registration').on('submit', () => {
        let login =     $('#login input').val();
        let pass1 =     $('#password input').val();
        let pass2 =     $('#confirmation input').val();
        let birthdate = $('#birthdate input').val();
        let email =     $('#email input').val();

        if (checkBirthdate(birthdate) &&
            checkLogin(login) &&
            checkEmail(email) &&
            checkPassword(pass1, pass2)
        ) {
            return true;
        }

        return false;

        function checkBirthdate(data) {
            let text = '';
            let message = $('#birthdate + div.alert');
            let date = new Date(data);

            if (!data) text += 'date should not be empty; ';
            if (isNaN(+date)) text += 'date should be correct value; ';
            if (date.getFullYear() < 1930) text += 'year should be greater that 1930; ';

            if (text) {
                if (!message.length) {
                    $('#birthdate').after(createMessage(text));
                } else {
                    // update text in alert message
                    message.html(text);
                }
                return false;
            }

            if (message.length) message.remove();
            return true;
        }

        function checkLogin(data) {
            let message = $('#login + div.alert');
            let regexp = /^[A-Za-z]([A-Za-z0-9-_]{3,11})$/;

            if (!regexp.test(data)) {
                if (!message.length) {
                    let text = 'login must start with a letter and must be between 3 and 6 characters long (inclusive)';
                    $('#login').after(createMessage(text));
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
            let message = $('#confirmation + div.alert');

            if ((pass1 == '') || (pass2 == '') || (pass1 !== pass2)) {
                if (!message.length) {
                    let text = 'passwords must match and not be empty';
                    $('#confirmation').after(createMessage(text));
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