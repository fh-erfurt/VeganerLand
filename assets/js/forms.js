/*
=====================
== Molham Al-khodari
=====================
*/

// es macht nicht wirklich sinn an der stelle, cos HTML form validation can be performed automatically by the browser ...

function validateForm() {
    var x = document.forms["myForm"]["fname"].value;
    if (x == "") {
        alert("Name must be filled out");
        return false;
    }
}