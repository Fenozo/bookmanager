function flashy(message, link, type) {
    if (type == null)
    {
        type = 'primary';
    }
    var template = $("#flashy-template");
    $(".flashy").remove();
    template.append('<div class="flashy flashy--'+type+'" ><a href="#" class="flashy__body" target="_blank"></a></div>');
    template.find(".flashy__body").html(message).attr("href", link || "#").end()
        .appendTo("body").hide().fadeIn(300).delay(3000).animate({
            marginRight: "-100%"
        }, 1000, "swing", function() {
            $(this).remove();
        });

}

/**
 * 
 * Modal
    opacity: 1;
    position: fixed;
    top: 20px;
    z-index: 2000;
    left: 29%;
    padding-left: 17px;
 */