jQuery(function($) {
    $('input[type="file"]').change(function(e) {
        var file = e.target.files[0].name;
        var parent = $(this).parent().find('.file-pesan').html(file);
    });
});