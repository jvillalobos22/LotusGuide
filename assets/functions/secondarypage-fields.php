<?php
/*
 * secondarypage-fields.php
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

/* Custom meta boxes for Secondary Page Template */
function add_secpage_meta_box() {
    global $post;

    if(!empty($post)) {
        $pageTemplate = get_post_meta($post->ID, '_wp_page_template', true);
        /*
           if ($pageTemplate == 'template-secondary.php' ||
           $pageTemplate == 'template-secondary-fullwidth.php' ||
           $pageTemplate == 'template-ad-testimonials.php' ||
           $pageTemplate == 'template-business-directory.php' ||
           $pageTemplate == 'template-blog.php' ||
           $pageTemplate == 'template-pickup-locations-index.php' ||
           $pageTemplate == 'page.php')
           */
        if($pageTemplate != 'template-homepage.php') {
            add_meta_box(
        		'secpage_meta_box', // $id
        		'Secondary Page Template Fields', // $title
        		'show_secpage_meta_box', // $callback
        		'page', // $screen
        		'normal', // $context
        		'high' // $priority
        	);
        }
    }
}
add_action( 'add_meta_boxes', 'add_secpage_meta_box' );

function show_secpage_meta_box() {
	global $post;
	$meta = get_post_meta( $post->ID, 'secpage', true );
    $pageTemplate = get_post_meta($post->ID, '_wp_page_template', true);?>
	<div class="dk_meta_editor">
		<input type="hidden" name="secpage_meta_box_nonce" value="<?php echo wp_create_nonce( basename(__FILE__) ); ?>">

		<!-- All fields will go here -->
        <?php if($pageTemplate == 'template-ad-testimonials.php') { ?>
            <h4><strong>Important:</strong> To add testimonials to this page, create testimonials in the section under "Ad Testimonials" on the left of your screen. From there, you can add or delete any number of testimonials.</h4>
        <?php } ?>

        <fieldset>
            <legend>Banner Image</legend>
            <label for="secpage[banner-image]">Image Upload</label>
            <input type="text" name="secpage[banner-image]" id="secpage[banner-image]" class="meta-image regular-text" value="<?php if ( isset ( $meta['banner-image'] ) ) echo $meta['banner-image']; ?>">
            <input type="button" class="button image-upload" value="Browse">
            <?php if ( isset ( $meta['banner-image'] ) ) { ?>
            <div class="image-preview"><img src="<?php echo $meta['banner-image']; ?>"></div>
            <?php } ?>
            <label for="secpage[banner-image-alt]">Image Alt Tag</label><small>Provide a brief description of the image. This is important for accesibility and SEO purposes.</small>
            <input type="text" name="secpage[banner-image-alt]" id="secpage[bbanner-image-alt]" class="regular-text" value="<?php if ( isset ( $meta['banner-image-alt'] ) ) echo $meta['banner-image-alt']; ?>">
        </fieldset>
        <div class="dk_twocolumns">
            <div class="column">
                <label for="secpage[secpage-title-prefix]">Secondary Page Title Prefix</label><small>First part of the headline that is black.</small>
			    <input type="text" name="secpage[secpage-title-prefix]" id="secpage[secpage-title-prefix]" class="regular-text" value="<?php if ( isset ( $meta['secpage-title-prefix'] ) ) echo $meta['secpage-title-prefix']; ?>">
            </div><!--
            --><div class="column">
                <label for="secpage[secpage-title-ending]">Secondary Page Title Ending</label><small>This is the part of the headline that is blue.</small>
    			<input type="text" name="secpage[secpage-title-ending]" id="secpage[secpage-title-ending]" class="regular-text" value="<?php if ( isset ( $meta['secpage-title-ending'] ) ) echo $meta['secpage-title-ending']; ?>">
            </div>
        </div>
        <label for="secpage[secpage-subheading]">Secondary Page Subheading</label>
        <textarea name="secpage[secpage-subheading]" id="secpage[secpage-subheading]" rows="3" cols="70" style="width: 100%; max-width: 450px;"><?php if ( isset ( $meta['secpage-subheading'] ) ) echo $meta['secpage-subheading']; ?></textarea>
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

function save_secpage_meta( $post_id ) {
	// verify nonce
	if ( !wp_verify_nonce( $_POST['secpage_meta_box_nonce'], basename(__FILE__) ) ) {
		return $post_id;
	}
	// check autosave
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return $post_id;
	}
	// check permissions
	if ( 'page' === $_POST['secpage'] ) {
		if ( !current_user_can( 'edit_page', $post_id ) ) {
			return $post_id;
		} elseif ( !current_user_can( 'edit_post', $post_id ) ) {
			return $post_id;
		}
	}

	$old = get_post_meta( $post_id, 'secpage', true );
	$new = $_POST['secpage'];

	if ( $new && $new !== $old ) {
		update_post_meta( $post_id, 'secpage', $new );
	} elseif ( '' === $new && $old ) {
		delete_post_meta( $post_id, 'secpage', $old );
	}
}
add_action( 'save_post', 'save_secpage_meta' );
