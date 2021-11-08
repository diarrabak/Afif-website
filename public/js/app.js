$(document).ready(function () {
    $(".dropdown-toggle").click(function () {
        window.location.href = $(this).attr("href");
    });
});
