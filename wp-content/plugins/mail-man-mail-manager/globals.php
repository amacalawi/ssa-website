<?php

# Path
define('MAIL_MAN_DIR', plugin_dir_path(__FILE__));
define('MAIL_MAN_DIR_CLASSES', plugin_dir_path(__FILE__).'classes/');
define('MAIL_MAN_DIR_CONTROLLERS', plugin_dir_path(__FILE__).'controllers/');
define('MAIL_MAN_DIR_FUNCTIONS', plugin_dir_path(__FILE__).'functions/');
define('MAIL_MAN_DIR_INCLUDES', plugin_dir_path(__FILE__).'includes/');
define('MAIL_MAN_DIR_VIEWS', plugin_dir_path(__FILE__). 'views/');
define('MAIL_MAN_DIR_VENDOR', plugin_dir_path(__FILE__). 'vendor/');
# URL
define('MAIL_MAN_URL', plugin_dir_url(__FILE__));
define('MAIL_MAN_URL_INCLUDES', plugin_dir_url(__FILE__).'includes/');
define('MAIL_MAN_URL_COMPONENTS', plugin_dir_url(__FILE__).'components/');
define('MAIL_MAN_URL_FUNCTIONS_URL', plugin_dir_url(__FILE__).'functions/');
define('MAIL_MAN_URL_ASSETS', plugin_dir_url(__FILE__).'assets/');

define('MAIL_MAN_TEXT_DOMAIN', 'mail-man-text-domain');

# Helpers
include "includes/helpers.php";

# Controllers
foreach (glob(MAIL_MAN_DIR_CONTROLLERS."*.php") as $filename)
{
    include $filename;
}

# Enqueue
include "includes/enqueue.php";
?>