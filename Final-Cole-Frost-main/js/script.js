$(document).ready(function () {

    // Swtich image when hover
    $(".logo").mouseover(function () {
        $(this).attr('src', $(this).data("hover"));
    }).mouseout(function () {
        $(this).attr('src', $(this).data("src"));
    });

});

// Automatic scroll
$(document).ready(function () {
    target_offset = $('.showcase-logo').offset(),
            target_top = target_offset.top;
    $('html, body').animate({
        scrollTop: target_top
    }, 800);
});





