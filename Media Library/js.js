jQuery(document).ready(function ($) {
    var file_frame;
    $('#mmlp_file_button').on('click', function (event) {
        event.preventDefault();

        // اگر فریم باز است، استفاده از آن
        if (file_frame) {
            file_frame.open();
            return;
        }

        // ایجاد فریم جدید
        file_frame = wp.media({
            title: 'Select or Upload Media',
            button: {
                text: 'Use this media'
            },
            multiple: false
        });

        // انتخاب فایل
        file_frame.on('select', function () {
            var attachment = file_frame.state().get('selection').first().toJSON();
            $('#mmlp_file').val(attachment.id);
            $('#mmlp_file_preview').html('<img src="' + attachment.url + '" style="max-width: 300px;" />');
        });

        // باز کردن فریم
        file_frame.open();
    });
});

