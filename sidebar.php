<?php
$post_type = get_post_type();
global $template;
$pageTemplate = basename($template);
echo '<code>$pageTemplate = '.$pageTemplate.'</code>';
if($pageTemplate = 'search.php') {
	// get default sidebar
} else {
	//if business_listing
	if($post_type == 'business_listing') {
		$obj = get_queried_object();
		$listingCatAry = get_term_meta( $obj->term_id, 'listingFields' );
		$sidebarMeta = $listingCatAry[0];
	} else { //if post, page
		if($pageTemplate == 'template-blog.php') {
			$sidebarMeta = get_post_meta( 187, 'sidebar', true );
		} elseif ($pageTemplate == 'template-pickup-locations-index.php') {
			$sidebarMeta = get_post_meta( 681, 'sidebar', true );
		} else {
			$sidebarMeta = get_post_meta( $post->ID, 'sidebar', true );
		}
	}
}


$featuredBusinessWidget = $sidebarMeta['featured-business-checkbox'];
$featuredBusinessImage = $sidebarMeta['featured-business-image'];
$featuredBusinessName = $sidebarMeta['featured-business-name'];
$featuredBusinessLink = $sidebarMeta['featured-business-link'];

$recentIssue = $sidebarMeta['recent-issue-widget'];
$aboutWidget = $sidebarMeta['about-widget'];
$advertiseWidget = $sidebarMeta['advertise-widget'];
$testimonialsWidget = $sidebarMeta['testimonials-widget'];
$newsletter = $sidebarMeta['newsletter-widget'];
$socializeWidget = $sidebarMeta['socialize-widget'];
$upcomingEvents = $sidebarMeta['events-widget'];

?>
<div class="dk_sidebar">
	<!-- Search Bar Module -->
	<form role="search" method="get" class="search-form dk_searchbar" action="<?php echo home_url( '/' ); ?>">
		<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search Here', 'jointswp' ) ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'jointswp' ) ?>" />
		<input type="submit" class="search-submit button dk_searchsubmit" value="<?php echo esc_attr_x( '...', 'jointswp' ) ?>" />
		<i class="fa fa-search" aria-hidden="true"></i>
	</form>
	<!-- Featured Business Module -->
	<?php if($featuredBusinessWidget) { ?>
	<h3 class="dk_heading">Featured Business</h3>
	<a class="dk_adlink_container" href="<?php echo $featuredBusinessLink; ?>">
		<img src="<?php echo $featuredBusinessImage; ?>" alt="<?php echo $featuredBusinessName; ?>">
		<h4><?php echo $featuredBusinessName; ?></h4>
	</a>
	<?php } ?>
	<!-- Recent Issue Module -->
	<?php if($recentIssue) { ?>
	<h3 class="dk_heading">Recent Issue</h3>
	<a href="<?php echo get_option('recent_issue_link') ?>">
		<?php if(get_option('recent_issue_img')) { ?>
			<img src="<?php echo get_option('recent_issue_img'); ?>" alt="Recent Issue of the Lotus Guide">
		<?php } else { ?>
			<img src="<?php echo get_template_directory_uri(); ?>/assets/images/homepage-flipbook-placeholder.jpg" alt="Recent Issue of the Lotus Guide">
		<?php } ?>
	</a>
	<?php } ?>
	<!-- About Module -->
	<?php if($aboutWidget) { ?>
	<h3 class="dk_heading">About the Lotus Guide</h3>
	<p><?php echo get_option('about_text') ?></p>
	<a class="dk_btn" href="<?php echo get_option('about_link_url') ?>">Learn More</a>
	<?php } ?>
	<!-- Advertise With Us Module -->
	<?php if($advertiseWidget) { ?>
	<h3 class="dk_heading">Advertise With Us</h3>
	<p><?php echo get_option('advertise_text') ?></p>
	<a class="dk_btn" href="<?php echo get_option('advertise_link_url') ?>">Get the Details</a>
	<?php } ?>
	<!-- Testimonial Module -->
	<?php if($testimonialsWidget) { ?>
	<h3 class="dk_heading">Testimonials From Our Users</h3>
	<p>&ldquo;<?php echo get_option('testimonial_text') ?>&rdquo;</p>
	<a class="dk_btn" href="<?php echo get_option('testimonial_link'); ?>">Our Testimonials</a>
	<?php } ?>
	<!-- Newsletter Module -->
	<?php if($newsletter) { ?>
	<h3 class="dk_heading">Newsletter</h3>
	<p><?php echo get_option('newsletter_text') ?> <a href="<?php echo get_option('newsletter_link_url') ?>"><?php echo get_option('newsletter_link_text') ?></a></p>
	<?php } ?>
	<!-- Social Media Module -->
	<?php if($socializeWidget) { ?>
	<h3 class="dk_heading">Socialize</h3>
	<div class="row small-up-4 medium-up-2 large-up-4 dk_sidebarsocial">
		<div class="column column-block">
			<a href="<?php echo get_option('facebook_link') ?>" target="_blank">
				<img src="<?php echo get_template_directory_uri(); ?>/assets/images/facebook-icon.png" alt="Facebook Icon">
			</a>
		</div>
		<div class="column column-block">
			<a href="<?php echo get_option('twitter_link') ?>" target="_blank">
				<img src="<?php echo get_template_directory_uri(); ?>/assets/images/twitter-icon.png" alt="Twitter Icon">
			</a>
		</div>
		<div class="column column-block">
			<a href="<?php echo get_option('google_plus_link') ?>" target="_blank">
				<img src="<?php echo get_template_directory_uri(); ?>/assets/images/google-plus-icon.png" alt="Google Plus Icon">
			</a>
		</div>
		<div class="column column-block">
			<a href="<?php echo get_option('yelp_link') ?>" target="_blank">
				<img src="<?php echo get_template_directory_uri(); ?>/assets/images/yelp-icon.png" alt="Yelp Icon">
			</a>
		</div>
	</div>

	<?php } ?>
	<!-- Upcoming Events Module -->
	<?php if($upcomingEvents) { ?>
	<h3 class="dk_heading">Upcoming Events</h3>
	<p><strong>February 14, 2017</strong><br>Valentine's Dinner at The Elk's Lodge</p>
	<p><strong>February 14, 2017</strong><br>Valentine's Dinner at The Elk's Lodge</p>
	<a class="dk_btn" href="#">View the Calendar</a>
	<?php } ?>

</div>
