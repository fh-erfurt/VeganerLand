/*
======================
== Molham Al-khodari 
======================
*/

// check contact field

document.addEventListener('DOMContentLoaded', function() {
    var btnSubmit = document.getElementById('send');
    var inputName = document.getElementById('name');
    var inputEmail = document.getElementById('email');
    var inputSubject = document.getElementById('subject');
    var inputMessage = document.getElementById('message');

    console.log(inputName, inputEmail, inputSubject, inputMessage);

    if (btnSubmit) {
        btnSubmit.addEventListener('click', function(event) {
            var valid = true;

            if (inputEmail.value == "") {
                window.alert("please Enter your Email");
                inputEmail.focus({ preventScroll: true });
                inputEmail.style.border = "solid red"
                valid = false;
            }
            if (inputName.value == "") {
                window.alert("please Enter your name");
                inputName.focus({ preventScroll: true });
                inputName.style.border = "solid red"
                valid = false;
            }
            if (inputSubject.value == "") {
                window.alert("please Enter your subject");
                inputSubject.focus({ preventScroll: true });
                inputSubject.style.border = "solid red"
                valid = false;
            }
            if (inputMessage.value == "") {
                window.alert("please Enter your message");
                inputMessage.focus({ preventScroll: true });
                inputMessage.style.border = "solid red"
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