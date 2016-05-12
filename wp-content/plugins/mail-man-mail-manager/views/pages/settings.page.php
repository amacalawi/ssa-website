<div class="wrap">
    <h2><?php _e('Settings', MAIL_MAN_TEXT_DOMAIN) ?></h2><?php
    echo message(); ?>
    <form action="options.php" method="POST" autocomplete="off" class="mailman"><?php
        settings_fields( $plugin_settings );
        do_settings_sections( $plugin_settings ); ?>

        <section class="section">
            <h3><?php _e('Display', MAIL_MAN_TEXT_DOMAIN) ?></h3>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">
                        <label for="mailman_email_settings[page]"><strong><?php _e('Page', MAIL_MAN_TEXT_DOMAIN) ?></strong></label>
                    </th>
                    <td>
                        <select id="mailman_email_settings[page]" name="mailman_email_settings[page]" class="regular-text">
                            <option value=""><?php echo esc_attr( __( 'Use Shortcode' ) ); ?></option><?php
                            $selected_page = $options['page'];
                            $pages = get_pages(['sort_column'=>'menu_order']);
                            foreach ( $pages as $page ) {
                                $option  = '<option value="' . $page->ID . '" ';
                                $option .= ( $page->ID == $selected_page ) ? 'selected="selected"' : '';
                                $option .= '>';
                                $option .= $page->post_title;
                                $option .= '</option>';
                                echo $option;
                            } ?>
                        </select>
                        <p class="description"><?php _e( 'Select the page to display the contact form.', MAIL_MAN_TEXT_DOMAIN ); ?></p>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label for="mailman_email_settings[shortcode]"><strong><?php _e('Shortcode', MAIL_MAN_TEXT_DOMAIN) ?></strong></label>
                    </th>
                    <td>
                        <input id="mailman_email_settings[shortcode]" readonly="readonly" type="text" class="regular-text" name="mailman_email_settings[shortcode]"
                            value="[mail_form]" />
                        <p class="description"><?php _e( 'Alternatively, paste this shortcode in a page to display the contact form. You can still use the shortcode even if you\'ve chosen a page, though it will duplicate the form.', MAIL_MAN_TEXT_DOMAIN ); ?></p>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label for="mailman_email_settings[enable_email_saving]"><strong><?php _e('Save Email to Database', MAIL_MAN_TEXT_DOMAIN) ?></strong></label>
                    </th>
                    <td>
                        <div>
                            <label for="mailman_email_settings[enable_email_saving]">
                                <input id="mailman_email_settings[enable_email_saving]" name="mailman_email_settings[enable_email_saving]" type="checkbox" value="yes" <?php echo @('yes' === $options['enable_email_saving']) ? 'checked' : '' ?> >
                                <span>The email will be saved in the database and can be viewed in the <a href="<?php echo get_admin_url() .  "edit.php?post_type=".MailManController::$cpt_name_singular; ?>">Email</a> menu. <i class="description">(<strong>Warning</strong>: This can be resource extensive.)</i></span>
                            </label>
                        </div>
                    </td>
                </tr>
            </table>
        </section>

        <section class="section">
            <h3><?php _e('Email', MAIL_MAN_TEXT_DOMAIN) ?></h3>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">
                        <label for="mailman_email_settings[email][to]"><strong><?php _e('Recipient(s)', MAIL_MAN_TEXT_DOMAIN) ?></strong></label>
                    </th>
                    <td>
                        <div>
                            <input id="mailman_email_settings[email][to]" name="mailman_email_settings[email][to]" class="regular-text" type="text" value="<?php echo @$options['email']['to'] ?>" placeholder="defaults to <?php echo get_bloginfo('admin_email'); ?>">
                            <p class="description"><?php _e( 'Seperate multiple emails by comma.', MAIL_MAN_TEXT_DOMAIN ); ?></p>
                        </div>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label for="mailman_email_settings[email][cc]"><strong><?php _e('CC', MAIL_MAN_TEXT_DOMAIN) ?></strong></label>
                    </th>
                    <td>
                        <input id="mailman_email_settings[email][cc]" name="mailman_email_settings[email][cc]" class="regular-text" type="text" value="<?php echo @$options['email']['cc'] ?>" placeholder="">
                        <p class="description"><?php _e( 'Seperate multiple emails by comma.', MAIL_MAN_TEXT_DOMAIN ); ?></p>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label for="mailman_email_settings[email][bcc]"><strong><?php _e('BCC', MAIL_MAN_TEXT_DOMAIN) ?></strong></label>
                    </th>
                    <td>
                        <input id="mailman_email_settings[email][bcc]" name="mailman_email_settings[email][bcc]" class="regular-text" type="text" value="<?php echo @$options['email']['bcc'] ?>" placeholder="">
                        <p class="description"><?php _e( 'Seperate multiple emails by comma.', MAIL_MAN_TEXT_DOMAIN ); ?></p>
                    </td>
                </tr>
            </table>
        </section>

        <section class="section">
            <h3><?php _e('Message Prompt', MAIL_MAN_TEXT_DOMAIN) ?></h3>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">
                        <label for="mailman_email_settings[message][success][title]"><strong><?php _e('Success', MAIL_MAN_TEXT_DOMAIN) ?></strong></label>
                    </th>
                    <td>
                        <div>
                            <p><strong>Heading</strong></p>
                            <input id="mailman_email_settings[message][success][title]" name="mailman_email_settings[message][success][title]" class="regular-text" type="text" value="<?php echo @$options['message']['success']['title'] ? @$options['message']['success']['title'] : "Message Successfully Sent" ?>">
                        </div>
                        <div>
                            <p><strong>Body</strong></p>
                            <textarea id="mailman_email_settings[message][success][body]" name="mailman_email_settings[message][success][body]" class="regular-text" type="text"><?php echo @$options['message']['success']['body'] ? @$options['message']['success']['body'] : 'Thank you for sending us an email.'.PHP_EOL.'We will reply as soon as possible.' ?></textarea>
                        </div>
                        <p class="description"><?php _e( 'Specify the title and message of a successful email.', MAIL_MAN_TEXT_DOMAIN ); ?></p>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label for="mailman_email_settings[message][fail][title]"><strong><?php _e('Error', MAIL_MAN_TEXT_DOMAIN) ?></strong></label>
                    </th>
                    <td>
                        <div>
                            <p><strong>Heading</strong></p>
                            <input id="mailman_email_settings[message][fail][title]" name="mailman_email_settings[message][fail][title]" class="regular-text" type="text" value="<?php echo @$options['message']['fail']['title'] ? @$options['message']['fail']['title'] : "Message did not send!" ?>">
                        </div>
                        <div>
                            <p><strong>Body</strong></p>
                            <textarea id="mailman_email_settings[message][fail][body]" name="mailman_email_settings[message][fail][body]" class="regular-text" type="text"><?php echo @$options['message']['fail']['body'] ? @$options['message']['fail']['body'] : 'Error(s) found while sending the email. Please try again.' ?></textarea>
                        </div>
                        <p class="description"><?php _e( 'Specify the title and message of an unsuccessful email attempt.', MAIL_MAN_TEXT_DOMAIN ); ?></p>
                    </td>
                </tr>

            </table>
        </section>

        <section class="section">
            <h3><?php _e('SMTP', MAIL_MAN_TEXT_DOMAIN) ?></h3>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">
                        <label for="mailman_email_settings[smtp][use_smtp]"><strong><?php _e('SMTP Usage', MAIL_MAN_TEXT_DOMAIN) ?></strong></label>
                    </th>
                    <td>
                        <div>
                            <label for="mailman_email_settings[smtp][use_smtp]">
                                <input id="mailman_email_settings[smtp][use_smtp]" name="mailman_email_settings[smtp][usage]" type="radio" value="use_smtp_only" <?php echo @('use_smtp_only' === $options['smtp']['usage']) ? 'checked' : '' ?> >
                                <span>Use SMTP Only</span>
                            </label>
                        </div>
                        <div>
                            <label for="mailman_email_settings[smtp][use_smtp_fallback]">
                                <input id="mailman_email_settings[smtp][use_smtp_fallback]" name="mailman_email_settings[smtp][usage]" type="radio" value="use_smtp_fallback" <?php echo @('use_smtp_fallback' === $options['smtp']['usage']) ? 'checked' : '' ?> >
                                <span>Use SMTP as fallback <i class="description">(Will try to send the email if the PHP Mail function should fail.)</i></span>
                            </label>
                        </div>
                        <div>
                            <label for="mailman_email_settings[smtp][no_smtp]">
                                <input id="mailman_email_settings[smtp][no_smtp]" name="mailman_email_settings[smtp][usage]" type="radio" value="no_smtp" <?php echo @('no_smtp' === $options['smtp']['usage']) ? 'checked' : '' ?> >
                                <span>Turn off SMTP <i class="description">(<strong>Warning:</strong> Some Host Providers might not have the PHP Mail enabled.)</i></span>
                            </label>
                        </div>
                    </td>
                </tr>
                <tr id="smtp_details" valign="top">
                    <th scope="row">
                        <label for="mailman_email_settings[smtp][host]"><strong><?php _e('SMTP Details', MAIL_MAN_TEXT_DOMAIN) ?></strong></label>
                    </th>
                    <td>
                        <div>
                            <p><strong>Host</strong></p>
                            <input id="mailman_email_settings[smtp][host]" name="mailman_email_settings[smtp][host]" class="regular-text" type="text" value="<?php echo @$options['smtp']['host'] ? $options['smtp']['host'] : 'localhost' ?>" placeholder="">
                            <p class="description"><?php _e( 'SMTP Host. Defaults to `localhost`', MAIL_MAN_TEXT_DOMAIN ); ?></p>
                        </div>
                        <div>
                            <p><strong>Port</strong></p>
                            <input id="mailman_email_settings[smtp][port]" name="mailman_email_settings[smtp][port]" class="regular-text" type="text" value="<?php echo @$options['smtp']['port'] ? $options['smtp']['port'] : '25' ?>" placeholder="">
                            <p class="description"><?php _e( 'SMTP Port. Defaults to `25`', MAIL_MAN_TEXT_DOMAIN ); ?></p>
                        </div>
                        <div>
                            <p><strong>Encryption</strong></p>
                            <input id="mailman_email_settings[smtp][secure]" name="mailman_email_settings[smtp][secure]" class="regular-text" type="text" value="<?php echo @$options['smtp']['secure'] ? $options['smtp']['secure'] : '' ?>" placeholder="">
                            <p class="description"><?php _e( 'Posibble values are `ssl` or `tls`.', MAIL_MAN_TEXT_DOMAIN ); ?></p>
                        </div>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label for="mailman_email_settings[smtp][use_auth]"><strong><?php _e('Authenticate SMTP', MAIL_MAN_TEXT_DOMAIN) ?></strong></label>
                    </th>
                    <td>
                        <div>
                            <label for="mailman_email_settings[smtp][use_auth]">
                                <input id="mailman_email_settings[smtp][use_auth]" name="mailman_email_settings[smtp][use_auth]" type="checkbox" value="yes" <?php echo @('yes' === $options['smtp']['use_auth']) ? 'checked' : '' ?> >
                                <span>Whether to authenticate the SMTP Account <i class="description">(Requires a Username and Password)</i></span>
                            </label>
                        </div>
                    </td>
                </tr>
                <tr id="smpt_account" valign="top">
                    <th scope="row">
                        <label for="mailman_email_settings[smtp][username]"><strong><?php _e('SMTP Account', MAIL_MAN_TEXT_DOMAIN) ?></strong></label>
                    </th>
                    <td>
                        <div>
                            <p><strong>Username</strong></p>
                            <input autocomplete="off" id="mailman_email_settings[smtp][username]" name="mailman_email_settings[smtp][username]" class="regular-text" type="text" value="<?php echo @$options['smtp']['username'] ? $options['smtp']['username'] : '' ?>" placeholder="your@email.com">
                        </div>
                        <div>
                            <p><strong>Password</strong></p>
                            <input autocomplete="off" id="mailman_email_settings[smtp][password]" name="mailman_email_settings[smtp][password]" class="regular-text" type="password" value="<?php echo @$options['smtp']['password'] ? $options['smtp']['password'] : '' ?>" placeholder="your@email.com">
                        </div>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label for="mailman_email_settings[smtp][send_html]"><strong><?php _e('Content Type', MAIL_MAN_TEXT_DOMAIN) ?></strong></label>
                    </th>
                    <td>
                        <div>
                            <label for="mailman_email_settings[smtp][send_html]">
                                <input id="mailman_email_settings[smtp][send_html]" name="mailman_email_settings[smtp][send_html]" type="checkbox" value="yes" <?php echo @('yes' === $options['smtp']['send_html']) ? 'checked' : '' ?> >
                                <span>Send email as HTML?</span>
                            </label>
                        </div>
                    </td>
                </tr>
            </table>
        </section>

        <?php
        # The submit button
        submit_button(); ?>

    </form>
</div>