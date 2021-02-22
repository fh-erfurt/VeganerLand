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
    // index is which element from li is currently filtert and call is needed for the recursion.
    var products = document.getElementById('products');
    var li = products.getElementsByTagName('li');

    if (call == filter.length) { // anchor
        li[index].style.display = "inline-block";
        li[index].removeAttribute("title"); //removes the title
    } else {
        var currentTag = tag[call];
        var check = li[index].getElementsByTagName('p')[currentTag].textContent; // Depending on the tag it is either the comment or the price.
        if (currentTag == 0) {
            // indexOf() looks if a word occures in a string and gives back the position if it finds one. In case it doesn't indexOf() gives back -1.
            if (check.indexOf(filter[call]) == -1) {
                li[index].style.display = "none";
                li[index].setAttribute("title", "hidden");
            } else {
                call++;
                changeDisplay(index, tag, filter, call); // Calls the function again for the next filter.
            }
        } else {
            // check and filter[call] are strings. parseFloat turns them into numbers (float) so they can be compared.
            if (parseFloat(check) < parseFloat(filter[call])) {
                li[index].style.display = "none";
                li[index].setAttribute("title", "hidden");
            } else {
                call++;
                changeDisplay(index, tag, filter, call);
            }
        }
        // I know there is double code, but I don't know how to remove it because of call. A pointer would be really useful.
    }
}

function reload(event) {
    event.stopPropagation();
    event.preventDefault();

    // Gets all elements from form and saves them in an array.
    var form = document.getElementById('form');
    // Arrays to save different information.
    // [0] → Information if the field in the form has a value. checked gives back true or false; value gives back a string.
    // [1] → Information on wich p-tag should be check for the filter. Everything but price is in the first.
    // [2] → Information on what to filter for.
    var bioFilter = [form[0].checked, 0, "Bio"];
    var regionalFilter = [form[1].checked, 0, "Regional"];
    var priceFilter = [form[2].value, 1, form[2].value];
    var weightFilter = [form[3].value, 0, form[3].value];

    var contentList = document.getElementById('products');
    var content = contentList.getElementsByTagName('li');

    switch (true) {
        case bioFilter[0] && regionalFilter[0] && priceFilter[0] != "" && weightFilter[0] != "": // priceFilter and weightFilter have to check for an empty string.
            var tagList = [bioFilter[1], regionalFilter[1], priceFilter[1], weightFilter[1]]; // takes the information on which p-tag is used
            var filterList = [bioFilter[2], regionalFilter[2], priceFilter[2], weightFilter[2]]; // takes the information on what to search for
            repeat(content, tagList, filterList); // The code is the same for all cases, therefore it gets an extra function.
            break;
        case bioFilter[0] && regionalFilter[0] && priceFilter[0] != "":
            var tagList = [bioFilter[1], regionalFilter[1], priceFilter[1]];
            var filterList = [bioFilter[2], regionalFilter[2], priceFilter[2]];
            repeat(content, tagList, filterList);
            break;
        case bioFilter[0] && regionalFilter[0] && weightFilter[0] != "":
            var tagList = [bioFilter[1], regionalFilter[1], weightFilter[1]];
            var filterList = [bioFilter[2], regionalFilter[2], weightFilter[2]];
            repeat(content, tagList, filterList);
            break;
        case bioFilter[0] && priceFilter[0] != "" && weightFilter[0] != "":
            var tagList = [bioFilter[1], priceFilter[1], weightFilter[1]];
            var filterList = [bioFilter[2], priceFilter[2], weightFilter[2]];
            repeat(content, tagList, filterList);
            break;
        case regionalFilter[0] && priceFilter[0] != "" && weightFilter[0] != "":
            var tagList = [regionalFilter[1], priceFilter[1], weightFilter[1]];
            var filterList = [regionalFilter[2], priceFilter[2], weightFilter[2]];
            repeat(content, tagList, filterList);
            break;
        case bioFilter[0] && regionalFilter[0]:
            var tagList = [bioFilter[1], regionalFilter[1]];
            var filterList = [bioFilter[2], regionalFilter[2]];
            repeat(content, tagList, filterList);
            break;
        case bioFilter[0] && priceFilter[0] != "":
            var tagList = [bioFilter[1], priceFilter[1]];
            var filterList = [bioFilter[2], priceFilter[2]];
            repeat(content, tagList, filterList);
            break;
        case bioFilter[0] && weightFilter[0] != "":
            var tagList = [bioFilter[1], weightFilter[1]];
            var filterList = [bioFilter[2], weightFilter[2]];
            repeat(content, tagList, filterList);
            break;
        case regionalFilter[0] && priceFilter[0] != "":
            var tagList = [regionalFilter[1], priceFilter[1]];
            var filterList = [regionalFilter[2], priceFilter[2]];
            repeat(content, tagList, filterList);
            break;
        case regionalFilter[0] && weightFilter[0] != "":
            var tagList = [regionalFilter[1], weightFilter[1]];
            var filterList = [regionalFilter[2], weightFilter[2]];
            repeat(content, tagList, filterList);
            break;
        case priceFilter[0] != "" && weightFilter[0] != "":
            var tagList = [priceFilter[1], weightFilter[1]];
            var filterList = [priceFilter[2], weightFilter[2]];
            repeat(content, tagList, filterList);
            break;
        case bioFilter[0]:
            var tagList = [bioFilter[1]];
            var filterList = [bioFilter[2]];
            repeat(content, tagList, filterList);
            break;
        case regionalFilter[0]:
            var tagList = [regionalFilter[1]];
            var filterList = [regionalFilter[2]];
            repeat(content, tagList, filterList);
            break;
        case priceFilter[0] != "":
            var tagList = [priceFilter[1]];
            var filterList = [priceFilter[2]];
            repeat(content, tagList, filterList);
            break;
        case weightFilter[0] != "":
            var tagList = [weightFilter[1]];
            var filterList = [weightFilter[2]];
            var array = [];
            repeat(content, tagList, filterList);
            break;
        default:
            location.reload(); // Reloads the page if no filter is set.
            break;
    }
}

function repeat(li, tag, filter) {
    var array = []; // An emty array to save information.
    for (var i = 0; i < li.length; i++) {
        // Recursive function that changes the display to none or inline-block. If the display is none than the title hidden is added and by inline-block it is removed.
        changeDisplay(i, tag, filter);
        array.push(li[i].title); // Saves the information on the title in the array. The string either says "hidden" or is empty.
    }
    // Uses the filter-method to remove the empty strings. (If check returns false, the element is removed from the array and the elements after get moved one position forward.
    var checkArray = array.filter(check);
    // When all elements are hidden checkArray and li will have the same length.
    if (checkArray.length == li.length) {
        alert("Es konnte leider nichts gefunden werden.");
    }
}

function check(value) {
    return value == "hidden";
}
