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
	add_menu_page( 'Sidebar Options', 'Sidebar Options', 'manage_options', 'dk_sidebar_options', 'dk_sidebar_create_page', 'dashicons-admin-generic' , 110 );

	//Activate custom settings
	add_action( 'admin_init', 'dk_custom_sidebar_settings');

}
add_action( 'admin_menu', 'dk_add_sidebar_page');

function dk_custom_sidebar_settings() {
	// Register Settings
    register_setting( 'dk-sidebar-settings-group', 'recent_issue_img');
	register_setting( 'dk-sidebar-settings-group', 'recent_issue_link');
	register_setting( 'dk-sidebar-settings-group', 'about_text');
    register_setting( 'dk-sidebar-settings-group', 'about_link_url');
	register_setting( 'dk-sidebar-settings-group', 'advertise_text');
	register_setting( 'dk-sidebar-settings-group', 'advertise_link_url');
	register_setting( 'dk-sidebar-settings-group', 'newsletter_text');
	register_setting( 'dk-sidebar-settings-group', 'newsletter_link_text');
	register_setting( 'dk-sidebar-settings-group', 'newsletter_link_url');
	register_setting( 'dk-sidebar-settings-group', 'testimonial_text');
    register_setting( 'dk-sidebar-settings-group', 'testimonial_link');

	// Register Settings Section
	add_settings_section( 'dk-sidebar-options', 'Edit Widget Content', 'dk_sidebar_settings', 'dk_sidebar_options');

	// Register Settings Fields
    add_settings_field( 'recent_issue_img', 'Recent Issue Image', 'dk_recent_issue_img', 'dk_sidebar_options', 'dk-sidebar-options' );
	add_settings_field( 'recent-issue-link', 'Recent Issue Link URL', 'dk_recent_issue_link', 'dk_sidebar_options', 'dk-sidebar-options' );
	add_settings_field( 'about-text', 'About Text', 'dk_about_text', 'dk_sidebar_options', 'dk-sidebar-options' );
	add_settings_field( 'about-link-url', 'About Link URL', 'dk_about_link_url', 'dk_sidebar_options', 'dk-sidebar-options' );
	add_settings_field( 'advertise-text', 'Advertise Text', 'dk_advertise_text', 'dk_sidebar_options', 'dk-sidebar-options' );
	add_settings_field( 'advertise-link-url', 'Advertise Link URL', 'dk_advertise_link_url', 'dk_sidebar_options', 'dk-sidebar-options' );
	add_settings_field( 'newsletter-text', 'Newsletter Text', 'dk_newsletter_text', 'dk_sidebar_options', 'dk-sidebar-options' );
	add_settings_field( 'newsletter-link-text', 'Newsletter Link Text', 'dk_newsletter_link_text', 'dk_sidebar_options', 'dk-sidebar-options' );
	add_settings_field( 'newsletter-link-url', 'Newsletter Link URL', 'dk_newsletter_link_url', 'dk_sidebar_options', 'dk-sidebar-options' );
	add_settings_field( 'testimonial-text', 'Testimonial Text', 'dk_testimonial_text', 'dk_sidebar_options', 'dk-sidebar-options' );
	add_settings_field( 'testimonial-link', 'Testimonial Link URL', 'dk_testimonial_link', 'dk_sidebar_options', 'dk-sidebar-options' );
}

function dk_sidebar_settings() {
	echo 'A few options used to updated/edit content in the sidebar widgets.';
}

function dk_recent_issue_img() {
	$recentIssueImg = esc_attr( get_option( 'recent_issue_img' ) );
    echo '<input type="text" name="recent_issue_img" value="'.$recentIssueImg.'" placeholder="Recent Issue Image URL">';
}

function dk_recent_issue_link() {
	$recentIssue = esc_attr( get_option( 'recent_issue_link' ) );
	echo '<input type="text" name="recent_issue_link" value="'.$recentIssue.'" placeholder="Recent Issue Link">';
}

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

function dk_sidebar_create_page() {
	//generation of our admin page
	require_once( get_template_directory() . '/assets/templates/sidebar-settings-template.php' );
}
