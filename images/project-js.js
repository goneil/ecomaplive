$(document).ready(function() {
    $(".button").click(function(){
        window.location = $(this).find("a").attr("href");
        return false;
    });
});
