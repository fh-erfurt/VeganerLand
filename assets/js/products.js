/*
========================
== Jessica Eckardtsberg 
========================
*/

// Sends the data of the Products to be added to the cart.
function sendProductData(event, formData = 'form') {
    event.stopPropagation();
    event.preventDefault();

    var form = document.getElementById(formData);
    var request = new XMLHttpRequest();

    // This somehow works on all pages that deal with products.
    // The cart has three entries in the form.
    if (form.length == 3) {
        request.open('POST', 'index.php?c=products&a=bargain&ajax=1', true);
    } else {
        request.open('POST', 'index.php?c=products&a=bargain&ajax=2', true);
    }

    request.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if (form.length == 3) {
                if (form[2].value) {
                    alert("Die Bestellung wurde erfolgreich in den Warenkorb gelegt.");
                } else {
                    alert("Es gab ein Problem beim bearbeiten ihrer Bestellung.");
                }
            } else {
                alert("Das Produkt wurde zu den Favoriten hinzugefügt.");
            }
        }
    }

    var requestForm = new FormData(form);

    request.send(requestForm);
}