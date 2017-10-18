jQuery(document).ready(function($) {
    $('#fieldsSortCntr .sortable-list').sortable({
            axis: 'y',
            placeholder: 'sortPlaceholder',
            forcePlaceholderSize: true,
            update: function(event, ui) {
                var items = $(this).sortable('toArray');
                var postID = $("#fieldsSortCntr > ul").attr("id");
                var data = {
                        action: 'update_col_order',
                        order: items,
                        postid: postID,
                        abcfajaxnonce : abcfsls_ls_sort_fields.abcfajaxnonce
                };
                $.post(ajaxurl, data);
            }
    }).disableSelection();

    $('#mfOrderCntr .sortable-list').sortable({
            axis: 'y',
            placeholder: 'sortPlaceholder',
            forcePlaceholderSize: true,
            update: function(event, ui) {
                var items = $(this).sortable('toArray');
                var postID = $("#mfOrderCntr > ul").attr("id");
                var data = {
                        action: 'update_filter_order',
                        order: items,
                        postid: postID,
                        abcfajaxnonce : abcfsls_ls_sort_fields.abcfajaxnonce
                };
                $.post(ajaxurl, data);
            }
    }).disableSelection();
});



