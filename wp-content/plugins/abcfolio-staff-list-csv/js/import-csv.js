(function( $ ) {
    'use strict';
    var importTimer;
    var pBar = $( '#pBarImport' ),  pBarLbl = $( '.progress-label' );

    var PI = {

        onReady: function() {
            $('#btnAjaxImportCSV').click( PI.onClick );

        },
        onClick: function() {
            $('#dialog').dialog({
                autoOpen: false,
                modal : true,
                resizable: false,
                dialogClass: 'alert',
                buttons: {
                    'Yes': function() {
                            $(this).dialog('close'),
                            PI.importT();
                            PI.importCSV();
                    },
                    'Cancel': function() {
                            $(this).dialog('close');
                    }
                }
            }).dialog("open");
        },
        importT: function(){
            //var pBar = $( '#pBarImport' ),  pBarLbl = $( '.progress-label' );
            //var importTimer;

            pBar.progressbar({ value: false });
            pBarLbl.text( '0%' );

            pBar.progressbar({
                change: function() {
                pBarLbl.text( pBar.progressbar( 'value' ) + '%' );
            },
            complete: function() {
                    //console.log('Complete!');
                    pBarLbl.text( '100%' );
            }
            });

            importTimer = setInterval(function() {
                $.get( ajaxurl, {
                        action: 'get_import_status'
                }, function( response ) {
                    //console.log(' setInterval ' + response);
                    if ( response  === '-1' || pBar.progressbar( 'value' ) == 100 ) {
                        pBar.progressbar({ value: 100 });
                        clearInterval(importTimer);
                    } else {
                       pBar.progressbar({ value: 100 * response });
                    }
                });
            }, 1000 );
          },
        importCSV: function(){
            $.post( ajaxurl, {
                action: 'import_csv',
                dataType: "json",
                nonce:  slcIVars.nonce,
                tplateID: $('#tplateID').val()
            },
            function( response ) {
                var tbl = $(".abcfTblImport"),
                    btn = $("#btnImportCSV"),
                    msgInfo = $("#abcfslcInfo");

                if(response.status == 'success'){
                    if ( response.data === 0 ) {
                        pBar.progressbar({ value: 100 });
                        tbl.fadeOut(500, function(){
                            btn.remove();
                            tbl.remove();
                        });
                          $('#abcfslcInfo p').text('OK');
                          msgInfo.toggleClass('abcfslcNoticeInfo abcfslcNoticeOK');
                    }
                }
                else {
                        clearInterval(importTimer);
                        tbl.fadeOut(500, function(){
                            tbl.remove();
                            btn.remove();
                        });
                        $('#abcfslcInfo p').text(response.msg);
                        msgInfo.toggleClass('abcfslcNoticeInfo abcfslcNoticeKO');
                    }

            });
        }
    };
    $( document ).ready( PI.onReady );
})( jQuery );



