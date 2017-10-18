jQuery(document).ready(function($) {
    $('#abcfslsIAddRow').on('click', function() {

            var row = $('.abcfslsIEmptyRow.screen-reader-text').clone(true);
            row.removeClass('abcfslsIEmptyRow screen-reader-text');
            row.insertBefore('#abcfslsITblMenu tbody>tr:last');
            return false;
    });
    $('.abcfslsIDeleteRow').on('click', function() {
            $(this).parents('tr').remove();
            return false;
    });
    $('#abcfslsITblMenu tbody').sortable({
            opacity: 0.9,
            revert: true,
            cursor: 'move',
            handle: '.abcfslsIRowMove',
            axis: 'y'
    });


});

