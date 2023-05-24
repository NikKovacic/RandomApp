$(document).on('click', '.clickable', function () {
    window.location = $(this).closest('.clickable-row').attr("data-url");
});
