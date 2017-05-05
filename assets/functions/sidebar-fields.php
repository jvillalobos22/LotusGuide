<?php
/*
 * sidebar-fields.php
 *
 * Created by Juan Villalobos
 * @juanlobos22 | juanvillalobos.me
 * DK Web Design
 *
 * This file is included in functions.php to add
 * custom fields to the secondary page template.
 *
 * I put this in a separate file so as to
 * keep it organized. I find it easier to edit
 * and change things if they are concentrated
 * in their own file.
*/

/* Custom meta boxes for Sidebar in Post/Page Templates */
function add_sidebar_meta_box() {
    global $post;

    if(!empty($post)) {
        $pageTemplate = get_post_meta($post->ID, '_wp_page_template', true);
        $post_type = get_post_type();
        if( $pageTemplate != 'template-secondary-fullwidth.php' && $pageTemplate != 'template-ad-testimonials.php' ) {
            add_meta_box(
        		'sidebar_meta_box', // $id
        		'Sidebar Fields', // $title
        		'show_sidebar_meta_box', // $callback
        		array( 'page', 'post'), // $screen
        		'normal', // $context
        		'high' // $priority
        	);
        }
    }
}
add_action( 'add_meta_boxes', 'add_sidebar_meta_box' );

function show_sidebar_meta_box() {
	global $post;
	$meta = get_post_meta( $post->ID, 'sidebar', true );
    $pageTemplate = get_post_meta($post->ID, '_wp_page_template', true);?>
	<div class="dk_meta_editor dk_sidebar_meta">
		<input type="hidden" name="sidebar_meta_box_nonce" value="<?php echo wp_create_nonce( basename(__FILE__) ); ?>">

		<!-- All fields will go here
        <?php //if($pageTemplate == 'template-ad-testimonials.php') { ?>
            <h4><strong>Important:</strong> To add testimonials to this page, create testimonials in the section under "Ad Testimonials" on the left of your screen. From there, you can add or delete any number of testimonials.</h4>
        <?php //} ?>-->

        <fieldset>
            <legend>Featured Business</legend>
            <div class="dk_twocolumns">
                <div class="column">
                    <!-- Featured Business Checkbox -->
                    <label class="dk_inline_block">
                    <?php
                    $checkbox_value = $meta['featured-business-checkbox'];

                    if($meta['featured-business-checkbox'] == "") { ?>
                            <input name="sidebar[featured-business-checkbox]" type="checkbox" value="true">
                        <?php } else if($checkbox_value == "true") { ?>
                            <input name="sidebar[featured-business-checkbox]" type="checkbox" value="true" checked>
                        <?php
                    } ?>
                    Use Featured Business Widget</label>
                    <!-- Featured Business Fields -->
                    <label for="sidebar[featured-business-image]">Image Upload</label>
                    <input type="text" name="sidebar[featured-business-image]" id="sidebar[featured-business-image]" class="meta-image regular-text" value="<?php if ( isset ( $meta['featured-business-image'] ) ) echo $meta['featured-business-image']; ?>">
                    <input type="button" class="button image-upload" value="Browse">
                    <label for="sidebar[featured-business-name]">Business Name</label>
                    <input type="text" name="sidebar[featured-business-name]" id="sidebar[featured-business-name]" class="regular-text" value="<?php if ( isset ( $meta['featured-business-name'] ) ) echo $meta['featured-business-name']; ?>">
                    <label for="sidebar[featured-business-link]">Business Link</label>
                    <input type="text" name="sidebar[featured-business-link]" id="sidebar[featured-business-link]" class="regular-text" value="<?php if ( isset ( $meta['featured-business-link'] ) ) echo $meta['featured-business-link']; ?>">
                </div><!--
                --><div class="column">
                    <?php if ( isset ( $meta['featured-business-image'] ) ) { ?>
                    <div class="image-preview"><img src="<?php echo $meta['featured-business-image']; ?>"></div>
                    <?php } ?>
                </div>
            </div>
        </fieldset>
        <div class="dk_twocolumns">
            <h4>Sidebar Widgets</h4>
            <p style="margin-bottom: 0;">Check the box of each sidebar widget you would like included on this page. To edit the text or information that goes along with the widget, see the <strong>Sidebar Settings</strong> section.</p>
            <div class="column">
                <!-- Recent Issue Checkbox -->
                <label>
                <?php
                $checkbox_value = $meta['recent-issue-widget'];

                if($checkbox_value == "") { ?>
                        <input name="sidebar[recent-issue-widget]" type="checkbox" value="true">
                    <?php } else if($checkbox_value == "true") { ?>
                        <input name="sidebar[recent-issue-widget]" type="checkbox" value="true" checked>
                    <?php
                } ?>
                Recent Issue Link</label>
                <!-- Newsletter Sign Up Checkbox -->
                <label>
                <?php
                $checkbox_value = $meta['newsletter-widget'];

                if($checkbox_value == "") { ?>
                        <input name="sidebar[newsletter-widget]" type="checkbox" value="true">
                    <?php } else if($checkbox_value == "true") { ?>
                        <input name="sidebar[newsletter-widget]" type="checkbox" value="true" checked>
                    <?php
                } ?>
                Newsletter Sign Up</label>
                <!-- Socialize Checkbox -->
                <label>
                <?php
                $checkbox_value = $meta['socialize-widget'];

                if($checkbox_value == "") { ?>
                        <input name="sidebar[socialize-widget]" type="checkbox" value="true">
                    <?php } else if($checkbox_value == "true") { ?>
                        <input name="sidebar[socialize-widget]" type="checkbox" value="true" checked>
                    <?php
                } ?>
                Socialize</label>
                <!-- Events Checkbox -->
                <label>
                <?php
                $checkbox_value = $meta['events-widget'];

                if($checkbox_value == "") { ?>
                        <input name="sidebar[events-widget]" type="checkbox" value="true">
                    <?php } else if($checkbox_value == "true") { ?>
                        <input name="sidebar[events-widget]" type="checkbox" value="true" checked>
                    <?php
                } ?>
                Upcoming Events</label>
            </div><!--
            --><div class="column">
                <!-- About the Lotus Guide Checkbox -->
                <label>
                <?php
                $checkbox_value = $meta['about-widget'];

                if($checkbox_value == "") { ?>
                        <input name="sidebar[about-widget]" type="checkbox" value="true">
                    <?php } else if($checkbox_value == "true") { ?>
                        <input name="sidebar[about-widget]" type="checkbox" value="true" checked>
                    <?php
                } ?>
                About the Lotus Guide</label>
                <!-- Advertise With Us Checkbox -->
                <label>
                <?php
                $checkbox_value = $meta['advertise-widget'];

                if($checkbox_value == "") { ?>
                        <input name="sidebar[advertise-widget]" type="checkbox" value="true">
                    <?php } else if($checkbox_value == "true") { ?>
                        <input name="sidebar[advertise-widget]" type="checkbox" value="true" checked>
                    <?php
                } ?>
                Advertise With Us</label>
                <!-- Testimonials Checkbox -->
                <label>
                <?php
                $checkbox_value = $meta['testimonials-widget'];

                if($checkbox_value == "") { ?>
                        <input name="sidebar[testimonials-widget]" type="checkbox" value="true">
                    <?php } else if($checkbox_value == "true") { ?>
                        <input name="sidebar[testimonials-widget]" type="checkbox" value="true" checked>
                    <?php
                } ?>
                Testimonials</label>
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

function save_sidebar_meta( $post_id ) {
	// verify nonce
	if ( !wp_verify_nonce( $_POST['sidebar_meta_box_nonce'], basename(__FILE__) ) ) {
		return $post_id;
	}
	// check autosave
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return $post_id;
	}
	// check permissions
	if ( 'page' === $_POST['sidebar'] ) {
		if ( !current_user_can( 'edit_page', $post_id ) ) {
			return $post_id;
		} elseif ( !current_user_can( 'edit_post', $post_id ) ) {
			return $post_id;
		}
	}

	$old = get_post_meta( $post_id, 'sidebar', true );
	$new = $_POST['sidebar'];

	if ( $new && $new !== $old ) {
		update_post_meta( $post_id, 'sidebar', $new );
	} elseif ( '' === $new && $old ) {
		delete_post_meta( $post_id, 'sidebar', $old );
	}
}
add_action( 'save_post', 'save_sidebar_meta' );
