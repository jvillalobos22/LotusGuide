<?php
/*

Business Listings Custom Post Type

I put this in a separate file so as to
keep it organized. I find it easier to edit
and change things if they are concentrated
in their own file.

*/

// let's create the function for the custom type
function custom_post_business_listings() {
	// creating (registering) the custom type
	register_post_type( 'business_listing', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
	 	// let's now add all the options for this post type
		array('labels' => array(
			'name' => __('Business Listings', 'jointswp'), /* This is the Title of the Group */
			'singular_name' => __('Business Listing', 'jointswp'), /* This is the individual type */
			'all_items' => __('All Listings', 'jointswp'), /* the all items menu item */
			'add_new' => __('Add New', 'jointswp'), /* The add new menu item */
			'add_new_item' => __('Add New Listing', 'jointswp'), /* Add New Display Title */
			'edit' => __( 'Edit', 'jointswp' ), /* Edit Dialog */
			'edit_item' => __('Edit Listings', 'jointswp'), /* Edit Display Title */
			'new_item' => __('New Listing', 'jointswp'), /* New Display Title */
			'view_item' => __('View Listing', 'jointswp'), /* View Display Title */
			'search_items' => __('Search Business Listings', 'jointswp'), /* Search Custom Type Title */
			'not_found' =>  __('Nothing found in the Database.', 'jointswp'), /* This displays if there are no entries yet */
			'not_found_in_trash' => __('Nothing found in Trash', 'jointswp'), /* This displays if there is nothing in the trash */
			'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'Each represents a business that is listed under the Business Directory.', 'jointswp' ), /* Custom Type Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => true,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */
			'menu_icon' => 'dashicons-id-alt', /* the icon for the custom post type menu. uses built-in dashicons (CSS class name) */
			'rewrite'	=> array( 'slug' => 'business-listing', 'with_front' => false ), /* you can specify its url slug */
			'has_archive' => true, /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical ' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'editor', 'thumbnail', 'revisions')
	 	) /* end of options */
	); /* end of register post type */

	/* this adds your post categories to your custom post type */
	register_taxonomy_for_object_type('listing-category', 'business_listing');
	/* this adds your post tags to your custom post type */
	register_taxonomy_for_object_type('post_tag', 'business_listing');
}

// adding the function to the Wordpress init
add_action( 'init', 'custom_post_business_listings');

// now let's add custom categories (these act like categories)
register_taxonomy( 'listing-category',
	array('business_listing'), /* if you change the name of register_post_type( 'custom_type', then you have to change this */
	array('hierarchical' => true,     /* if this is true, it acts like categories */
		'labels' => array(
			'name' => __( 'Listing Categories', 'jointswp' ), /* name of the custom taxonomy */
			'singular_name' => __( 'Listing Category', 'jointswp' ), /* single taxonomy name */
			'search_items' =>  __( 'Search Listing Categories', 'jointswp' ), /* search title for taxomony */
			'all_items' => __( 'All Listing Categories', 'jointswp' ), /* all title for taxonomies */
			'parent_item' => __( 'Parent Listing Category', 'jointswp' ), /* parent title for taxonomy */
			'parent_item_colon' => __( 'Parent Listing Category:', 'jointswp' ), /* parent taxonomy title */
			'edit_item' => __( 'Edit Listing Category', 'jointswp' ), /* edit custom taxonomy title */
			'update_item' => __( 'Update Listing Category', 'jointswp' ), /* update title for taxonomy */
			'add_new_item' => __( 'Add New Listing Category', 'jointswp' ), /* add new title for taxonomy */
			'new_item_name' => __( 'New Listing Category Name', 'jointswp' ) /* name title for taxonomy */
		),
		'show_admin_column' => true,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'listing-category', 'hierarchical' => true )
	)
);

/* Add fields to listing category taxonomy */
add_action( 'listing-category_add_form_fields', 'add_listing_category_fields', 10, 2 );
function add_listing_category_fields($taxonomy) {
    ?>
	<div class="form-field term-group">
		<label for="listingFields[imageurl]"><?php _e( 'Image URL', 'jointswp' ); ?></label>
        <input type="text" id="listingFields[imageurl]" name="listingFields[imageurl]" />
		<label for="listingFields[imagealt]"><?php _e( 'Image Alt', 'jointswp' ); ?></label>
		<input type="text" id="listingFields[imagealt]" name="listingFields[imagealt]" />
		<label for="listingFields[desceditor]"><?php _e( 'Image Alt', 'jointswp' ); ?></label>
		<textarea type="text" id="listingFields[desceditor]" name="listingFields[desceditor]" /></textarea>
    </div>
	<?php
}

/* Save fields to listing category taxonomy */
add_action( 'created_listing-category', 'save_listing_category_meta', 10, 2 );
function save_listing_category_meta( $term_id, $tt_id ){
    if( isset( $_POST['listingFields'] ) && '' !== $_POST['listingFields'] ){
        $group = $_POST['listingFields'];
        add_term_meta( $term_id, 'listingFields', $group );
    }
}

/* Edit fields to listing category taxonomy */
add_action( 'listing-category_edit_form_fields', 'edit_listing_category_field', 10, 2 );
function edit_listing_category_field( $term, $taxonomy ){
    // get current group
    $listingAry = get_term_meta( $term->term_id, 'listingFields' );
	$listingFields = $listingAry[0];
	echo '<pre>';
	print_r( $listingFields );
	echo '</pre>';
    ?>
	<tr class="form-field term-group-wrap">
		<th scope="row"><label for="listingFields[imageurl]"><?php _e( 'Image URL', 'jointswp' ); ?></label></th>
		<td>
        	<input type="text" id="listingFields[imageurl]" name="listingFields[imageurl]" value="<?php if ( isset ( $listingFields['imageurl'] ) ) echo $listingFields['imageurl']; ?>"/>
		</td>
	</tr>
	<tr class="form-field term-group-wrap">
		<th scope="row"><label for="listingFields[imagealt]"><?php _e( 'Image Alt', 'jointswp' ); ?></label></th>
		<td>
        	<input type="text" id="listingFields[imagealt]" name="listingFields[imagealt]" value="<?php if ( isset ( $listingFields['imagealt'] ) ) echo $listingFields['imagealt']; ?>"/>
		</td>
	</tr>
	<tr class="form-field term-group-wrap">
		<th scope="row"><label for="listingFields[desceditor]"><?php _e( 'Image Alt', 'jointswp' ); ?></label></th>
		<td>
        	<textarea rows="8" cols="70" type="text" id="listingFields[desceditor]" name="listingFields[desceditor]" /><?php if ( isset ( $listingFields['desceditor'] ) ) echo $listingFields['desceditor']; ?></textarea>
		</td>
	</tr>
	<?php
}
/* Update edited fields to listing category taxonomy */
add_action( 'edited_listing-category', 'update_listing_category', 10, 2 );
function update_listing_category( $term_id, $tt_id ){

    if( isset( $_POST['listingFields'] ) && '' !== $_POST['listingFields'] ){

		$t_id = $term_id;
		$term_meta = get_option( "taxonomy_$t_id" );
		$cat_keys = array_keys( $_POST['listingFields'] );
		foreach ( $cat_keys as $key ) {
			if ( isset ( $_POST['listingFields'][$key] ) ) {
				$term_meta[$key] = $_POST['listingFields'][$key];
			}
		}
        //$group = $_POST['listingFields'];
        update_term_meta( $term_id, 'listingFields', $term_meta );
    }
}


/*
for more information on taxonomies, go here:
http://codex.wordpress.org/Function_Reference/register_taxonomy
*/

/*
	looking for custom meta boxes?
	check out this fantastic tool:
	https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress
*/

/* Custom meta boxes for Homepage Slides */
function add_business_listings_meta_box() {
	add_meta_box(
		'business_listings_meta_box', // $id
		'Business Listing Fields', // $title
		'show_business_listings_meta_box', // $callback
		'business_listing', // $screen
		'normal', // $context
		'high' // $priority
	);
}
add_action( 'add_meta_boxes', 'add_business_listings_meta_box' );

function show_business_listings_meta_box() {
	global $post;
	$meta = get_post_meta( $post->ID, 'business_listings', true ); ?>
	<div class="dk_meta_editor">
		<input type="hidden" name="business_listings_meta_box_nonce" value="<?php echo wp_create_nonce( basename(__FILE__) ); ?>">

		<!-- All fields will go here -->

	</div>
	<script>
	jQuery(document).ready(function ($) {

		// Instantiates the variable that holds the media library frame.
		var meta_image_frame;
		// Runs when the image button is clicked.
		$('.image-upload').click(function (e) {
			e.preventDefault();
			var meta_image = $(this).parent().children('.meta-image');

			// If the frame already exists, re-open it.
			if (meta_image_frame) {
				meta_image_frame.open();
				return;
			}
			// Sets up the media library frame
			meta_image_frame = wp.media.frames.meta_image_frame = wp.media({
				title: meta_image.title,
				button: {
					text: meta_image.button
				}
			});
			// Runs when an image is selected.
			meta_image_frame.on('select', function () {
				// Grabs the attachment selection and creates a JSON representation of the model.
				var media_attachment = meta_image_frame.state().get('selection').first().toJSON();
				// Sends the attachment URL to our custom image input field.
				meta_image.val(media_attachment.url);
			});
			// Opens the media library frame.
			meta_image_frame.open();
		});
	});
	</script>
	<?php
}

function save_business_listings_meta( $post_id ) {
	// verify nonce
	if ( !wp_verify_nonce( $_POST['business_listings_meta_box_nonce'], basename(__FILE__) ) ) {
		return $post_id;
	}
	// check autosave
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return $post_id;
	}
	// check permissions
	if ( 'page' === $_POST['business_listing'] ) {
		if ( !current_user_can( 'edit_page', $post_id ) ) {
			return $post_id;
		} elseif ( !current_user_can( 'edit_post', $post_id ) ) {
			return $post_id;
		}
	}

	$old = get_post_meta( $post_id, 'business_listings', true );
	$new = $_POST['business_listings'];

	if ( $new && $new !== $old ) {
		update_post_meta( $post_id, 'business_listings', $new );
	} elseif ( '' === $new && $old ) {
		delete_post_meta( $post_id, 'business_listings', $old );
	}
}
add_action( 'save_post', 'save_business_listings_meta' );