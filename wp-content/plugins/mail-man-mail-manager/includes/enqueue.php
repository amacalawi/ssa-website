<?php


# CSS
add_action( 'wp_enqueue_scripts',
    function () {
        wp_enqueue_style( 'mailman-sender', MAIL_MAN_URL_ASSETS . 'css/mailman-front-end.css', false, '1.0.0' );
    }
);


# JS
add_action(
    'wp_footer',
    function() {
        wp_register_script( 'mailman-sender', MAIL_MAN_URL_ASSETS . 'js/sender.js', array('jquery'), '1.0.0', true );
        global $Mailman;
        $options = $Mailman->get_options();
        # Remove the smtp array
        # Specially the username and password
        # when passing it in the javascript ;)
        unset($options->options['smtp']);
        unset($options->options['email']);
        unset($options->options['page']);
        unset($options->options['shortcode']);
        $MailmanLocalized = json_decode(json_encode($options), true);
        wp_localize_script( 'mailman-sender', 'MailmanLocalized', $MailmanLocalized );
        wp_enqueue_script( 'mailman-sender' );
    }
);


# backend
# Style
add_action( 'admin_enqueue_scripts', 'mailman_styles_collection' );
function mailman_styles_collection() {

    wp_register_style( 'mailman-admin', MAIL_MAN_URL_ASSETS . 'css/mailman-back-end.css', false, '1.0.0' );
    wp_enqueue_style( 'mailman-admin' );
}


?>