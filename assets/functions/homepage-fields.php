<?php
/*
 * homepage-fields.php
 *
 * Created by Juan Villalobos
 * @juanlobos22 | juanvillalobos.me
 * DK Web Design
 *
 * This file is included in functions.php to add
 * custom fields to the homepage template.
 *
 * I put this in a separate file so as to
 * keep it organized. I find it easier to edit
 * and change things if they are concentrated
 * in their own file.
*/

/* Custom meta boxes for Homepage Template */
function add_homepage_meta_box() {
    global $post;

    if(!empty($post)) {
        $pageTemplate = get_post_meta($post->ID, '_wp_page_template', true);

        if($pageTemplate == 'template-homepage.php' ) {
            add_meta_box(
        		'homepage_meta_box', // $id
        		'Homepage Template Fields', // $title
        		'show_homepage_meta_box', // $callback
        		'page', // $screen
        		'normal', // $context
        		'high' // $priority
        	);
        }
    }
}
add_action( 'add_meta_boxes', 'add_homepage_meta_box' );

function show_homepage_meta_box() {
	global $post;
	$meta = get_post_meta( $post->ID, 'homepage', true ); ?>
	<div class="dk_meta_editor">
		<input type="hidden" name="homepage_meta_box_nonce" value="<?php echo wp_create_nonce( basename(__FILE__) ); ?>">

		<!-- All fields will go here -->
        <div class="dk_twocolumns">
            <div class="column">
                <label for="homepage[homepage-title-prefix]">Homepage Title Prefix</label><small>First part of the headline that is black.</small>
			    <input type="text" name="homepage[homepage-title-prefix]" id="homepage[homepage-title-prefix]" class="regular-text" value="<?php if ( isset ( $meta['homepage-title-prefix'] ) ) echo $meta['homepage-title-prefix']; ?>">
            </div><!--
            --><div class="column">
                <label for="homepage[homepage-title-ending]">Homepage Title Ending</label><small>This is the part of the headline that is blue.</small>
    			<input type="text" name="homepage[homepage-title-ending]" id="homepage[homepage-title-ending]" class="regular-text" value="<?php if ( isset ( $meta['homepage-title-ending'] ) ) echo $meta['homepage-title-ending']; ?>">
            </div>
        </div>
        <label for="homepage[homepage-subheading]">Homepage Subheading</label>
        <textarea name="homepage[homepage-subheading]" id="homepage[homepage-subheading]" rows="3" cols="70" style="width: 100%; max-width: 450px;"><?php if ( isset ( $meta['homepage-subheading'] ) ) echo $meta['homepage-subheading']; ?></textarea>
        <div class="dk_twocolumns">
            <div class="column">
                <fieldset>
                    <legend>Callout Left</legend>
                    <label for="homepage[callout-left-heading]">Heading</label>
        			<input type="text" name="homepage[callout-left-heading]" id="homepage[callout-left-heading]" class="regular-text" value="<?php if ( isset ( $meta['callout-left-heading'] ) ) echo $meta['callout-left-heading']; ?>">
                    <label for="homepage[callout-left-image]">Image Upload</label>
        			<input type="text" name="homepage[callout-left-image]" id="homepage[callout-left-image]" class="meta-image regular-text" value="<?php if ( isset ( $meta['callout-left-image'] ) ) echo $meta['callout-left-image']; ?>">
        			<input type="button" class="button image-upload" value="Browse">
                    <?php if ( isset ( $meta['callout-left-image'] ) ) { ?>
            		<div class="image-preview"><img src="<?php echo $meta['callout-left-image']; ?>"></div>
            		<?php } ?>
                    <label for="homepage[callout-left-imagealt]">Image Alt Tag</label><small>Provide a brief description of the image. This is important for accesibility and SEO purposes.</small>
        			<input type="text" name="homepage[callout-left-imagealt]" id="homepage[callout-left-imagealt]" class="regular-text" value="<?php if ( isset ( $meta['callout-left-imagealt'] ) ) echo $meta['callout-left-imagealt']; ?>">
                    <label for="homepage[callout-left-subheading]">Subheading</label>
        			<input type="text" name="homepage[callout-left-subheading]" id="homepage[callout-left-subheading]" class="regular-text" value="<?php if ( isset ( $meta['callout-left-subheading'] ) ) echo $meta['callout-left-subheading']; ?>">
                    <label for="homepage[callout-left-paragraph]">Paragraph</label>
        			<textarea name="homepage[callout-left-paragraph]" id="homepage[callout-left-paragraph]" rows="5" cols="30"><?php if ( isset ( $meta['callout-left-paragraph'] ) ) echo $meta['callout-left-paragraph']; ?></textarea>
                    <label for="homepage[callout-left-btntext]">Button Text</label>
        			<input type="text" name="homepage[callout-left-btntext]" id="homepage[callout-left-btntext]" class="regular-text" value="<?php if ( isset ( $meta['callout-left-btntext'] ) ) echo $meta['callout-left-btntext']; ?>">
                    <label for="homepage[callout-left-btnlink]">Button Link</label>
        			<input type="text" name="homepage[callout-left-btnlink]" id="homepage[callout-left-btnlink]" class="regular-text" value="<?php if ( isset ( $meta['callout-left-btnlink'] ) ) echo $meta['callout-left-btnlink']; ?>">
                </fieldset>
            </div><!--
            --><div class="column">
                <fieldset>
                    <legend>Callout Right</legend>
                    <label for="homepage[callout-right-heading]">Heading</label>
                    <input type="text" name="homepage[callout-right-heading]" id="homepage[callout-right-heading]" class="regular-text" value="<?php if ( isset ( $meta['callout-right-heading'] ) ) echo $meta['callout-right-heading']; ?>">
                    <label for="homepage[callout-right-image]">Image Upload</label>
                    <input type="text" name="homepage[callout-right-image]" id="homepage[callout-right-image]" class="meta-image regular-text" value="<?php if ( isset ( $meta['callout-right-image'] ) ) echo $meta['callout-right-image']; ?>">
                    <input type="button" class="button image-upload" value="Browse">
                    <?php if ( isset ( $meta['callout-right-image'] ) ) { ?>
            		<div class="image-preview"><img src="<?php echo $meta['callout-right-image']; ?>"></div>
            		<?php } ?>
                    <label for="homepage[callout-right-imagealt]">Image Alt Tag</label><small>Provide a brief description of the image. This is important for accesibility and SEO purposes.</small>
                    <input type="text" name="homepage[callout-right-imagealt]" id="homepage[callout-right-imagealt]" class="regular-text" value="<?php if ( isset ( $meta['callout-right-imagealt'] ) ) echo $meta['callout-right-imagealt']; ?>">
                    <label for="homepage[callout-right-subheading]">Subheading</label>
                    <input type="text" name="homepage[callout-right-subheading]" id="homepage[callout-right-subheading]" class="regular-text" value="<?php if ( isset ( $meta['callout-right-subheading'] ) ) echo $meta['callout-right-subheading']; ?>">
                    <label for="homepage[callout-right-paragraph]">Paragraph</label>
                    <textarea name="homepage[callout-right-paragraph]" id="homepage[callout-right-paragraph]" rows="5" cols="30"><?php if ( isset ( $meta['callout-right-paragraph'] ) ) echo $meta['callout-right-paragraph']; ?></textarea>
                    <label for="homepage[callout-right-btntext]">Button Text</label>
                    <input type="text" name="homepage[callout-right-btntext]" id="homepage[callout-right-btntext]" class="regular-text" value="<?php if ( isset ( $meta['callout-right-btntext'] ) ) echo $meta['callout-right-btntext']; ?>">
                    <label for="homepage[callout-right-btnlink]">Button Link</label>
                    <input type="text" name="homepage[callout-right-btnlink]" id="homepage[callout-right-btnlink]" class="regular-text" value="<?php if ( isset ( $meta['callout-right-btnlink'] ) ) echo $meta['callout-right-btnlink']; ?>">
                </fieldset>
            </div>
        </div>
        <fieldset>
            <legend>Banner Ad 1</legend>
            <label for="homepage[banner-ad-one]">Image Upload</label>
            <input type="text" name="homepage[banner-ad-one]" id="homepage[banner-ad-one]" class="meta-image regular-text" value="<?php if ( isset ( $meta['banner-ad-one'] ) ) echo $meta['banner-ad-one']; ?>">
            <input type="button" class="button image-upload" value="Browse">
            <?php if ( isset ( $meta['banner-ad-one'] ) ) { ?>
            <div class="image-preview"><img src="<?php echo $meta['banner-ad-one']; ?>"></div>
            <?php } ?>
            <label for="homepage[banner-ad-onealt]">Image Alt Tag</label><small>Provide a brief description of the image. This is important for accesibility and SEO purposes.</small>
            <input type="text" name="homepage[banner-ad-onealt]" id="homepage[banner-ad-onealt]" class="regular-text" value="<?php if ( isset ( $meta['banner-ad-onealt'] ) ) echo $meta['banner-ad-onealt']; ?>">
            <label for="homepage[banner-ad-one-link]">Advertisement Link</label>
            <input type="text" name="homepage[banner-ad-one-link]" id="homepage[banner-ad-one-link]" class="regular-text" value="<?php if ( isset ( $meta['banner-ad-one-link'] ) ) echo $meta['banner-ad-one-link']; ?>">
        </fieldset>
        <!-- Testimonial -->
        <strong>Testimonial</strong>
        <label for="homepage[testimonial-heading]">Testimonial Heading</label>
        <input type="text" name="homepage[testimonial-heading]" id="homepage[testimonial-heading]" class="regular-text" value="<?php if ( isset ( $meta['testimonial-heading'] ) ) echo $meta['testimonial-heading']; ?>">
        <label for="homepage[testimonial-quote]">Testimonial Quote (Don't add quotation marks)</label>
        <textarea name="homepage[testimonial-quote]" id="homepage[testimonial-quote]" rows="5" cols="30"><?php if ( isset ( $meta['testimonial-quote'] ) ) echo $meta['testimonial-quote']; ?></textarea>
        <label for="homepage[testimonial-name]">Name of Reviewer</label>
        <input type="text" name="homepage[testimonial-name]" id="homepage[testimonial-name]" class="regular-text" value="<?php if ( isset ( $meta['testimonial-name'] ) ) echo $meta['testimonial-name']; ?>">
        <fieldset>
            <legend>Banner Ad 2</legend>
            <label for="homepage[banner-ad-two]">Image Upload</label>
            <input type="text" name="homepage[banner-ad-two]" id="homepage[banner-ad-two]" class="meta-image regular-text" value="<?php if ( isset ( $meta['banner-ad-two'] ) ) echo $meta['banner-ad-two']; ?>">
            <input type="button" class="button image-upload" value="Browse">
            <?php if ( isset ( $meta['banner-ad-two'] ) ) { ?>
            <div class="image-preview"><img src="<?php echo $meta['banner-ad-two']; ?>"></div>
            <?php } ?>
            <label for="homepage[banner-ad-twoalt]">Image Alt Tag</label><small>Provide a brief description of the image. This is important for accesibility and SEO purposes.</small>
            <input type="text" name="homepage[banner-ad-twoalt]" id="homepage[banner-ad-twoalt]" class="regular-text" value="<?php if ( isset ( $meta['banner-ad-twoalt'] ) ) echo $meta['banner-ad-twoalt']; ?>">
            <label for="homepage[banner-ad-two-link]">Advertisement Link</label>
            <input type="text" name="homepage[banner-ad-two-link]" id="homepage[banner-ad-two-link]" class="regular-text" value="<?php if ( isset ( $meta['banner-ad-two-link'] ) ) echo $meta['banner-ad-two-link']; ?>">


            <label for="homepage[super-cool-option]">Super Cool Option</label>
            <input type="text" name="homepage[super-cool-option]" id="homepage[super-cool-option]" class="regular-text" value="<?php if ( isset ( $meta['super-cool-option'] ) ) echo $meta['super-cool-option']; ?>">
        </fieldset>
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

function save_homepage_meta( $post_id ) {
	// verify nonce
	if ( !wp_verify_nonce( $_POST['homepage_meta_box_nonce'], basename(__FILE__) ) ) {
		return $post_id;
	}
	// check autosave
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return $post_id;
	}
	// check permissions
	if ( 'page' === $_POST['homepage'] ) {
		if ( !current_user_can( 'edit_page', $post_id ) ) {
			return $post_id;
		} elseif ( !current_user_can( 'edit_post', $post_id ) ) {
			return $post_id;
		}
	}

	$old = get_post_meta( $post_id, 'homepage', true );
	$new = $_POST['homepage'];

	if ( $new && $new !== $old ) {
		update_post_meta( $post_id, 'homepage', $new );
	} elseif ( '' === $new && $old ) {
		delete_post_meta( $post_id, 'homepage', $old );
	}
}
add_action( 'save_post', 'save_homepage_meta' );
