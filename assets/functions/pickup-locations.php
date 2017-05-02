<?php
/*

Pickup Locations Custom Post Type

I put this in a separate file so as to
keep it organized. I find it easier to edit
and change things if they are concentrated
in their own file.

*/

// let's create the function for the custom type
function custom_post_pickup_locations() {
	// creating (registering) the custom type
	register_post_type( 'pickup_location', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
	 	// let's now add all the options for this post type
		array('labels' => array(
			'name' => __('Pickup Locations', 'jointswp'), /* This is the Title of the Group */
			'singular_name' => __('Pickup Location', 'jointswp'), /* This is the individual type */
			'all_items' => __('All Locations', 'jointswp'), /* the all items menu item */
			'add_new' => __('Add New', 'jointswp'), /* The add new menu item */
			'add_new_item' => __('Add New Location', 'jointswp'), /* Add New Display Title */
			'edit' => __( 'Edit', 'jointswp' ), /* Edit Dialog */
			'edit_item' => __('Edit Locations', 'jointswp'), /* Edit Display Title */
			'new_item' => __('New Location', 'jointswp'), /* New Display Title */
			'view_item' => __('View Location', 'jointswp'), /* View Display Title */
			'search_items' => __('Search Pickup Locations', 'jointswp'), /* Search Custom Type Title */
			'not_found' =>  __('Nothing found in the Database.', 'jointswp'), /* This displays if there are no entries yet */
			'not_found_in_trash' => __('Nothing found in Trash', 'jointswp'), /* This displays if there is nothing in the trash */
			'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'Each represents a city where the magazine is distributed and will contain a list of all the locations within that city.', 'jointswp' ), /* Custom Type Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => true,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 9, /* this is what order you want it to appear in on the left hand side menu */
			'menu_icon' => 'dashicons-location-alt', /* the icon for the custom post type menu. uses built-in dashicons (CSS class name) */
			'rewrite'	=> array( 'slug' => 'pickup-location', 'with_front' => false ), /* you can specify its url slug */
			'has_archive' => true, /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical ' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'editor', 'revisions')
	 	) /* end of options */
	); /* end of register post type */

	/* this adds your post tags to your custom post type */
	register_taxonomy_for_object_type('post_tag', 'pickup_location');
}

// adding the function to the Wordpress init
add_action( 'init', 'custom_post_pickup_locations');

/*
	looking for custom meta boxes?
	check out this fantastic tool:
	https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress
*/

/* Custom meta boxes for Business Listings */
function add_pickup_locations_meta_box() {
	add_meta_box(
		'pickup_locations_meta_box', // $id
		'Pickup Locations Fields', // $title
		'show_pickup_locations_meta_box', // $callback
		'pickup_location', // $screen
		'normal', // $context
		'high' // $priority
	);
}
add_action( 'add_meta_boxes', 'add_pickup_locations_meta_box' );

function show_pickup_locations_meta_box() {
	global $post;
	$meta = get_post_meta( $post->ID, 'pickup_locations', true ); ?>
	<div class="dk_meta_editor">
		<input type="hidden" name="pickup_locations_meta_box_nonce" value="<?php echo wp_create_nonce( basename(__FILE__) ); ?>">
	</div>
	<?php
}

function save_pickup_locations_meta( $post_id ) {
	// verify nonce
	if ( !wp_verify_nonce( $_POST['pickup_locations_meta_box_nonce'], basename(__FILE__) ) ) {
		return $post_id;
	}
	// check autosave
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return $post_id;
	}
	// check permissions
	if ( 'page' === $_POST['pickup_location'] ) {
		if ( !current_user_can( 'edit_page', $post_id ) ) {
			return $post_id;
		} elseif ( !current_user_can( 'edit_post', $post_id ) ) {
			return $post_id;
		}
	}

	$old = get_post_meta( $post_id, 'pickup_locations', true );
	$new = $_POST['pickup_locations'];

	if ( $new && $new !== $old ) {
		update_post_meta( $post_id, 'pickup_locations', $new );
	} elseif ( '' === $new && $old ) {
		delete_post_meta( $post_id, 'pickup_locations', $old );
	}
}
add_action( 'save_post', 'save_pickup_locations_meta' );
