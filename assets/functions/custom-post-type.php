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
function custom_post_homepageslides() {
	// creating (registering) the custom type
	register_post_type( 'homepage_slide', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
	 	// let's now add all the options for this post type
		array('labels' => array(
			'name' => __('Homepage Slides', 'jointswp'), /* This is the Title of the Group */
			'singular_name' => __('Slide', 'jointswp'), /* This is the individual type */
			'all_items' => __('All Slides', 'jointswp'), /* the all items menu item */
			'add_new' => __('Add New', 'jointswp'), /* The add new menu item */
			'add_new_item' => __('Add New Slide', 'jointswp'), /* Add New Display Title */
			'edit' => __( 'Edit', 'jointswp' ), /* Edit Dialog */
			'edit_item' => __('Edit Slides', 'jointswp'), /* Edit Display Title */
			'new_item' => __('New Slide', 'jointswp'), /* New Display Title */
			'view_item' => __('View Slide', 'jointswp'), /* View Display Title */
			'search_items' => __('Search Slide', 'jointswp'), /* Search Custom Type Title */
			'not_found' =>  __('Nothing found in the Database.', 'jointswp'), /* This displays if there are no entries yet */
			'not_found_in_trash' => __('Nothing found in Trash', 'jointswp'), /* This displays if there is nothing in the trash */
			'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'These are the slides that show up in the home page image slider.', 'jointswp' ), /* Custom Type Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => true,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */
			'menu_icon' => 'dashicons-format-gallery', /* the icon for the custom post type menu. uses built-in dashicons (CSS class name) */
			'rewrite'	=> array( 'slug' => 'slide', 'with_front' => false ), /* you can specify its url slug */
			'has_archive' => true, /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical ' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'thumbnail', 'revisions', 'sticky')
	 	) /* end of options */
	); /* end of register post type */

	/* this adds your post categories to your custom post type */
	register_taxonomy_for_object_type('category', 'homepage_slide');
	/* this adds your post tags to your custom post type */
	register_taxonomy_for_object_type('post_tag', 'homepage_slide');
}

// adding the function to the Wordpress init
add_action( 'init', 'custom_post_homepageslides');

/*
for more information on taxonomies, go here:
http://codex.wordpress.org/Function_Reference/register_taxonomy
*/

// now let's add custom categories (these act like categories)
register_taxonomy( 'custom_cat',
	array('custom_type'), /* if you change the name of register_post_type( 'custom_type', then you have to change this */
	array('hierarchical' => true,     /* if this is true, it acts like categories */
		'labels' => array(
			'name' => __( 'Custom Categories', 'jointswp' ), /* name of the custom taxonomy */
			'singular_name' => __( 'Custom Category', 'jointswp' ), /* single taxonomy name */
			'search_items' =>  __( 'Search Custom Categories', 'jointswp' ), /* search title for taxomony */
			'all_items' => __( 'All Custom Categories', 'jointswp' ), /* all title for taxonomies */
			'parent_item' => __( 'Parent Custom Category', 'jointswp' ), /* parent title for taxonomy */
			'parent_item_colon' => __( 'Parent Custom Category:', 'jointswp' ), /* parent taxonomy title */
			'edit_item' => __( 'Edit Custom Category', 'jointswp' ), /* edit custom taxonomy title */
			'update_item' => __( 'Update Custom Category', 'jointswp' ), /* update title for taxonomy */
			'add_new_item' => __( 'Add New Custom Category', 'jointswp' ), /* add new title for taxonomy */
			'new_item_name' => __( 'New Custom Category Name', 'jointswp' ) /* name title for taxonomy */
		),
		'show_admin_column' => true,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'custom-slug' ),
	)
);

// now let's add custom tags (these act like categories)
register_taxonomy( 'custom_tag',
	array('custom_type'), /* if you change the name of register_post_type( 'custom_type', then you have to change this */
	array('hierarchical' => false,    /* if this is false, it acts like tags */
		'labels' => array(
			'name' => __( 'Custom Tags', 'jointswp' ), /* name of the custom taxonomy */
			'singular_name' => __( 'Custom Tag', 'jointswp' ), /* single taxonomy name */
			'search_items' =>  __( 'Search Custom Tags', 'jointswp' ), /* search title for taxomony */
			'all_items' => __( 'All Custom Tags', 'jointswp' ), /* all title for taxonomies */
			'parent_item' => __( 'Parent Custom Tag', 'jointswp' ), /* parent title for taxonomy */
			'parent_item_colon' => __( 'Parent Custom Tag:', 'jointswp' ), /* parent taxonomy title */
			'edit_item' => __( 'Edit Custom Tag', 'jointswp' ), /* edit custom taxonomy title */
			'update_item' => __( 'Update Custom Tag', 'jointswp' ), /* update title for taxonomy */
			'add_new_item' => __( 'Add New Custom Tag', 'jointswp' ), /* add new title for taxonomy */
			'new_item_name' => __( 'New Custom Tag Name', 'jointswp' ) /* name title for taxonomy */
		),
		'show_admin_column' => true,
		'show_ui' => true,
		'query_var' => true,
	)
);

/*
	looking for custom meta boxes?
	check out this fantastic tool:
	https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress
*/


/* Custom meta boxes for Homepage Slides */
function add_slides_meta_box() {
	add_meta_box(
		'slides_meta_box', // $id
		'Homepage Slide Fields', // $title
		'show_slides_meta_box', // $callback
		'homepage_slide', // $screen
		'normal', // $context
		'high' // $priority
	);
}
add_action( 'add_meta_boxes', 'add_slides_meta_box' );

function show_slides_meta_box() {
	global $post;
	$meta = get_post_meta( $post->ID, 'slides', true ); ?>
	<div class="dk_meta_editor">
		<input type="hidden" name="slides_meta_box_nonce" value="<?php echo wp_create_nonce( basename(__FILE__) ); ?>">

		<!-- All fields will go here -->
		<div>
			<label for="slides[image]">Image Upload</label><br>
			<input type="text" name="slides[image]" id="slides[image]" class="meta-image regular-text" value="<?php if ( isset ( $meta['image'] ) ) echo $meta['image']; ?>">
			<input type="button" class="button image-upload" value="Browse">
		</div>
		<div>
			<label for="slides[alt]">Image Alt Tag</label><br><small>Provide a brief description of the image. This is important for accesibility and SEO purposes.</small><br>
			<input type="text" name="slides[alt]" id="slides[alt]" class="regular-text" value="<?php if ( isset ( $meta['alt'] ) ) echo $meta['alt']; ?>">
		</div>
		<?php if ( isset ( $meta['image'] ) ) { ?>
		<div class="image-preview"><img src="<?php echo $meta['image']; ?>"></div>
		<?php } else { ?>
			<div class="image-preview"><p>Please add an image to the slide and click "update".</div>
		<?php } ?>
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

function save_slides_meta( $post_id ) {
	// verify nonce
	if ( !wp_verify_nonce( $_POST['slides_meta_box_nonce'], basename(__FILE__) ) ) {
		return $post_id;
	}
	// check autosave
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return $post_id;
	}
	// check permissions
	if ( 'page' === $_POST['homepage_slide'] ) {
		if ( !current_user_can( 'edit_page', $post_id ) ) {
			return $post_id;
		} elseif ( !current_user_can( 'edit_post', $post_id ) ) {
			return $post_id;
		}
	}

	$old = get_post_meta( $post_id, 'slides', true );
	$new = $_POST['slides'];

	if ( $new && $new !== $old ) {
		update_post_meta( $post_id, 'slides', $new );
	} elseif ( '' === $new && $old ) {
		delete_post_meta( $post_id, 'slides', $old );
	}
}
add_action( 'save_post', 'save_slides_meta' );
