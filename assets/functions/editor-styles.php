<?php
// Adds your styles to the WordPress editor
/*add_action( 'init', 'add_editor_styles' );
function add_editor_styles() {
    add_editor_style( get_template_directory_uri() . '/assets/css/style.min.css' );
}*/

function admin_style() {
  wp_enqueue_style('admin-styles', get_template_directory_uri().'/assets/css/adminstyles.min.css');
}
add_action('admin_enqueue_scripts', 'admin_style');
