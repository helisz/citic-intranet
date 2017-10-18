jQuery(document).ready(function($){

    var custom_uploader;

    //btn ID
    $(abcfslcCSV.btnCSVChoose).click(function(e) {

        e.preventDefault();

        //console.log(abcfslcCSV.btnCSVChoose);

        //If the uploader object has already been created, reopen the dialog
        if (custom_uploader) {
            custom_uploader.open();
            return;
        }

        //Extend the wp.media object
        custom_uploader = wp.media.frames.file_frame = wp.media({
            //title: abcfslcCSV.title,
            button: { text:  abcfslcCSV.buttonTxt },
            library: { type: 'text/csv' },
            frame:    'select',
            state:   'mystate'
        });

        custom_uploader.states.add([
          new wp.media.controller.Library({
            id: 'mystate',
            title: abcfslcCSV.titleTxt,
            priority: 20,
            toolbar: 'select',
            filterable: 'uploaded',
            library: wp.media.query( custom_uploader.options.library ),
            multiple: false,
            editable: false,
            displayUserSettings: false,
            displaySettings: true,
            allowLocalEdits: true
          })
        ]);

        //When a file is selected, grab the URL and set it as the text field's value
        custom_uploader.on('select', function() {
            var attachment = custom_uploader.state().get('selection').first().toJSON();

            console.log(attachment);

            $(abcfslcCSV.csvUrl).val(attachment.url);
            $(abcfslcCSV.csvFilename).val(attachment.filename);
            $(abcfslcCSV.csvQFilename).val('');


            //$(abcfslcCSV.imgIDL).val(attachment.id);
        });

        //Open the uploader dialog
        custom_uploader.open();
    });


$("#abcfslcToggleAll").change(function () {
      $("input:checkbox").prop('checked', $(this).prop("checked"));
});

});