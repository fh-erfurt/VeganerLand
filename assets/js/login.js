/*
======================
== Molham Al-khodari 
======================
*/

// check email

document.addEventListener('DOMContentLoaded', function() {
    var btnSubmit = document.getElementById('submit');
    var inputEmail = document.getElementById('email');

    if (btnSubmit) {
        btnSubmit.addEventListener('click', function(event) {
            var valid = true;

            if (inputEmail.value == "") {
                window.alert("please Enter your Email");
                inputEmail.focus({ preventScroll: true });
                inputEmail.style.border = "solid red"
                valid = false;
            }

            if (valid === false) {
                event.preventDefault(); // disable default event
                event.stopPropagation(); // disable event handling in hir
            }

            return valid;
        });
    }
});
