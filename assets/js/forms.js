/*
================================
== Molham Al-khodari 31.12.2020
================================
*/

// tests 

alert("Js is hier!");

// es macht nicht wirklich sinn an der stelle, cos HTML form validation can be performed automatically by the browser ...

// function validateForm() {
//     var x = document.forms["myForm"]["fname"].value;
//     if (x == "") {
//         alert("Name must be filled out");
//         return false;
//     }
// }

// check password Firstname and Lastname in Signup

document.addEventListener('DOMContentLoaded', function() {
    var btnSubmit = document.getElementById('submitRegister');
    var inputFirstname = document.getElementById('firstname');
    var inputLastname = document.getElementById('lastname');
    var inputPassword = document.getElementById('password');

    if (btnSubmit) {
        btnSubmit.addEventListener('click', function(event) {
            var valid = ture;
            if (!inputFirstname || inputFirstname.value.length < 2) {
                valid = false;
            }

            if (!inputLastname || inputLastname.value.length < 2) {
                valid = false;
            }

            // var regex = /^(?=.*?[A-Z].*?[A-Z])(?=.*?[a-z])(?=.*?[0-9].*?[0-9])(?=.*?[^\w\s].*?[^\w\s]).{12,}$/m;
            var regex = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[^\w\s]).{8,}$/m;
            if (!inputPassword || inputPassword.value.length < 8 || !inputPassword.value.macht(regex)) {
                valid = false;
            }

            if (valid === false) {
                event.precentDefault(); // disable default event
                event.stopPropagation(); // disable event handling in hir
            }

            return valid;
        });
    }

    if (inputPassword) {
        inputPassword.addEventListener('keyup', function() {

            var regex1 = /^(?=.*?[a-z]).{4,}$/m;
            var regex2 = /^(?=.*?[A-Z])(?=.*?[a-z]).{6,}$/m;
            var regex3 = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[^\w\s]).{8,}$/m;

            if (String.match(regex3)) {
                inputPassword.style.border = '2px solid green';
            } else if (str.match(regex2)) {
                inputPassword.style.border = '2px solid blue';
            } else if (str.match(regex1)) {
                inputPassword.style.border = '2px solid yellow';
            } else {
                inputPassword.style.border = '2px solid red';
            }
        });
    }
});