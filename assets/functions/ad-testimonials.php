<?php
/* joints Custom Post Type Example
This page walks you through creating
a custom post type and taxonomies. You
can edit this one or copy the following code
to create another one.

I put this in a separate file so as to
keep it organized. I find it easier to edit
and change things if they are concentrated
in their own file.

*/

// let's create the function for the custom type
function custom_post_ad_testimonials() {
	// creating (registering) the custom type
	register_post_type( 'ad_testimonial', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
	 	// let's now add all the options for this post type
		array('labels' => array(
			'name' => __('Ad Testimonials', 'jointswp'), /* This is the Title of the Group */
			'singular_name' => __('Ad Testimonial', 'jointswp'), /* This is the individual type */
			'all_items' => __('All Ad Testimonials', 'jointswp'), /* the all items menu item */
			'add_new' => __('Add New', 'jointswp'), /* The add new menu item */
			'add_new_item' => __('Add New Ad Testimonial', 'jointswp'), /* Add New Display Title */
			'edit' => __( 'Edit', 'jointswp' ), /* Edit Dialog */
			'edit_item' => __('Edit Ad Testimonial', 'jointswp'), /* Edit Display Title */
			'new_item' => __('New Ad Testimonial', 'jointswp'), /* New Display Title */
			'view_item' => __('View Ad Testimonial', 'jointswp'), /* View Display Title */
			'search_items' => __('Search Ad Testimonials', 'jointswp'), /* Search Custom Type Title */
			'not_found' =>  __('Nothing found in the Database.', 'jointswp'), /* This displays if there are no entries yet */
			'not_found_in_trash' => __('Nothing found in Trash', 'jointswp'), /* This displays if there is nothing in the trash */
			'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'These are the testimonials that show up on the testimonail page under Advertise With Us.', 'jointswp' ), /* Custom Type Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => true,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */
			'menu_icon' => 'dashicons-format-quote', /* the icon for the custom post type menu. uses built-in dashicons (CSS class name) */
			'rewrite'	=> array( 'slug' => 'ad-testimonial', 'with_front' => false ), /* you can specify its url slug */
			'has_archive' => true, /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical ' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'revisions', 'sticky')
	 	) /* end of options */
	); /* end of register post type */

	/* this adds your post categories to your custom post type
	register_taxonomy_for_object_type('category', 'ad_testimonial');
	/* this adds your post tags to your custom post type
	register_taxonomy_for_object_type('post_tag', 'ad_testimonial');*/
}

// adding the function to the Wordpress init
add_action( 'init', 'custom_post_ad_testimonials');

/*
	looking for custom meta boxes?
	check out this fantastic tool:
	https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress
*/

/* Custom meta boxes for Homepage Slides */
function add_ad_testimonials_meta_box() {
	add_meta_box(
		'ad_testimonials_meta_box', // $id
		'Ad Testimonial Fields', // $title
		'show_ad_testimonials_meta_box', // $callback
		'ad_testimonial', // $screen
		'normal', // $context
		'high' // $priority
	);
}
add_action( 'add_meta_boxes', 'add_ad_testimonials_meta_box' );

function show_ad_testimonials_meta_box() {
	global $post;
	$meta = get_post_meta( $post->ID, 'ad_testimonial', true ); ?>
	<div class="dk_meta_editor">
		<input type="hidden" name="ad_testimonials_meta_box_nonce" value="<?php echo wp_create_nonce( basename(__FILE__) ); ?>">

		<!-- All fields will go here -->
		<label for="ad_testimonial[testimonial-quote]">Testimonial Quote (Don't add quotations)</label>
        <textarea name="ad_testimonial[testimonial-quote]" id="ad_testimonial[testimonial-quote]" rows="8" cols="70" style="width: 100%; max-width: 450px;"><?php if ( isset ( $meta['testimonial-quote'] ) ) echo $meta['testimonial-quote']; ?></textarea>

		<label for="ad_testimonial[testimonial-details]">Testimonial Details: Name, Location (Service)<br>Ex: John Doe, Chico CA (Yelp)</label>
		<input type="text" name="ad_testimonial[testimonial-details]" id="ad_testimonial[testimonial-details]" class="regular-text" value="<?php if ( isset ( $meta['testimonial-details'] ) ) echo $meta['testimonial-details']; ?>">
	</div>
	<?php
}

function save_ad_testimonials_meta( $post_id ) {
	// verify nonce
	if ( !wp_verify_nonce( $_POST['ad_testimonials_meta_box_nonce'], basename(__FILE__) ) ) {
		return $post_id;
	}
	// check autosave
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return $post_id;
	}
	// check permissions
	if ( 'page' === $_POST['ad_testimonial'] ) {
		if ( !current_user_can( 'edit_page', $post_id ) ) {
			return $post_id;
		} elseif ( !current_user_can( 'edit_post', $post_id ) ) {
			return $post_id;
		}
	}

	$old = get_post_meta( $post_id, 'ad_testimonial', true );
	$new = $_POST['ad_testimonial'];

	if ( $new && $new !== $old ) {
		update_post_meta( $post_id, 'ad_testimonial', $new );
	} elseif ( '' === $new && $old ) {
		delete_post_meta( $post_id, 'ad_testimonial', $old );
	}
}
add_action( 'save_post', 'save_ad_testimonials_meta' );
