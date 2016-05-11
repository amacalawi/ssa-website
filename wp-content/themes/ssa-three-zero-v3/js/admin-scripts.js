jQuery(document).ready(function ($) {
    var custom_uploader;
    $(document).on('click', '.button-media', function(e) {
        e.preventDefault();
        var _this   = $(this).attr("id");
        var _input  = $("#"+_this).data("target-input");
        var _buttonName = ( typeof( $("#"+_this).attr("data-buttonName") ) !== 'undefined' || (typeof( $("#"+_this).attr("data-buttonName") ) == true) ) ? $("#"+_this).data("buttonName") : 'Select Image';

        //If the uploader object has already been created, reopen the dialog
        if (custom_uploader != undefined) {
            custom_uploader.open();
            return;
        }

        //Extend the wp.media object
        custom_uploader = wp.media.frames.file_frame = new wp.media({
            title: 'Choose a Media',
            button: {
                text: _buttonName
            },
            multiple: false
        });

        //When a file is selected, grab the URL and set it as the text field's value
        custom_uploader.on('select', function() {
            attachment = custom_uploader.state().get('selection').first().toJSON();
            $(_input).val(attachment.url);
        });

        //Open the uploader dialog
        custom_uploader.open();

        return false;

    });
})