
<form id="mailman_<?php echo $options->ID ?>" class="<?php echo @$atts['form_class'] ?>" <?php /*action="<?php echo $options->fallbackurl ?>"*/ ?> method="POST" role="form">

    <!-- START: For WP AJAX Calls -->
    <input name="action" type="hidden" value="<?php echo $options->ajax_name ?>" />
    <!-- END: For WP AJAX Calls -->

    <?php echo $atts['input_before'] ?>
        <input type="text" class="<?php echo $atts['input_class'] ?> input-lg" placeholder="Name" id="contact[name]" name="contact[name]" value="<?php echo @$Name ?>">
    <?php echo $atts['input_after'] ?>

    <?php echo $atts['input_before'] ?>
        <input type="email" class="<?php echo $atts['input_class'] ?> input-lg" placeholder="Email" id="contact[email]" name="contact[email]" value="<?php echo @$Email ?>">
    <?php echo $atts['input_after'] ?>

    <?php echo $atts['input_before'] ?>
        <textarea class="<?php echo $atts['input_class'] ?> input-lg" rows="5" placeholder="Message" id="contact[message]" name="contact[message]"><?php echo @$Message ?></textarea>
    <?php echo $atts['input_after'] ?>

    <button type="submit" name="contact[submit]" class="ladda-button progress-button" data-style="expand-left">Submit</button>
</form>