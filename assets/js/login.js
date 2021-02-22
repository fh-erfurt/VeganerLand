/*
======================
== Molham Al-khodari 
======================
*/

// check email

document.addEventListener('DOMContentLoaded', function() {
    var btnSubmit = document.getElementById('submit');
    var btnSubmitResetPassord = document.getElementById('submitResetPassword');
    var inputEmail = document.getElementById('email');
    var inputPassword = document.getElementById('password');
    var inputPasswordagain = document.getElementById('passwordagain');

    if (btnSubmit) {
        btnSubmit.addEventListener('click', function(event) {
            var valid = true;

            if (inputEmail.value == "") {
                window.alert("please Enter your Email");
                inputEmail.focus({ preventScroll: true });
                inputEmail.style.border = "solid red";
                valid = false;
            }

            if (inputPassword.value == "") {
                window.alert("please Enter your Password");
                inputPassword.focus({ preventScroll: true });
                inputPassword.style.border = "solid red";
                valid = false;
            }

            if (valid === false) {
                event.preventDefault(); // disable default event
                event.stopPropagation(); // disable event handling in hir
            }

            return valid;
        });
    }
    if (btnSubmitResetPassord) {

        var regex = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[^\w\s]).{8,}$/m;
        if (!inputPassword || inputPassword.value.length < 8 || !inputPassword.value.macht(regex)) {
            window.alert("the Passwords not safe enough");
            inputPassword.focus({ preventScroll: true });
            inputPassword.style.border = "solid red";
            inputPasswordagain.focus({ preventScroll: true });
            inputPasswordagain.style.border = "solid red";
            valid = false;
        }

        if (inputPassword.value != inputPasswordagain.value) {
            window.alert("the Passwords must be the same");
            inputPassword.focus({ preventScroll: true });
            inputPassword.style.border = "solid red";
            inputPasswordagain.focus({ preventScroll: true });
            inputPasswordagain.style.border = "solid red";
            valid = false;
        }
    }


    if (inputPassword) {
        inputPassword.addEventListener('keyup', function() {
            var regex1 = /^(?=.*?[a-z]).{4,}$/m;
            var regex2 = /^(?=.*?[A-Z])(?=.*?[a-z]).{6,}$/m;
            var regex3 = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[^\w\s]).{8,}$/m;

            if (inputPassword.value.match(regex3)) {
                inputPassword.style.border = '2px solid green';
            } else if (inputPassword.value.match(regex2)) {
                inputPassword.style.border = '2px solid blue';
            } else if (inputPassword.value.match(regex1)) {
                inputPassword.style.border = '2px solid yellow';
            } else {
                inputPassword.style.border = '2px solid red';
            }
        });
    }

    if (inputPasswordagain) {
        inputPasswordagain.addEventListener('keyup', function() {
            var regex1 = /^(?=.*?[a-z]).{4,}$/m;
            var regex2 = /^(?=.*?[A-Z])(?=.*?[a-z]).{6,}$/m;
            var regex3 = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[^\w\s]).{8,}$/m;

            if (inputPasswordagain.value.match(regex3)) {
                inputPasswordagain.style.border = '2px solid green';
            } else if (inputPasswordagain.value.match(regex2)) {
                inputPasswordagain.style.border = '2px solid blue';
            } else if (inputPasswordagain.value.match(regex1)) {
                inputPasswordagain.style.border = '2px solid yellow';
            } else {
                inputPasswordagain.style.border = '2px solid red';
            }
        });
    }

});
