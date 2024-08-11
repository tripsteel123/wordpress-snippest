jQuery(document).ready(function ($) {
    $('.playlist_table tbody').sortable({
        handle: '.dashicons-move',
        stop: reindex_table
    });

    function no_items_in_play_list_table () {
        if($(".playlist_table tbody tr:not(.no_item_in_playlist)").length) {
            $('.no_item_in_playlist').remove();
        }else {
            $(".playlist_table tbody").html($("#pl_table_no_item").html());
        }
    }

    function reindex_table() {
        $('.playlist_table tbody tr td:nth-child(2)').each(function (index) {
            $(this).text(index + 1);
        });
    }

    $(document).on('click', '.playlist_table .dashicons-trash' , function () {
        $(this).closest('tr').addClass('deleting').slideUp(500, function () {
            $(this).remove();
            no_items_in_play_list_table();
            reindex_table();
        });
    });
    $(".add_new_item").on('click' , function (e) {
        e.preventDefault();
       let html =  $("#add_new_item_to_table").html();
        $(html).appendTo(".playlist_table tbody");
        no_items_in_play_list_table();
        reindex_table();
    });
});
