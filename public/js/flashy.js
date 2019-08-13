function flashy(message, link) {
    var template = $($("#flashy-template").html());
    $(".flashy").remove();
    template.find(".flashy__body").html(message).attr("href", link || "#").end()
        .appendTo("body").hide();

    template.fadeIn(300);

    $(this).on('click', function() {
        template.animate({
            marginRight: "-100%"
        }, null, "swing", function() {
            $(this).remove();
        });
    });

}


// function flashy(message, link) {
//     var template = $($("#flashy-template").html());
//     $(".flashy").remove();
//     template.find(".flashy__body").html(message).attr("href", link || "#").end()
//         .appendTo("body").hide().fadeIn(300).delay(2800).animate({
//             marginRight: "-100%"
//         }, 300, "swing", function() {
//             $(this).remove();
//         });
// }