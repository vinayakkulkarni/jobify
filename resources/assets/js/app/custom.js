$(document).ready(function() {
    $('#js_sortable').tablesort();
    $(".ui.dropdown").dropdown({
        on: "click",
        forceSelection: false
    });
    $('.ui.checkbox').not('.vue').checkbox();
});
