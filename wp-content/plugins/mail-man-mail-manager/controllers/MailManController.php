<?php
/**
 * Mail Man Controller
 *
 */
class MailManController
{
    public static $cpt_name_singular = 'email';
    public static $cpt_name_plural = 'emails';
    public static $cpt_post_statuses = array('unread', 'read');
    public static $cpt_menu_position = 6;
    public static $cpt_options_name = "mailman_email_settings";
    public static $cpt_plugin_settings = "MailmanSettings";
    public static $cpt_url_settings_link = 'mail-manager-settings';

    public function register()
    {
        $cpt_name_singular = self::$cpt_name_singular;
        $cpt_name_plural = self::$cpt_name_plural;

        $labels = array(
            'name'              => ucwords($cpt_name_plural),
            'singular_name'     => ucwords($cpt_name_singular),
            'all_items'         => "All " . ucwords($cpt_name_plural),
            'add_new'           => "Add New " . ucwords($cpt_name_singular),
            'add_new_item'      => "Add New " . ucwords($cpt_name_singular),
            'edit_item'         => "Edit " . ucwords($cpt_name_singular),
            'new_item'          => "New " . ucwords($cpt_name_singular),
            'view_item'         => "View " . ucwords($cpt_name_singular),
            'search_items'      => "Search " . ucwords($cpt_name_singular),
            'not_found'         => "No " . ucwords($cpt_name_plural) . " found",
            'not_found_in_trash'=> "No " . ucwords($cpt_name_plural) . " found in trash",
            'parent_item_colon' => "Parent " . ucwords($cpt_name_singular) . ":",
            'menu_name'         => _x(ucwords($cpt_name_plural), 'wordpress')
        );

        $args = array(
            'labels'            => $labels,
            'query_var'         => $cpt_name_singular,
            'rewrite'           => true,
            'menu_icon'         => 'dashicons-email-alt',
            'public'            => false,
            'hierarchical'      => true,
            'supports'          => array('title'),
            'show_ui'           => true,
            'show_in_menu'      => true,
            'menu_position'     => self::$cpt_menu_position,
            'show_in_nav_menus' => false,
            'publicly_queryable'=> false,
            'exclude_from_search' => true,
            'has_archive'       => true,
            'can_export'        => true,
            'capability_type'   => 'post',
            'capabilities' => array(
                'read' => true,
                'create_posts' => false, // Toggles support for the "Add New" function
            ),
            'map_meta_cap' => true, // Set to false, if users are not allowed to edit/delete existing posts
        );
        register_post_type( $cpt_name_singular, $args );

        $this->filters();
        $this->pages();
        $this->shortcodes();
    }

    /**
     * Custom metaboxed for the plugin
     *
     * @return
     */
    public function metaboxes()
    {
        add_action(
            'edit_form_after_editor',
            function($post)
            {
                $mailman_options = get_post_meta($post->ID, "mailman_options", true);
                $editor_id = 'mailmandescriptioneditor';
                include MAIL_MAN_DIR_VIEWS . "metaboxes/maileditor.metabox.php";
            }
        );
    }
    /**
     * Save the custom post meta
     *
     * @return
     */
    public function save($post_id)
    {
        /**
         * None.
         */
    }

    /**
     * Create a Custom post_status_type
     * @return
     */
    public static function status_types() {
        # Register custom post status
        $cpt_post_statuses = self::$cpt_post_statuses;

        foreach ($cpt_post_statuses as $cpt_post_status) {
            register_post_status(
                $cpt_post_status,
                array(
                    'label'                     => __( ucwords($cpt_post_status), MAIL_MAN_TEXT_DOMAIN ),
                    'public'                    => true,
                    'exclude_form_search'       => true,
                    'show_in_admin_all_list'    => true,
                    'show_in_admin_status_list' => true,
                    'label_count'               => _n_noop( ucwords($cpt_post_status). ' <span class="count">(%s)</span>', ucwords($cpt_post_status).' <span class="count">(%s)</span>' )
                )
            );
        }


        # Display the status_type in the admin dropdown
        add_action(
            'admin_footer-post.php',
            function(){
                global $post;
                $complete = '';
                $label = '';
                $cpt_post_statuses = self::$cpt_post_statuses;
                foreach ($cpt_post_statuses as $cpt_post_status) {
                    if($post->post_type == self::$cpt_name_singular){
                        if($post->post_status == self::$cpt_name_singular) {
                            $complete = ' selected="selected"';
                            $label = '<span id="post-status-display"> '.ucwords($cpt_post_status).'</span>';
                        }
                        echo "
                        <script>
                            jQuery(document).ready(function(){
                                jQuery('select#post_status').append('<option value=\"$cpt_post_status\" $complete >".ucwords($cpt_post_status)."</option>');
                                jQuery('select[name=\"_status\"').append('<option value=\"$cpt_post_status\" $complete >".ucwords($cpt_post_status)."</option>');
                                jQuery('.misc-pub-section label').append('$label');
                            });
                        </script>
                        ";
                    }
                }
            }
        );

        # Display States
        add_filter(
            'display_post_states',
            function ( $states ) {
                global $post;

                if( self::$cpt_name_singular === $post->post_type )
                {
                    $cpt_post_statuses = self::$cpt_post_statuses;

                    $arg = get_query_var( 'post_status' );
                    foreach ($cpt_post_statuses as $cpt_post_status) {
                        if($arg != $cpt_post_status){
                            if($post->post_status == $cpt_post_status){
                                if('unread' == $post->post_status)
                                {
                                    return array( "<span class='color-gold'>".ucwords($cpt_post_status)."</span>" );
                                }
                            }
                        }
                    }

                }
                return $states;
            }
        );
    }

    public function notification() {
        add_filter(
            'add_menu_classes',
            function( $menu ) {
                $type = self::$cpt_name_singular;
                $status = "unread";
                $menu_position = self::$cpt_menu_position; // for email
                $num_posts = wp_count_posts( $type, 'readable' );
                $pending_count = 0;

                if ( !empty($num_posts->$status) ) {
                    $pending_count = $num_posts->$status;
                }

                // build string to match in $menu array
                if ($type == 'post') {
                    $menu_str = 'edit.php';
                // support custom post types
                } else {
                    $menu_str = 'edit.php?post_type=' . $type;
                }

                // loop through $menu items, find match, add indicator
                foreach( $menu as $menu_key => $menu_data ) {
                    if( $menu_str != $menu_data[2] )
                        continue;
                    $menu[$menu_key][0] .= " <span class='update-plugins count-$pending_count'><span class='plugin-count'>" . number_format_i18n($pending_count) . '</span></span>';
                }
                return $menu;
            }
        );

    }

    public function display($atts=null)
    {
        $options = $this->get_options();
        include $options->fallback;
        include MAIL_MAN_DIR_VIEWS . 'forms/main.form.php';
    }

    public function get_options()
    {
        $options = new stdClass();
        $options->ID = self::$cpt_name_singular . "-form";
        $options->fallback = MAIL_MAN_DIR_INCLUDES . "sender.fallback.php";
        $options->fallbackurl = MAIL_MAN_URL_INCLUDES . "sender.fallback.php";
        $options->ajaxurl = admin_url( 'admin-ajax.php' );
        $options->ajax_name = 'send_message';
        $options->options = get_option( self::$cpt_options_name );
        return $options;
    }

    public function columns($columns)
    {
        $columns = array(
            'cb' => '<input type="checkbox" />',
            'title' => __( 'Email' ),
            'email_status' => __( 'Email Status' ),
            'date' => __( 'Date' ),
        );
        return $columns;
    }

    public function custom_column($column, $post_id)
    {
        global $post;

        switch( $column ) {
            case 'email_status':
                $post_status = $post->post_status;
                echo ucwords($post_status);
                break;

            /* Just break out of the switch statement for everything else. */
            default :
                break;
        }
    }



    private function filters()
    {
        global $post_type;
        add_filter( 'enter_title_here', function ( $title ) {
            $screen = get_current_screen();
            if ( self::$cpt_name_singular == $screen->post_type ){
                $title = 'Sender\'s name';
            }
            return $title;
        });

        // Change Save Button to
        if( self::$cpt_name_singular == $post_type )
        {
            add_filter( 'gettext', 'change_publish_button', 10, 2 );
            function change_publish_button( $translation, $text ) {

                if ( $text == 'Publish' ) return 'Mark as Read';

                return $translation;
            }
        }

    }


    public function sortable($sortable_columns)
    {
       $sortable_columns[ 'email_status' ] = 'email_status';
       return $sortable_columns;
    }

    private function pages()
    {

        add_action(
            'admin_menu',
            function() {
                # Add Submenu | Settings Page
                add_submenu_page(
                    'edit.php?post_type='.self::$cpt_name_singular,
                    'Settings',
                    'Settings',
                    'manage_options',
                    self::$cpt_url_settings_link,
                    function() {
                        # Render Settings Page view
                        // global $post;
                        $plugin_settings = self::$cpt_plugin_settings;
                        $options = get_option( self::$cpt_options_name );
                        include MAIL_MAN_DIR_VIEWS . 'pages/settings.page.php';
                    }
                );
            }
        );

        add_action( 'admin_init',
            function() {
                $plugin_settings = self::$cpt_plugin_settings;
                $options_name = self::$cpt_options_name;
                # Page
                register_setting( $plugin_settings, $options_name );
            }
        );

    }

    private function shortcodes()
    {
        # Shortcode [mail_form]
        add_shortcode(
            'mail_form',
            function($atts, $content=null) {
                $atts = shortcode_atts( array(
                    'form_class' => 'form',
                    'input_before' => '<div class="form-group">',
                    'input_class' => 'form-control',
                    'input_after' => '</div>',
                    'label_class' => 'form-label',
                ), $atts );
                ob_start();
                // $action_url = MAIL_MAN_VIEWS
                $this->display($atts);
                return ob_get_clean();
            }
        );

    }

}
?>