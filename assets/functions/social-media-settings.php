<?php
/*
 * social-media-settings.php
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

// Add custom DK admin options area for social media
function dk_add_social_page() {

	// Generate Social Media Options Page
	add_menu_page( 'Social Media', 'Social Media', 'manage_options', 'dk_social_options', 'dk_social_create_page', 'dashicons-share' , 6 );

	//Activate custom settings
	add_action( 'admin_init', 'dk_custom_social_settings');

}
add_action( 'admin_menu', 'dk_add_social_page');

function dk_custom_social_settings() {
	// Register Settings
    register_setting( 'dk-social-settings-group', 'facebook_link');
	register_setting( 'dk-social-settings-group', 'youtube_link');
	register_setting( 'dk-social-settings-group', 'twitter_link');
    register_setting( 'dk-social-settings-group', 'google_plus_link');
	register_setting( 'dk-social-settings-group', 'yelp_link');

	// Register Settings Section
	add_settings_section( 'dk-social-options', 'Edit Social Media Account Links', 'dk_social_settings', 'dk_social_options');

	// Register Settings Fields
    add_settings_field( 'facebook-link', 'Facebook Link', 'dk_facebook', 'dk_social_options', 'dk-social-options' );
	add_settings_field( 'youtube-link', 'YouTube Link', 'dk_youtube', 'dk_social_options', 'dk-social-options' );
	add_settings_field( 'twitter-link', 'Twitter Link', 'dk_twitter', 'dk_social_options', 'dk-social-options' );
	add_settings_field( 'google-plus-link', 'Google Plus Link', 'dk_googleplus', 'dk_social_options', 'dk-social-options' );
	add_settings_field( 'yelp-link', 'Yelp Link', 'dk_yelp', 'dk_social_options', 'dk-social-options' );
}

function dk_social_settings() {
	echo 'Use this page to update the links to your social media. These will be reflected everywhere on the site that links to your social media pages.';
}

function dk_facebook() {
	$facebookLink = esc_attr( get_option( 'facebook_link' ) );
    echo '<input type="text" name="facebook_link" value="'.$facebookLink.'" placeholder="https://www.facebook.com/dkdesignsca/">';
}

function dk_youtube() {
	$youtubeLink = esc_attr( get_option( 'youtube_link' ) );
	echo '<input type="text" name="youtube_link" value="'.$youtubeLink.'" placeholder="https://www.youtube.com/channel/YourPage">';
}

function dk_twitter() {
	$twitterLink = esc_attr( get_option( 'twitter_link' ) );
	echo '<input type="text" name="twitter_link" value="'.$twitterLink.'" placeholder="https://twitter.com/YourPage">';
}

function dk_googleplus() {
	$googleLink = esc_attr( get_option( 'google_plus_link' ) );
	echo '<input type="text" name="google_plus_link" value="'.$googleLink.'" placeholder="https://plus.google.com/+Dkdesignsca">';
}

function dk_yelp() {
	$yelpLink = esc_attr( get_option( 'yelp_link' ) );
	echo '<input type="text" name="yelp_link" value="'.$yelpLink.'" placeholder="https://www.yelp.com/biz/dk-web-design-chico-2">';
}

function dk_social_create_page() {
	//generation of our admin page
	require_once( get_template_directory() . '/assets/templates/social-media-settings-template.php' );
}
