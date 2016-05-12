<?php


class MailManDashboardController extends MailManController
{
    public static $remove_default_widgets = array(
        'dashboard_incoming_links' => array(
            'page'      => 'dashboard',
            'context'   => 'normal'
        ),
        'dashboard_right_now'      => array(
            'page'      => 'dashboard',
            'context'   => 'normal'
        ),
        'dashboard_recent_drafts'      => array(
            'page'      => 'dashboard',
            'context'   => 'side'
        ),
        'dashboard_quick_press'        => array(
            'page'      => 'dashboard',
            'context'   => 'side'
        ),
        'dashboard_plugins'            => array(
            'page'      => 'dashboard',
            'context'   => 'side'
        ),
        'dashboard_primary'            => array(
            'page'      => 'dashboard',
            'context'   => 'side'
        ),
        'dashboard_secondary'          => array(
            'page'      => 'dashboard',
            'context'   => 'side'
        ),
        'dashboard_recent_comments'    => array(
            'page'      => 'dashboard',
            'context'   => 'normal'
        )

    );

    public static $mail_man_dashboard_widgets = array(
        'mail_man_dashboard_new_emails' => array(
            'title'     => 'New Emails',
            'callback'  => 'mail_man_dashboard_new_emails_callback',
        )
    );

    public function __construct() {
        add_action('wp_dashboard_setup', array($this, 'remove_dashboard_widgets'));
        add_action('wp_dashboard_setup', array($this, 'add_dashboard_widgets'));
    }

    # Remove Dashboard Widget
    public function remove_dashboard_widgets() {
        $remove_default_widgets = self::$remove_default_widgets;

        foreach ($remove_default_widgets as $widget_id => $options) {
            remove_meta_box($widget_id, $options['page'], $options['context']);
        }
    }

    # Add Dashboard Widget
    public function add_dashboard_widgets() {
        $mail_man_dashboard_widgets = self::$mail_man_dashboard_widgets;

        wp_add_dashboard_widget(
            'mail_man_dashboard_new_emails',
            'New Emails',
            function() {
                $mail_man_post_type = parent::$cpt_name_singular;
                $user = wp_get_current_user();
                $args = array(
                    'orderby'          => 'date',
                    'order'            => 'DESC',
                    'post_type'        => $mail_man_post_type,
                    'post_status'      => 'unread',
                    'suppress_filters' => true,
                );
                $posts_array = get_posts( $args );

                include MAIL_MAN_DIR_VIEWS . "widgets/dashboard.widget.php";

            }
        );

    }


    // public function display()
    // {
    //     // code..
    // }
}
?>