AOS.init();
$(document).ready(function () {
    $('.fa-bars').click(function() {
        $(this).toggleClass('fa-xmark').css("transform", "-180deg")
    })
})