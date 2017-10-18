jQuery(document).ready(function($) {
    $('#slBtnAddRowSlug').on('click', function() {
            var row = $('.slTrEmptyRowSlug.screen-reader-text').clone(true);
            row.removeClass('slTrEmptyRowSlug screen-reader-text');
            row.insertBefore('#slTblCatSlugs tbody>tr:last');
            return false;
    });
    $('.slBtnRemoveRowSlug').on('click', function() {
            $(this).parents('tr').remove();
            return false;
    });
    $('#slTblCatSlugs tbody').sortable({
            opacity: 0.9,
            revert: true,
            cursor: 'move',
            handle: '.slTdSortHandleSlug',
            axis: 'y'
    });
});

