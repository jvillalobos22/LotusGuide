<?php

// function community_events_redirect( $url, $request, $user ){
//     if( $user && is_object( $user ) && is_a( $user, 'WP_User' ) ) {
//         if( $user->has_cap( 'administrator') or $user->has_cap( 'author')) {
//             $url = admin_url();
//         } else {
//             $url = admin_url();
//             // $url = home_url('/events/');
//         }
//     }
//     return $url;
// }
// add_filter('login_redirect', 'community_events_redirect', 10, 3 );

if (current_user_can('edit_posts')) {
	add_filter('show_admin_bar', '__return_true');
    // add_filter('show_admin_bar', '__return_false');
}

function dk_add_business_listing_role() {
	add_role('dk_business_listing_user', 'Business Listing User',
        array(
            'read' => true,
            'edit_posts' => false,
            'delete_posts' => false,
            'publish_posts' => false,
            'upload_files' => true,
        )
    );
}
// register_activation_hook( __FILE__, 'dk_add_business_listing_role' );
add_action('admin_init','dk_add_business_listing_role',998);

// Add Business Listing roles & capabilities
add_action('admin_init','dk_add_role_caps',999);
function dk_add_role_caps() {
	// Add the roles you'd like to administer the custom post types
	$roles = array('dk_business_listing_user','editor','administrator');

	// Loop through each role and assign capabilities
	foreach($roles as $the_role) {
		$role = get_role($the_role);

		$role->add_cap( 'read' );
		$role->add_cap( 'read_business_listing');
		$role->add_cap( 'read_private_business_listings' );
		$role->add_cap( 'edit_business_listing' );
		$role->add_cap( 'edit_business_listings' );
		$role->add_cap( 'edit_others_business_listings' );
		$role->add_cap( 'edit_published_business_listings' );
		$role->add_cap( 'publish_business_listings' );
		$role->add_cap( 'delete_others_business_listings' );
		$role->add_cap( 'delete_private_business_listings' );
		$role->add_cap( 'delete_published_business_listings' );
		$role->add_cap( 'assign_terms' );
	}

	$dkRole = get_role('dk_business_listing_user');
	$dkRole->remove_cap( 'manage_categories' );
}

add_action( 'pre_get_posts', 'dk_filter_business_listing_by_creator' );
function dk_filter_business_listing_by_creator( $wp_query_obj ) {
    // Front end, do nothing
    if( !is_admin() )
        return;

    global $current_user, $pagenow;
    get_currentuserinfo();

    // http://php.net/manual/en/function.is-a.php
    if( !is_a( $current_user, 'WP_User') )
        return;

    // Not the correct screen, bail out
    if( 'edit.php' != $pagenow )
        return;

    // Not the correct post type, bail out
    if( 'business_listing' != $wp_query_obj->query['post_type'] )
        return;

    // If the user is not administrator, filter the post listing
    if( !current_user_can( 'delete_plugins' ) )
        $wp_query_obj->set('author', $current_user->ID );
}

// Adds custom role users to select box when assigning authorship
add_filter('wp_dropdown_users', 'addAuthorsToSelect');
function addAuthorsToSelect($output) {
    global $post;
    if($post->post_type == 'business_listing') {
        $users = get_users(array('role__in'=>array('dk_business_listing_user','administrator','editor','author')));
        $output = "<select id='post_author_override' name='post_author_override' class=''>";
        foreach($users as $user) {
            $output .= "<option value='".$user->id."' ".(($post->post_author==$user->id)?'selected="selected"':'').">".$user->display_name." (".$user->user_login.")</option>";
        }
        $output .= "</select>";
    }
    return $output;
}
?>
