<?php

function community_events_redirect( $url, $request, $user ){
    if( $user && is_object( $user ) && is_a( $user, 'WP_User' ) ) {
        if( $user->has_cap( 'administrator') or $user->has_cap( 'author')) {
            $url = admin_url();
        } else {
            $url = home_url('/events/');
        }
    }
    return $url;
}
add_filter('login_redirect', 'community_events_redirect', 10, 3 );

if (!current_user_can('edit_posts')) {
	add_filter('show_admin_bar', '__return_false');
}
?>
