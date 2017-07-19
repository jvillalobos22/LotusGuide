<?php
/*
 * sidebar-settings.php
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

// Add custom DK admin options area
function dk_add_sidebar_page() {

	// Generate DK Options Page
	add_menu_page( 'Sidebar Options', 'Sidebar Options', 'manage_options', 'dk_sidebar_options', 'dk_sidebar_create_page', 'dashicons-admin-generic' , 5 );

	//Activate custom settings
	add_action( 'admin_init', 'dk_custom_sidebar_settings');

}
add_action( 'admin_menu', 'dk_add_sidebar_page');

function dk_custom_sidebar_settings() {
	// Register Settings
	register_setting( 'dk-sidebar-settings-group', 'recent_issue_embed');
	// register_setting( 'dk-sidebar-settings-group', 'recent_issue_link');
	register_setting( 'dk-sidebar-settings-group', 'about_text');
    register_setting( 'dk-sidebar-settings-group', 'about_link_url');
	register_setting( 'dk-sidebar-settings-group', 'advertise_text');
	register_setting( 'dk-sidebar-settings-group', 'advertise_link_url');
	register_setting( 'dk-sidebar-settings-group', 'newsletter_text');
	register_setting( 'dk-sidebar-settings-group', 'newsletter_link_text');
	register_setting( 'dk-sidebar-settings-group', 'newsletter_link_url');
	register_setting( 'dk-sidebar-settings-group', 'testimonial_text');
    register_setting( 'dk-sidebar-settings-group', 'testimonial_link');

	register_setting( 'dk-sidebar-settings-group', 'default_sidebar_recent_issue');
	register_setting( 'dk-sidebar-settings-group', 'default_sidebar_newsletter');
	register_setting( 'dk-sidebar-settings-group', 'default_sidebar_socialize');
	register_setting( 'dk-sidebar-settings-group', 'default_sidebar_upcoming_events');
	register_setting( 'dk-sidebar-settings-group', 'default_sidebar_about');
	register_setting( 'dk-sidebar-settings-group', 'default_sidebar_advertise');
	register_setting( 'dk-sidebar-settings-group', 'default_sidebar_testimonials');

	register_setting( 'dk-sidebar-settings-group', 'default_sidebar_featured_biz');
	register_setting( 'dk-sidebar-settings-group', 'default_sidebar_featured_biz_image');
	register_setting( 'dk-sidebar-settings-group', 'default_sidebar_featured_biz_name');
	register_setting( 'dk-sidebar-settings-group', 'default_sidebar_featured_biz_link');
	register_setting( 'dk-sidebar-settings-group', 'featured_business_slug');

	// Register Settings Section
	add_settings_section( 'dk-sidebar-options', 'Edit Widget Content', 'dk_sidebar_settings', 'dk_sidebar_options');
	add_settings_section( 'dk-default-sidebar-options', 'Edit Default Sidebar', 'dk_default_sidebar_settings', 'dk_sidebar_options');
	add_settings_section( 'dk-featured-event-options', 'Featured Event', 'dk_featured_event_options', 'dk_sidebar_options');

	// Register Settings Fields
    add_settings_field( 'recent_issue_embed', 'Recent Issue Embed', 'dk_recent_issue_embed', 'dk_sidebar_options', 'dk-sidebar-options' );
	// add_settings_field( 'recent-issue-link', 'Recent Issue Link URL', 'dk_recent_issue_link', 'dk_sidebar_options', 'dk-sidebar-options' );
	add_settings_field( 'about-text', 'About Text', 'dk_about_text', 'dk_sidebar_options', 'dk-sidebar-options' );
	add_settings_field( 'about-link-url', 'About Link URL', 'dk_about_link_url', 'dk_sidebar_options', 'dk-sidebar-options' );
	add_settings_field( 'advertise-text', 'Advertise Text', 'dk_advertise_text', 'dk_sidebar_options', 'dk-sidebar-options' );
	add_settings_field( 'advertise-link-url', 'Advertise Link URL', 'dk_advertise_link_url', 'dk_sidebar_options', 'dk-sidebar-options' );
	add_settings_field( 'newsletter-text', 'Newsletter Text', 'dk_newsletter_text', 'dk_sidebar_options', 'dk-sidebar-options' );
	add_settings_field( 'newsletter-link-text', 'Newsletter Link Text', 'dk_newsletter_link_text', 'dk_sidebar_options', 'dk-sidebar-options' );
	add_settings_field( 'newsletter-link-url', 'Newsletter Link URL', 'dk_newsletter_link_url', 'dk_sidebar_options', 'dk-sidebar-options' );
	add_settings_field( 'testimonial-text', 'Testimonial Text', 'dk_testimonial_text', 'dk_sidebar_options', 'dk-sidebar-options' );
	add_settings_field( 'testimonial-link', 'Testimonial Link URL', 'dk_testimonial_link', 'dk_sidebar_options', 'dk-sidebar-options' );

	add_settings_field( 'default-sidebar-featured-biz', 'Default Sidebar Featured Business', 'dk_default_sidebar_featured_biz', 'dk_sidebar_options', 'dk-default-sidebar-options' );
	add_settings_field( 'default-sidebar-recent-issue', 'Default Sidebar Widgets', 'dk_default_sidebar', 'dk_sidebar_options', 'dk-default-sidebar-options' );
	add_settings_field( 'featured-event-slug', 'Featured Event Slug', 'dk_featured_slug', 'dk_sidebar_options', 'dk-featured-event-options' );

}

function dk_sidebar_settings() {
	echo '<p style="max-width: 800px">A few options used to updated/edit content in the sidebar widgets.</p>';
}

function dk_default_sidebar_settings() {
	echo '<p style="max-width: 800px">You can set which widgets will show up on any default pages that cannot be set individually such as search results pages and event pages</p>';
}

function dk_featured_event_options() {
	echo '<p style="max-width: 800px">The featured business slug can be found by navigating to the page of the event you wish to feature. From the single event page, look at the url and the last part of the url will be the slug. For example, if the event url was <code>http://lotusguide.com/event/cool-june-event/</code> then the slug would be <code>cool-june-event</code></p>';
}

function dk_recent_issue_embed() {
	$recentIssueEmbed = esc_attr( get_option( 'recent_issue_embed' ) );
    echo '<textarea rows="4" name="recent_issue_embed" placeholder="Recent Issue Embed">'.$recentIssueEmbed.'</textarea>';
}

// function dk_recent_issue_link() {
// 	$recentIssue = esc_attr( get_option( 'recent_issue_link' ) );
// 	echo '<input type="text" name="recent_issue_link" value="'.$recentIssue.'" placeholder="Recent Issue Link">';
// }

function dk_about_text() {
	$aboutText = esc_attr( get_option( 'about_text' ) );
	echo '<textarea type="text" name="about_text" rows="4" placeholder="About Widget Text">'.$aboutText.'</textarea>';
}

function dk_about_link_url() {
	$aboutLink = esc_attr( get_option( 'about_link_url' ) );
	echo '<input type="text" name="about_link_url" value="'.$aboutLink.'" placeholder="About Link URL">';
}

function dk_advertise_text() {
	$advertiseText = esc_attr( get_option( 'advertise_text' ) );
	echo '<textarea type="text" name="advertise_text" rows="4" placeholder="Advertise Widget Text">'.$advertiseText.'</textarea>';
}

function dk_advertise_link_url() {
	$advertiseLink = esc_attr( get_option( 'advertise_link_url' ) );
	echo '<input type="text" name="advertise_link_url" value="'.$advertiseLink.'" placeholder="Advertise Link URL">';
}

function dk_newsletter_text() {
	$newsletterText = esc_attr( get_option( 'newsletter_text' ) );
	echo '<textarea type="text" name="newsletter_text" rows="4" placeholder="Newsletter Text">'.$newsletterText.'</textarea>';
}

function dk_newsletter_link_text() {
	$newsletterLinkText = esc_attr( get_option( 'newsletter_link_text' ) );
	echo '<input type="text" name="newsletter_link_text" value="'.$newsletterLinkText.'" placeholder="Newsletter Link Text">';
}

function dk_newsletter_link_url() {
	$newsletterLinkURL = esc_attr( get_option( 'newsletter_link_url' ) );
	echo '<input type="text" name="newsletter_link_url" value="'.$newsletterLinkURL.'" placeholder="Newsletter Link URL">';
}

function dk_testimonial_text() {
	$testimonialText = esc_attr( get_option( 'testimonial_text' ) );
	echo '<textarea type="text" name="testimonial_text" rows="4" placeholder="Testimonial Text (No Quotations)">'.$testimonialText.'</textarea>';
}

function dk_testimonial_link() {
	$testimonialLink = esc_attr( get_option( 'testimonial_link' ) );
	echo '<input type="text" name="testimonial_link" value="'.$testimonialLink.'" placeholder="Testimonial Link URL">';
}

function dk_default_sidebar_featured_biz() {
	echo '<div class="dk_checkboxes">';
	// Recent Issue Checkbox
	echo '<label>';
	$checkbox_value = esc_attr( get_option( 'default_sidebar_featured_biz' ) );
	if($checkbox_value == "") {
		echo '<input name="default_sidebar_featured_biz" type="checkbox" value="true">';
	} else if($checkbox_value == "true") {
		echo '<input name="default_sidebar_featured_biz" type="checkbox" value="true" checked>';
	}
	echo 'Use Featured Business Widget?</label>';

	$defaultFeaturedBizImage = esc_attr( get_option( 'default_sidebar_featured_biz_image' ) );
    echo '<input type="text" name="default_sidebar_featured_biz_image" value="'.$defaultFeaturedBizImage.'" placeholder="Featured Business Image URL">';

	$defaultFeaturedBizName = esc_attr( get_option( 'default_sidebar_featured_biz_name' ) );
	echo '<input type="text" name="default_sidebar_featured_biz_name" value="'.$defaultFeaturedBizName.'" placeholder="Featured Business Name">';

	$defaultFeaturedBizLink = esc_attr( get_option( 'default_sidebar_featured_biz_link' ) );
	echo '<input type="text" name="default_sidebar_featured_biz_link" value="'.$defaultFeaturedBizLink.'" placeholder="Featured Business Link URL">';
}

function dk_default_sidebar() {
	echo '<div class="dk_checkboxes">';
	// Recent Issue Checkbox
	echo '<label>';
	$checkbox_value = esc_attr( get_option( 'default_sidebar_recent_issue' ) );
	if($checkbox_value == "") {
		echo '<input name="default_sidebar_recent_issue" type="checkbox" value="true">';
	} else if($checkbox_value == "true") {
		echo '<input name="default_sidebar_recent_issue" type="checkbox" value="true" checked>';
	}
	echo 'Recent Issue</label>';

	//Newsletter Sign Up Checkbox
	echo '<label>';
	$checkbox_value = esc_attr( get_option( 'default_sidebar_newsletter' ) );
	if($checkbox_value == "") {
		echo '<input name="default_sidebar_newsletter" type="checkbox" value="true">';
	} else if($checkbox_value == "true") {
		echo '<input name="default_sidebar_newsletter" type="checkbox" value="true" checked>';
	}
	echo 'Newsletter Sign Up</label>';

	// Socialize Checkbox -->
	echo '<label>';

	$checkbox_value = esc_attr( get_option( 'default_sidebar_socialize' ) );
	if($checkbox_value == "") {
		echo '<input name="default_sidebar_socialize" type="checkbox" value="true">';
	} else if($checkbox_value == "true") {
		echo '<input name="default_sidebar_socialize" type="checkbox" value="true" checked>';
	}
	echo 'Socialize</label>';

	// Events Checkbox -->
	echo '<label>';
	$checkbox_value = esc_attr( get_option( 'default_sidebar_upcoming_events' ) );
	if($checkbox_value == "") {
		echo '<input name="default_sidebar_upcoming_events" type="checkbox" value="true">';
	} else if($checkbox_value == "true") {
		echo '<input name="default_sidebar_upcoming_events" type="checkbox" value="true" checked>';
	}
	echo 'Upcoming Events</label>';

	// About the Lotus Guide Checkbox -->
	echo '<label>';
	$checkbox_value = esc_attr( get_option( 'default_sidebar_about' ) );
	if($checkbox_value == "") {
		echo '<input name="default_sidebar_about" type="checkbox" value="true">';
	} else if($checkbox_value == "true") {
		echo '<input name="default_sidebar_about" type="checkbox" value="true" checked>';
	}
	echo 'About the Lotus Guide</label>';

	// Advertise With Us Checkbox -->
	echo '<label>';
	$checkbox_value = esc_attr( get_option( 'default_sidebar_advertise' ) );
	if($checkbox_value == "") {
		echo '<input name="default_sidebar_advertise" type="checkbox" value="true">';
	} else if($checkbox_value == "true") {
		echo '<input name="default_sidebar_advertise" type="checkbox" value="true" checked>';
	}
	echo 'Advertise With Us</label>';

	// Testimonials Checkbox -->
	echo '<label>';
	$checkbox_value = esc_attr( get_option( 'default_sidebar_testimonials' ) );
	if($checkbox_value == "") {
		echo '<input name="default_sidebar_testimonials" type="checkbox" value="true">';
	} else if($checkbox_value == "true") {
		echo '<input name="default_sidebar_testimonials" type="checkbox" value="true" checked>';
	}
	echo 'Testimonials</label>';

}

function dk_featured_slug() {
	$featuredEventSlug = esc_attr( get_option( 'featured_business_slug' ) );
	echo '<input type="text" name="featured_business_slug" value="'.$featuredEventSlug.'" placeholder="ex: super-cool-event">';
}

function dk_sidebar_create_page() {
	//generation of our admin page
	require_once( get_template_directory() . '/assets/templates/sidebar-settings-template.php' );
}
