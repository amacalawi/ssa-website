<div class="wrap">
    <h1>Testimonials Settings</h1>

    <form action="options.php" method="post" novalidate="novalidate">
        <?php
        settings_fields( 'testimonials-settings' );
        do_settings_sections( 'testimonials-settings' ); ?>
        <table class="form-table">
            <tbody>
                <tr>
                    <th scope="row">
                        <label for="background_image">Background Image</label>
                    </th>
                    <td>
                        <input name="testimonials_settings[background_image]" type="text" id="background_image" value="<?php echo @$options['background_image'] ?>" class="regular-text">
                        <button id="browse_button" type="button" class="button button-media" data-target="#background_image_preview" data-input="#background_image">...</button>
                    </td>
                </tr>
            </tbody>
        <table>

        <?php
        # The submit button
        submit_button(); ?>
    </form>

</div>

<?php wp_enqueue_media(); ?>
<script>
jQuery(document).ready(function($) {

    // UPLOAD
    var custom_uploader;
    $('.button-media').click(function(e) {
        e.preventDefault();
        var _this   = $(this).attr("id");
        // alert(_this);
        var _target = $("#"+_this).attr("data-target");
        var _input  = $("#"+_this).attr("data-input");
        // alert(_target);

        //If the uploader object has already been created, reopen the dialog
        if (custom_uploader) {
            custom_uploader.open();
            return;
        }

        //Extend the wp.media object
        custom_uploader = wp.media.frames.file_frame = new wp.media({
            title: 'Choose an Image',
            button: {
                text: "Set Image"
            },
            multiple: false
        });

        //When a file is selected, grab the URL and set it as the text field's value
        custom_uploader.on('select', function() {
            attachment = custom_uploader.state().get('selection').first().toJSON();
            $(_target).attr('src', attachment.url);
            $(_input).val(attachment.url);
        });

        //Open the uploader dialog
        custom_uploader.open();

        // return false;

    });
    $('.button-destroy').click(function(){
        var _target = $(this).attr("data-target");
        var _input  = $(this).attr("data-input");
        $(_target).attr('src', '');
        $(_input).val('');
    });

    // EFFECTS
    $(".list-group-item[role=button]").click(function(e){
        $(this).find(".arrow-icon").toggleClass("rotate");
        var target = $(this).attr("href");
        $(target).slideToggle(300);
    });

});
</script>