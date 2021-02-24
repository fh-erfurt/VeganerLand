/*
======================
== Molham Al-khodari 
======================
*/

// HTML form validation can be performed automatically by the browser ... we did it also with js 

function validateForm() {
    var x = document.forms["myForm"]["fname"].value;
    if (x == "") {
        alert("Geben Sie bitte Ihren Namen an.");
        return false;
    }
}

// check password Firstname and Lastname in Signup

document.addEventListener('DOMContentLoaded', function() {
    var btnSubmit = document.getElementById('submit');
    var inputFirstname = document.getElementById('firstname');
    var inputLastname = document.getElementById('lastname');
    var inputEmail = document.getElementById('email');
    var inputPassword = document.getElementById('password');
    var inputPasswordagain = document.getElementById('passwordagain');

    if (btnSubmit) {
        btnSubmit.addEventListener('click', function(event) {
            var valid = true;

            if (!inputFirstname || inputFirstname.value.length < 2) {
                window.alert("Geben Sie bitte Ihren Vornamen an.");
                inputFirstname.focus({ preventScroll: true });
                inputFirstname.style.border = "solid red"
                valid = false;
            }

            if (!inputLastname || inputLastname.value.length < 2) {
                window.alert("Geben Sie bitte Ihren Familiennamen an.");
                inputLastname.focus({ preventScroll: true });
                inputLastname.style.border = "solid red";
                valid = false;
            }

            if (inputEmail.value == "") {
                window.alert("Geben Sie bitte Ihre Email an.");
                inputEmail.focus({ preventScroll: true });
                inputEmail.style.border = "solid red";
                valid = false;
            }

            var regex = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[^\w\s]).{8,}$/m;
            if (!inputPassword || inputPassword.value.length < 8 || !inputPassword.value.macht(regex)) {
                window.alert("Das Passwort ist nicht sicher genug.");
                inputPassword.focus({ preventScroll: true });
                inputPassword.style.border = "solid red";
                inputPasswordagain.focus({ preventScroll: true });
                inputPasswordagain.style.border = "solid red";
                valid = false;
            }

            if (inputPassword.value != inputPasswordagain.value) {
                window.alert("Die Passwörter müssen identisch sein.");
                inputPassword.focus({ preventScroll: true });
                inputPassword.style.border = "solid red";
                inputPasswordagain.focus({ preventScroll: true });
                inputPasswordagain.style.border = "solid red";
                valid = false;
            }

            if (window.XMLHttpRequest) {
                valid = false;
                event.preventDefault(); // disable default event
                event.stopPropagation(); // disable event handling in hir

                var request = new XMLHttpRequest();
                request.open("POST", '?c=registration&a=registration');

                request.onreadystatechange = function() {
                    if (this.readyState == XMLHttpRequest.DONE) {
                        if (this.status == 200) {
                            window.location = 'c=pages&a=homepage';
                        } else if (this.status == 404) {
                            alert(this.responseText);
                        } else {
                            alert('Es gab einen Fehler beim Erstellen des Kontos.');
                        }
                    }
                };
                var form = document.getElementById('register');
                request.send(new FormData(form));
            }

            return valid;
        });
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
