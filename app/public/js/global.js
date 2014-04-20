

$(document).ready(function() {
    initSearch();
})

var Search = {};

function initSearch() {
    Search.field = $("#search-tf");
    Search.form = $("#search-form");


    Search.field.change(function() {

    })

    Search.form.submit(function() {
        location.href = "/search/result?q="+Search.field.val();
        return false;
    })
}

