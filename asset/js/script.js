jQuery(function($) {
    $('input[type="file"]').change(function(e) {
        var file = e.target.files[0].name;
        var parent = $(this).parent().find('.file-pesan').html(file);
    });


    $('.data-change').on('change', function () {
        var $this = $(this);
        let parent = $this.parent();
        let data_nis = $this.data('nis');
        let data_key = $this.data('key');
        let data_value = $this.val();
        parent.append(`
        <span class="spin">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z"/>
            <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z"/>
        </svg>
        </span>
        `);
        let data = {
            action : 'update_data_siswa',
            nis: data_nis,
            key: data_key,
            value: data_value
        };
        jQuery.post(obj.ajax_url, data, function(response) {
            $this.parent().find('.spin').remove();
            $this.parent().append(`
            <span class="pesan-sukses">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2-circle" viewBox="0 0 16 16">
                <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z"/>
                <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z"/>
            </svg>
            </span>
            `);
            setTimeout(
                function() 
                {
                  $('.pesan-sukses').remove();
                }, 5000);
            console.log(response);
		});
    });
});