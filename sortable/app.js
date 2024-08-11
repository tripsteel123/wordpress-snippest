jQuery(document).ready(function(){
    jQuery('.playlist_table tbody').sortable({
        handle: '.dashicons-move',
        stop: reindex_table
    });
    function reindex_table () {
        jQuery('.playlist_table tbody tr td:nth-child(2)').each(function (index) {
            jQuery(this).text( index + 1 );
        });
    }
});
