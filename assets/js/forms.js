/*
======================
== Molham Al-khodari 
======================
*/

// HTML form validation can be performed automatically by the browser ... we did it also with js 

function validateForm() {
    var x = document.forms["myForm"]["fname"].value;
    if (x == "") {
        alert("Bitte geben Sie Ihren Namen an.");
        return false;
    }
}

// check password Firstname and Lastname in Signup

document.addEventListener('DOMContentLoaded', function() {
    var btnSubmit = document.getElementById('submit');
    var inputFirstname = document.getElementById('firstname');
    var inputLastname = document.getElementById('lastname');
    var inputPassword = document.getElementById('password');

    if (btnSubmit) {
        btnSubmit.addEventListener('click', function(event) {
            var valid = true;

            if (!inputFirstname || inputFirstname.value.length < 2) {
                window.alert("Bitte geben Sie Ihren Vornamen an.");
                firstName.focus({ preventScroll: true });
                firstName.style.border = "solid red"
                valid = false;
            }

            if (!inputLastname || inputLastname.value.length < 2) {
                window.alert("Bitte geben Sie Ihren Nachnamen an.");
                lastname.focus({ preventScroll: true });
                lastname.style.border = "solid red"
                valid = false;
            }

            // var regex = /^(?=.*?[A-Z].*?[A-Z])(?=.*?[a-z])(?=.*?[0-9].*?[0-9])(?=.*?[^\w\s].*?[^\w\s]).{12,}$/m;
            var regex = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[^\w\s]).{8,}$/m;
            if (!inputPassword || inputPassword.value.length < 8 || !inputPassword.value.macht(regex)) {
                valid = false;
            }

            if (password.value != passwordagain.value) {
                window.alert("Die Passwörter sind nicht identisch.");
                passwordagain.focus({ preventScroll: true });
                passwordagain.style.border = "solid red"
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
                            alert('Es gab einen Fehler bei der Erstellung des Kontos.');
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
});
