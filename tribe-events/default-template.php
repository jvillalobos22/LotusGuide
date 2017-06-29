<?php
/**
 * Default Events Template
 * This file is the basic wrapper template for all the views if 'Default Events Template'
 * is selected in Events -> Settings -> Template -> Events Template.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/default-template.php
 *
 * @package TribeEventsCalendar
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$url      = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$url_path = parse_url( $url, PHP_URL_PATH );
$slug = pathinfo( $url_path, PATHINFO_BASENAME );

get_header();
?>

<div id="content" class="dk_secondarypage">

	<div id="inner-content" class="row">

		<main id="main" class="large-9 medium-8 small-12 columns" role="main">

			<div id="tribe-events-pg-template" class="dk_maincontent tribe-events-pg-template">
				<h1 class="page-title">Calendar of <span>Events</span></h1>
				<?php if( is_user_logged_in() ) {// logged in ?>
					<a class="dk_btn dk_loginbtn" href="<?php echo wp_logout_url( $url ); ?>">Logout</a>
				<?php } else {// not logged in ?>
					<?php if($slug != 'add' && $slug != 'list') { ?>
					<a class="dk_btn dk_loginbtn" href="<?php echo wp_login_url( $url ); ?>">Login / Register</a>
					<?php } ?>
				<?php } ?>
				<?php if($slug == 'events') { ?>
					<p style="margin-top: 1rem;">Our Calendar of Events covers the North Valley area of California, Chico, Paradise, Mt Shasta, Grass Valley, Nevada City, Redding, Red Bluff, etc. This Calendar is for events and services like health fairs, psychic fairs, massage training’s, music events, meditation classes and workshops, etc.</p>
					<?php if(!is_user_logged_in()) {// not logged in ?>
						<p>If you would like to add events to our calendar, please sign in or register for an account <a href="<?php echo wp_login_url( $url ); ?>">here</a> or by using the login button above. An account will allow you to create events and make edits to any events that you have created.</p>
					<?php } else {// logged in ?>
					<a class="dk_btn" href="community/add">Add Event</a>
					<a class="dk_btn" href="community/list">My Events</a>
					<?php } ?>
				<?php } ?>
				<hr>
				<?php tribe_events_before_html(); ?>
				<?php tribe_get_view(); ?>
				<?php tribe_events_after_html(); ?>
			</div> <!-- #tribe-events-pg-template -->

		</main>
		<aside class="large-3 medium-4 small-12 columns">
			<?php get_sidebar(); ?>
		</aside>
	</div>
</div>
<?php
	get_footer();
?>
