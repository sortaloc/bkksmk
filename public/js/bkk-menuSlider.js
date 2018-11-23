$("#menuButton").on("click", function() {
    $("#menuContent").slideToggle(300);
    if ($("#menuContent").attr("data-toggle") == "show") {
        $(this).removeClass("fa-caret-up");
        $(this).addClass("fa-caret-down");
        $("#menuContent").attr("data-toggle", "collapse");
    } else {
        $(this).removeClass("fa-caret-down");
        $(this).addClass("fa-caret-up");
        $("#menuContent").attr("data-toggle", "show");
    }
});
