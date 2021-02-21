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
    var cart = document.getElementById('cartCount');
    var count = cart.innerHTML;
    
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
                    count++;
                    cart.innerHTML = count;
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

function changeDisplay(index, tag, filter, call = 0) {
    var products = document.getElementById('products');
    var li = products.getElementsByTagName('li');

    if (call == filter.length) {
        li[index].style.display = "inline-block";
    } else {
        var currentTag = tag[call];
        var check = li[index].getElementsByTagName('p')[currentTag].textContent;
        if (check.indexOf(filter[call]) == -1) {
            li[index].style.display = "none";
            alert("Nichts da!");
        } else {
            call++;
            changeDisplay(index, tag, filter, call);
        }
    }
}

function reload(event) {
    event.stopPropagation();
    event.preventDefault();

    var form = document.getElementById('form');
    var bioFilter = [form[0].checked, 0, "Bio"];
    var regionalFilter = [form[1].checked, 0, "Regional"];
    var priceFilter = [form[2].value, 1, form[2].value];
    var weightFilter = [form[3].value, 0, form[3].value];

    var contentList = document.getElementById('products');
    var content = contentList.getElementsByTagName('li');
    var i = 0;

    switch (true) {
        case bioFilter[0] && regionalFilter[0] && priceFilter[0] != "" && weightFilter[0] != "":
            var tagList = [bioFilter[1], regionalFilter[1], priceFilter[1], weightFilter[1]];
            var filterList = [bioFilter[2], regionalFilter[2], priceFilter[2], weightFilter[2]];
            for (i; i < content.length; i++) {
                changeDisplay(i, tagList, filterList);
            }
            break;
        case bioFilter[0] && regionalFilter[0] && priceFilter[0] != "":
            var tagList = [bioFilter[1], regionalFilter[1], priceFilter[1]];
            var filterList = [bioFilter[2], regionalFilter[2], priceFilter[2]];
            for (i; i < content.length; i++) {
                changeDisplay(i, tagList, filterList);
            }
            break;
        case bioFilter[0] && regionalFilter[0] && weightFilter[0] != "":
            var tagList = [bioFilter[1], regionalFilter[1], weightFilter[1]];
            var filterList = [bioFilter[2], regionalFilter[2], weightFilter[2]];
            for (i; i < content.length; i++) {
                changeDisplay(i, tagList, filterList);
            }
            break;
        case bioFilter[0] && priceFilter[0] != "" && weightFilter[0] != "":
            var tagList = [bioFilter[1], priceFilter[1], weightFilter[1]];
            var filterList = [bioFilter[2], priceFilter[2], weightFilter[2]];
            for (i; i < content.length; i++) {
                changeDisplay(i, tagList, filterList);
            }
            break;
        case regionalFilter[0] && priceFilter[0] != "" && weightFilter[0] != "":
            var tagList = [regionalFilter[1], priceFilter[1], weightFilter[1]];
            var filterList = [regionalFilter[2], priceFilter[2], weightFilter[2]];
            for (i; i < content.length; i++) {
                changeDisplay(i, tagList, filterList);
            }
            break;
        case bioFilter[0] && regionalFilter[0]:
            var tagList = [bioFilter[1], regionalFilter[1]];
            var filterList = [bioFilter[2], regionalFilter[2]];
            for (i; i < content.length; i++) {
                changeDisplay(i, tagList, filterList);
            }
            break;
        case bioFilter[0] && priceFilter[0] != "":
            var tagList = [bioFilter[1], priceFilter[1]];
            var filterList = [bioFilter[2], priceFilter[2]];
            for (i; i < content.length; i++) {
                changeDisplay(i, tagList, filterList);
            }
            break;
        case bioFilter[0] && weightFilter[0] != "":
            var tagList = [bioFilter[1], weightFilter[1]];
            var filterList = [bioFilter[2], weightFilter[2]];
            for (i; i < content.length; i++) {
                changeDisplay(i, tagList, filterList);
            }
            break;
        case regionalFilter[0] && priceFilter[0] != "":
            var tagList = [regionalFilter[1], priceFilter[1]];
            var filterList = [regionalFilter[2], priceFilter[2]];
            for (i; i < content.length; i++) {
                changeDisplay(i, tagList, filterList);
            }
            break;
        case regionalFilter[0] && weightFilter[0] != "":
            var tagList = [regionalFilter[1], weightFilter[1]];
            var filterList = [regionalFilter[2], weightFilter[2]];
            for (i; i < content.length; i++) {
                changeDisplay(i, tagList, filterList);
            }
            break;
        case priceFilter[0] != "" && weightFilter[0] != "":
            var tagList = [priceFilter[1], weightFilter[1]];
            var filterList = [priceFilter[2], weightFilter[2]];
            for (i; i < content.length; i++) {
                changeDisplay(i, tagList, filterList);
            }
            break;
        case bioFilter[0]:
            var tagList = [bioFilter[1]];
            var filterList = [bioFilter[2]];
            for (i; i < content.length; i++) {
                changeDisplay(i, tagList, filterList);
            }
            break;
        case regionalFilter[0]:
            var tagList = [regionalFilter[1]];
            var filterList = [regionalFilter[2]];
            for (i; i < content.length; i++) {
                changeDisplay(i, tagList, filterList);
            }
            break;
        case priceFilter[0] != "":
            var tagList = [priceFilter[1]];
            var filterList = [priceFilter[2]];
            for (i; i < content.length; i++) {
                changeDisplay(i, tagList, filterList);
            }
            break;
        case weightFilter[0] != "":
            var tagList = [weightFilter[1]];
            var filterList = [weightFilter[2]];
            for (i; i < content.length; i++) {
                changeDisplay(i, tagList, filterList);
            }
            break;
        default:
            location.reload();
            break;
    }
}
