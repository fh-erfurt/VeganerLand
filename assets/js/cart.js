/*
======================
== Molham Al-khodari 
======================
*/

// check password email and password right

document.addEventListener('DOMContentLoaded', function() {
    var btnSend = document.getElementById('send');
    var inputStreet = document.getElementById('street');
    var inputNumber = document.getElementById('number');
    var inputZip = document.getElementById('zip');
    var inputCity = document.getElementById('city');

    if (btnSend) {
        btnSend.addEventListener('click', function(event) {
            var valid = true;

            if (inputStreet.value == "" || inputNumber.value == "" || inputZip.value == "" || inputCity.value == "") {
                window.alert("All field are required!");
                if (inputStreet.value == "") {
                    inputStreet.focus({ preventScroll: true });
                    inputStreet.style.border = "solid red"
                }
                if (inputNumber.value == "") {
                    inputNumber.focus({ preventScroll: true });
                    inputNumber.style.border = "solid red"
                }
                if (inputZip.value == "") {
                    inputZip.focus({ preventScroll: true });
                    inputZip.style.border = "solid red"
                }
                if (inputCity.value == "") {
                    inputCity.focus({ preventScroll: true });
                    inputCity.style.border = "solid red"
                }
                valid = false;
            }

            if (valid == false) {
                event.preventDefault(); // disable default event
                event.stopPropagation(); // disable event handling in hir
            }

            return valid;
        });
    }
});