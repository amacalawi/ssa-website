<?php
/*
| ------------------------------------
| # Helpers
| ------------------------------------
*/

function is_ajax()
{
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}

function message($get_obj='$_GET[\'settings-updated\']', $success_message="Settings saved.", $error_message="There were unexpected errors while saving the settings.")
{
    ob_start();
    if( isset($_GET['settings-updated']) && $_GET['settings-updated'] ) { ?>

        <div id="message" class="updated notice is-dismissible">
            <p><strong><?php _e( $success_message ) ?></strong></p>
            <button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button>
        </div><?php

    } else {

        if( isset($_POST['submit']) ) { ?>
            <div id="message" class="error notice is-dismissible">
                <p><strong><?php _e( $error_message ) ?></strong></p>
                <button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button>
            </div><?php
        }
    }
    return ob_get_clean();
}
?>