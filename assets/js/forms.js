/*
================================
== Molham Al-khodari 31.12.2020
================================
*/

// es macht nicht wirklich sinn an der stelle, cos HTML form validation can be performed automatically by the browser ...

function validateForm() {
    var x = document.forms["myForm"]["fname"].value;
    if (x == "") {
        alert("Name must be filled out");
        return false;
    }
}

// var height = $('#header').height();

// $(window).scroll(function() {
//     if ($(this).scrollTop() > height) {
//         $('.nav-container').addClass('fixed');
//     } else {
//         $('.nav-container').removeClass('fixed');
//     }
// });