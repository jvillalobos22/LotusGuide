<?php
// Theme support options
require_once(get_template_directory().'/assets/functions/theme-support.php');

// WP Head and other cleanup functions
require_once(get_template_directory().'/assets/functions/cleanup.php');

// Register scripts and stylesheets
require_once(get_template_directory().'/assets/functions/enqueue-scripts.php');

// Register custom menus and menu walkers
require_once(get_template_directory().'/assets/functions/menu.php');

// Register sidebars/widget areas
require_once(get_template_directory().'/assets/functions/sidebar.php');

// Makes WordPress comments suck less
require_once(get_template_directory().'/assets/functions/comments.php');

// Replace 'older/newer' post links with numbered navigation
require_once(get_template_directory().'/assets/functions/page-navi.php');

// Adds support for multiple languages
require_once(get_template_directory().'/assets/translation/translation.php');

// Remove 4.2 Emoji Support
// require_once(get_template_directory().'/assets/functions/disable-emoji.php');

// Adds site styles to the WordPress editor
require_once(get_template_directory().'/assets/functions/editor-styles.php');

// Related post function - no need to rely on plugins
// require_once(get_template_directory().'/assets/functions/related-posts.php');

// Use this as a template for custom post types
require_once(get_template_directory().'/assets/functions/homepage-slides.php');
require_once(get_template_directory().'/assets/functions/ad-testimonials.php');
require_once(get_template_directory().'/assets/functions/business-listings.php');
require_once(get_template_directory().'/assets/functions/pickup-locations.php');
//require_once(get_template_directory().'/assets/functions/custom-post-type.php');

// Custom Fields
require_once(get_template_directory().'/assets/functions/homepage-fields.php');
require_once(get_template_directory().'/assets/functions/secondarypage-fields.php');
require_once(get_template_directory().'/assets/functions/sidebar-fields.php');

// Add Custom Settings Pages
require_once(get_template_directory().'/assets/functions/sidebar-settings.php');
require_once(get_template_directory().'/assets/functions/social-media-settings.php');

// Custom Shortcodes
require_once(get_template_directory().'/assets/functions/dk-shortcodes.php');

// Customize the WordPress login menu
// require_once(get_template_directory().'/assets/functions/login.php');

// Customize the WordPress admin
require_once(get_template_directory().'/assets/functions/admin.php');

// Custom Logo on Login/Register Screen
function my_login_logo() { ?>
    <style type="text/css">
        body.login {
            background-image: linear-gradient(#d2eeee, #cde2c1);
            background-attachment: fixed;
        }
        body.login #login_error, body.login .message {
            border-left: 4px solid #df679b;
        }
        body.login.wp-core-ui .button-primary {
            background: #df679b;
            border-color: #df679b #AC3468 #AC3468;
            -webkit-box-shadow: 0 1px 0 #AC3468;
            box-shadow: 0 1px 0 #AC3468;
            color: #fff;
            text-decoration: none;
            text-shadow: 0 -1px 1px #AC3468, 1px 0 1px #AC3468, 0 1px 1px #AC3468, -1px 0 1px #AC3468
        }
        body.wp-core-ui .button-primary:hover, body.wp-core-ui .button-primary:active, body.wp-core-ui .button-primary:focus {
            background-color: #AC3468;
        }
        #login h1 {
            background-color: #fff;
            box-shadow: 0 1px 3px rgba(0, 0, 0, .13)
        }
        #login h1 a, .login h1 a {
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/assets/images/lotus-guide-logo.png);
    		width: 100%;
            height: 150px;
    		background-size: 280px 140px;
    		background-repeat: no-repeat;
            background-position: center;
            padding-bottom: 30px;

        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );
