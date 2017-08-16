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
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */
			'menu_icon' => 'dashicons-id-alt', /* the icon for the custom post type menu. uses built-in dashicons (CSS class name) */
			'rewrite'	=> array( 'slug' => 'business-listing', 'with_front' => false ), /* you can specify its url slug */
			'has_archive' => true, /* you can rename the slug here */
			'capability_type' => array('business_listing','business_listings'),
            'map_meta_cap' => true,
			'hierarchical ' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'thumbnail', 'revisions')
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
		'capabilities' => array(
			'manage_terms'=> 'manage_categories',
			'edit_terms'=> 'manage_categories',
			'delete_terms'=> 'manage_categories',
			'assign_terms' => 'read'
	    ),
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'listing-category', 'hierarchical' => true )
	)
);

/* Add fields to listing category taxonomy */
add_action( 'listing-category_add_form_fields', 'add_listing_category_fields', 10, 2 );
function add_listing_category_fields($taxonomy) {
    ?>
	<div class="form-field term-group dk_listing_new">
		<label for="listingFields[imageurl]"><?php _e( 'Image URL', 'jointswp' ); ?></label>
        <input type="text" id="listingFields[imageurl]" name="listingFields[imageurl]" />
		<label for="listingFields[imagealt]"><?php _e( 'Image Alt', 'jointswp' ); ?></label>
		<input type="text" id="listingFields[imagealt]" name="listingFields[imagealt]" />
		<label for="listingFields[desceditor]"><?php _e( 'Listing Category Description', 'jointswp' ); ?></label>
		<textarea type="text" id="listingFields[desceditor]" name="listingFields[desceditor]" rows="10" /></textarea>
		<hr>
		<h4>Sidebar</h4>
		<!-- Featured Business Checkbox -->
		<label class="dk_inline_block">
		<?php
		$checkbox_value = $meta['featured-business-checkbox'];
		if($meta['featured-business-checkbox'] == "") { ?>
				<input name="listingFields[featured-business-checkbox]" type="checkbox" value="true">
			<?php } else if($checkbox_value == "true") { ?>
				<input name="listingFields[featured-business-checkbox]" type="checkbox" value="true" checked>
			<?php
		} ?>
		Use Featured Business Widget</label>
		<!-- Featured Business Fields -->
		<label for="listingFields[featured-business-image]">Featured Business Image URL</label>
		<input type="text" name="listingFields[featured-business-image]" id="listingFields[featured-business-image]" class="meta-image regular-text" value="<?php if ( isset ( $listingFields['featured-business-image'] ) ) echo $listingFields['featured-business-image']; ?>">
		<label for="listingFields[featured-business-name]">Featured Business Name</label>
		<input type="text" name="listingFields[featured-business-name]" id="sidebar[featured-business-name]" class="regular-text" value="<?php if ( isset ( $listingFields['featured-business-name'] ) ) echo $listingFields['featured-business-name']; ?>">
		<label for="listingFields[featured-business-link]">Featured Business Link</label>
		<input type="text" name="listingFields[featured-business-link]" id="sidebar[featured-business-link]" class="regular-text" value="<?php if ( isset ( $listingFields['featured-business-link'] ) ) echo $listingFields['featured-business-link']; ?>">
		<p><strong>Other Sidebar Widgets</strong></p>
		<p style="margin-bottom: 1rem;">Check the box of each sidebar widget you would like included on this page. To edit the text or information that goes along with the widget, see the <strong>Sidebar Settings</strong> section.</p>

		<!-- Recent Issue Checkbox -->
		<label class="dk_checkbox">
		<?php
		$checkbox_value = $listingFields['recent-issue-widget'];

		if($checkbox_value == "") { ?>
				<input name="listingFields[recent-issue-widget]" type="checkbox" value="true">
			<?php } else if($checkbox_value == "true") { ?>
				<input name="listingFields[recent-issue-widget]" type="checkbox" value="true" checked>
			<?php
		} ?>
		Recent Issue Link</label>
		<!-- About the Lotus Guide Checkbox -->
		<label class="dk_checkbox">
		<?php
		$checkbox_value = $listingFields['about-widget'];

		if($checkbox_value == "") { ?>
				<input name="listingFields[about-widget]" type="checkbox" value="true">
			<?php } else if($checkbox_value == "true") { ?>
				<input name="listingFields[about-widget]" type="checkbox" value="true" checked>
			<?php
		} ?>
		About the Lotus Guide</label>
		<!-- Advertise With Us Checkbox -->
		<label class="dk_checkbox">
		<?php
		$checkbox_value = $listingFields['advertise-widget'];

		if($checkbox_value == "") { ?>
				<input name="listingFields[advertise-widget]" type="checkbox" value="true">
			<?php } else if($checkbox_value == "true") { ?>
				<input name="listingFields[advertise-widget]" type="checkbox" value="true" checked>
			<?php
		} ?>
		Advertise With Us</label>
		<!-- Testimonials Checkbox -->
		<label class="dk_checkbox">
		<?php
		$checkbox_value = $listingFields['testimonials-widget'];

		if($checkbox_value == "") { ?>
				<input name="listingFields[testimonials-widget]" type="checkbox" value="true">
			<?php } else if($checkbox_value == "true") { ?>
				<input name="listingFields[testimonials-widget]" type="checkbox" value="true" checked>
			<?php
		} ?>
		Testimonials</label>
		<!-- Newsletter Sign Up Checkbox -->
		<label class="dk_checkbox">
		<?php
		$checkbox_value = $listingFields['newsletter-widget'];

		if($checkbox_value == "") { ?>
				<input name="listingFields[newsletter-widget]" type="checkbox" value="true">
			<?php } else if($checkbox_value == "true") { ?>
				<input name="listingFields[newsletter-widget]" type="checkbox" value="true" checked>
			<?php
		} ?>
		Newsletter Sign Up</label>
		<!-- Socialize Checkbox -->
		<label class="dk_checkbox">
		<?php
		$checkbox_value = $listingFields['socialize-widget'];

		if($checkbox_value == "") { ?>
				<input name="listingFields[socialize-widget]" type="checkbox" value="true">
			<?php } else if($checkbox_value == "true") { ?>
				<input name="listingFields[socialize-widget]" type="checkbox" value="true" checked>
			<?php
		} ?>
		Socialize</label>
		<!-- Events Checkbox -->
		<label class="dk_checkbox">
		<?php
		$checkbox_value = $listingFields['events-widget'];

		if($checkbox_value == "") { ?>
				<input name="listingFields[events-widget]" type="checkbox" value="true">
			<?php } else if($checkbox_value == "true") { ?>
				<input name="listingFields[events-widget]" type="checkbox" value="true" checked>
			<?php
		} ?>
		Upcoming Events</label>
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
	/*echo '<pre>';
	print_r( $listingFields );
	echo '</pre>';*/
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
		<th scope="row"><label for="listingFields[desceditor]"><?php _e( 'Listing Category Description', 'jointswp' ); ?></label></th>
		<td>
        	<textarea rows="8" cols="70" type="text" id="listingFields[desceditor]" name="listingFields[desceditor]" /><?php if ( isset ( $listingFields['desceditor'] ) ) echo $listingFields['desceditor']; ?></textarea>
		</td>
	</tr>
	<tr class="form-field term-group-wrap dk_custom_tax_styles">
		<th scope="row"><?php _e( 'Sidebar Widgets', 'jointswp' ); ?></th>
		<td>
			<label class="dk_checkbox">
			<?php
			$checkbox_value = $listingFields['featured-business-checkbox'];
			if($checkbox_value == "") { ?>
					<input name="listingFields[featured-business-checkbox]" type="checkbox" value="true">
				<?php } else if($checkbox_value == "true") { ?>
					<input name="listingFields[featured-business-checkbox]" type="checkbox" value="true" checked>
				<?php
			} ?>
			Use Featured Business Widget</label>
			<!-- Featured Business Fields -->
			<label for="listingFields[featured-business-image]">Featured Business Image URL</label>
			<input type="text" name="listingFields[featured-business-image]" id="listingFields[featured-business-image]" class="meta-image regular-text" value="<?php if ( isset ( $listingFields['featured-business-image'] ) ) echo $listingFields['featured-business-image']; ?>">
			<label for="listingFields[featured-business-name]">Featured Business Name</label>
			<input type="text" name="listingFields[featured-business-name]" id="sidebar[featured-business-name]" class="regular-text" value="<?php if ( isset ( $listingFields['featured-business-name'] ) ) echo $listingFields['featured-business-name']; ?>">
			<label for="listingFields[featured-business-link]">Featured Business Link</label>
			<input type="text" name="listingFields[featured-business-link]" id="sidebar[featured-business-link]" class="regular-text" value="<?php if ( isset ( $listingFields['featured-business-link'] ) ) echo $listingFields['featured-business-link']; ?>">
			<p><strong>Other Widgets</strong></p>
			<p style="margin-bottom: 1rem;">Check the box of each sidebar widget you would like included on this page. To edit the text or information that goes along with the widget, see the <strong>Sidebar Settings</strong> section.</p>
			<!-- Recent Issue Checkbox -->
            <label class="dk_checkbox">
            <?php
            $checkbox_value = $listingFields['recent-issue-widget'];

            if($checkbox_value == "") { ?>
                    <input name="listingFields[recent-issue-widget]" type="checkbox" value="true">
                <?php } else if($checkbox_value == "true") { ?>
                    <input name="listingFields[recent-issue-widget]" type="checkbox" value="true" checked>
                <?php
            } ?>
            Recent Issue Link</label>
			<!-- About the Lotus Guide Checkbox -->
            <label class="dk_checkbox">
            <?php
            $checkbox_value = $listingFields['about-widget'];

            if($checkbox_value == "") { ?>
                    <input name="listingFields[about-widget]" type="checkbox" value="true">
                <?php } else if($checkbox_value == "true") { ?>
                    <input name="listingFields[about-widget]" type="checkbox" value="true" checked>
                <?php
            } ?>
            About the Lotus Guide</label>
            <!-- Advertise With Us Checkbox -->
            <label class="dk_checkbox">
            <?php
            $checkbox_value = $listingFields['advertise-widget'];

            if($checkbox_value == "") { ?>
                    <input name="listingFields[advertise-widget]" type="checkbox" value="true">
                <?php } else if($checkbox_value == "true") { ?>
                    <input name="listingFields[advertise-widget]" type="checkbox" value="true" checked>
                <?php
            } ?>
            Advertise With Us</label>
            <!-- Testimonials Checkbox -->
            <label class="dk_checkbox">
            <?php
            $checkbox_value = $listingFields['testimonials-widget'];

            if($checkbox_value == "") { ?>
                    <input name="listingFields[testimonials-widget]" type="checkbox" value="true">
                <?php } else if($checkbox_value == "true") { ?>
                    <input name="listingFields[testimonials-widget]" type="checkbox" value="true" checked>
                <?php
            } ?>
            Testimonials</label>
            <!-- Newsletter Sign Up Checkbox -->
            <label class="dk_checkbox">
            <?php
            $checkbox_value = $listingFields['newsletter-widget'];

            if($checkbox_value == "") { ?>
                    <input name="listingFields[newsletter-widget]" type="checkbox" value="true">
                <?php } else if($checkbox_value == "true") { ?>
                    <input name="listingFields[newsletter-widget]" type="checkbox" value="true" checked>
                <?php
            } ?>
            Newsletter Sign Up</label>
            <!-- Socialize Checkbox -->
            <label class="dk_checkbox">
            <?php
            $checkbox_value = $listingFields['socialize-widget'];

            if($checkbox_value == "") { ?>
                    <input name="listingFields[socialize-widget]" type="checkbox" value="true">
                <?php } else if($checkbox_value == "true") { ?>
                    <input name="listingFields[socialize-widget]" type="checkbox" value="true" checked>
                <?php
            } ?>
            Socialize</label>
            <!-- Events Checkbox -->
            <label class="dk_checkbox">
            <?php
            $checkbox_value = $listingFields['events-widget'];

            if($checkbox_value == "") { ?>
                    <input name="listingFields[events-widget]" type="checkbox" value="true">
                <?php } else if($checkbox_value == "true") { ?>
                    <input name="listingFields[events-widget]" type="checkbox" value="true" checked>
                <?php
            } ?>
            Upcoming Events</label>
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

/* Custom meta boxes for Business Listings */
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
		<div class="dk_twocolumns">
            <div class="column">
                <fieldset>
                    <legend>Business Details</legend>

					<label for="business_listings[featured]">Featured Business?
						<input type="checkbox" name="business_listings[featured]" value="true" <?php if ( isset ($meta['featured']) && $meta['featured'] === 'true' ) echo 'checked'; ?>>
					</label>

					<label for="business_listings[address]">Business Address<br><small><em>Ex: 123 Hemsworth Ln, Chico, CA 95928</em></small></label>
					<input type="text" name="business_listings[address]" id="business_listings[address]" class="regular-text" value="<?php if ( isset ( $meta['address'] ) ) echo $meta['address']; ?>">

					<label for="business_listings[phone]">Phone Number<br><small><em>Ex: (530) 555-5555</em></small></label>
					<input type="phone" name="business_listings[phone]" id="business_listings[phone]" class="regular-text" value="<?php if ( isset ( $meta['phone'] ) ) echo $meta['phone']; ?>">

					<label for="business_listings[website]">Website<br><small>Important: Make sure to add <code>http://</code><br><em>Ex: http://www.coolwebsite.com</em></small></label>
					<input type="text" name="business_listings[website]" id="business_listings[website]" class="regular-text" value="<?php if ( isset ( $meta['website'] ) ) echo $meta['website']; ?>">

					<label for="business_listings[email]">Email</label>
					<input type="email" name="business_listings[email]" id="business_listings[email]" class="regular-text" value="<?php if ( isset ( $meta['email'] ) ) echo $meta['email']; ?>">

					<label for="business_listings[businessdescription]">Business Description<br><small>Max 300 Characters</small></label>
					<textarea name="business_listings[businessdescription]" id="business_listings[businessdescription]" rows="5" cols="30" maxlength="300"><?php if ( isset ( $meta['businessdescription'] ) ) echo $meta['businessdescription']; ?></textarea>
				</fieldset>
			</div><!--
			--><div class="column">
                <fieldset>
					<legend>Business Image / Social Media</legend>
					<label for="business_listings[listingimg]">Image Upload</label>
					<input type="text" name="business_listings[listingimg]" id="business_listings[listingimg]" class="meta-image regular-text" value="<?php if ( isset ( $meta['listingimg'] ) ) echo $meta['listingimg']; ?>">
        			<input type="button" class="button image-upload" value="Browse">
                    <?php if ( isset ( $meta['listingimg'] ) ) { ?>
            		<div class="image-preview"><img src="<?php echo $meta['listingimg']; ?>"></div>
            		<?php } ?>
                    <label for="business_listings[listingimgalt]">Image Alt Tag</label><small>Provide a brief description of the image. This is important for accesibility and SEO purposes.</small>
        			<input type="text" name="business_listings[listingimgalt]" id="business_listings[listingimgalt]" class="regular-text" value="<?php if ( isset ( $meta['listingimgalt'] ) ) echo $meta['listingimgalt']; ?>">

					<label for="business_listings[facebook]">Facebook Link</label>
					<input type="text" name="business_listings[facebook]" id="business_listings[facebook]" class="regular-text" value="<?php if ( isset ( $meta['facebook'] ) ) echo $meta['facebook']; ?>">

					<label for="business_listings[googleplus]">Google Plus Link</label>
					<input type="text" name="business_listings[googleplus]" id="business_listings[googleplus]" class="regular-text" value="<?php if ( isset ( $meta['googleplus'] ) ) echo $meta['googleplus']; ?>">

					<label for="business_listings[yelp]">Yelp Link</label>
					<input type="text" name="business_listings[yelp]" id="business_listings[yelp]" class="regular-text" value="<?php if ( isset ( $meta['yelp'] ) ) echo $meta['yelp']; ?>">

					<label for="business_listings[twitter]">Twitter Link</label>
					<input type="text" name="business_listings[twitter]" id="business_listings[twitter]" class="regular-text" value="<?php if ( isset ( $meta['twitter'] ) ) echo $meta['twitter']; ?>">

					<label for="business_listings[linkedin]">Linkedin Link</label>
					<input type="text" name="business_listings[linkedin]" id="business_listings[linkedin]" class="regular-text" value="<?php if ( isset ( $meta['linkedin'] ) ) echo $meta['linkedin']; ?>">
				</fieldset>
			</div>
		</div>
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
