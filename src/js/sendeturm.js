$(function() {
    $('.pwp4-wrapper').each(function() {
        var element = $(this);
        var url = element.attr('data-episode');

        element.attr('data-episode', url + "&bla=123");
    })
});