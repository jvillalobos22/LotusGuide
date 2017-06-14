<?php
$post_type = get_post_type();
global $template;
global $post;

$url      = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$url_path = parse_url( $url, PHP_URL_PATH );
$slug = pathinfo( $url_path, PATHINFO_BASENAME );

$pageTemplate = basename($template);
// echo '<code>$pageTemplate = '.$pageTemplate.'</code>';
// echo '<code>$post_slug = '.$url_path.'</code>';
if($pageTemplate == 'search.php' || $pageTemplate == 'page.php' || $pageTemplate == 'default-template.php') {
	if(strpos($url_path, 'event') !== false) {
		// This is an events page
		// Place featured event
		$featuredEventWidget = TRUE;
		$featuredEventSlug = esc_attr( get_option( 'featured_business_slug' ) );
	} else { $featuredEventWidget = FALSE; }
	// get default sidebar
	$featuredBusinessWidget = esc_attr( get_option( 'default_sidebar_featured_biz' ) );
	$featuredBusinessImage = esc_attr( get_option( 'default_sidebar_featured_biz_image' ) );
	$featuredBusinessName = esc_attr( get_option( 'default_sidebar_featured_biz_name' ) );
	$featuredBusinessLink = esc_attr( get_option( 'default_sidebar_featured_biz_link' ) );

	$recentIssue = esc_attr( get_option( 'default_sidebar_recent_issue' ) );
	$aboutWidget = esc_attr( get_option( 'default_sidebar_about' ) );
	$advertiseWidget = esc_attr( get_option( 'default_sidebar_advertise' ) );
	$testimonialsWidget = esc_attr( get_option( 'default_sidebar_testimonials' ) );
	$newsletter = esc_attr( get_option( 'default_sidebar_newsletter' ) );
	$socializeWidget = esc_attr( get_option( 'default_sidebar_socialize' ) );
	$upcomingEvents = esc_attr( get_option( 'default_sidebar_upcoming_events' ) );
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
}

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
	<!-- Featured Event Module -->
	<?php if($featuredEventWidget) { ?>
		<h3 class="dk_heading">Featured Event</h3>
		<?php
		// $post_id = 799;
		if ( $post = get_page_by_path( $featuredEventSlug, OBJECT, 'tribe_events' ) ) {
	    	$post_id = $post->ID;
			$queried_post = get_post($post_id);
			// $postType = $queried_post->post_type;
			// echo '<code>'.$postType.'</code>';
			$title = $queried_post->post_title;
			$link = get_permalink( $post_id );
			$content = $queried_post->post_content;
			$showEvent = TRUE;
		} else {
	    	$id = 0;
			$showEvent = FALSE;
		}
		if($showEvent) { ?>
		<div class="dk_featured_event">
			<h5><strong><?php echo $title; ?></strong></h5>
			<!-- <h6><?php echo tribe_get_start_date( $queried_post ); ?></h6> -->
			<div class="dk_eventdate">
				<span class="month"><?php echo tribe_get_start_date( $queried_post, FALSE, 'M' ); ?></span>
				<span class="day"><?php echo tribe_get_start_date( $queried_post, FALSE, 'j' ); ?></span>
			</div>
			<span class="time"><?php echo tribe_get_start_time( $queried_post ); ?></span>
			<p><?php echo $content; ?></p>
			<a class="dk_btn" href="<?php echo $link; ?>">Learn More</a>
		</div>
		<?php }
	} ?>

	<!-- Recent Issue Module -->
	<?php if($recentIssue) { ?>
	<h3 class="dk_heading">Recent Issue</h3>
	<!-- <a href="<?php echo get_option('recent_issue_link') ?>">
		<?php if(get_option('recent_issue_img')) { ?>
			<img src="<?php echo get_option('recent_issue_img'); ?>" alt="Recent Issue of the Lotus Guide">
		<?php } else { ?>
			<img src="<?php echo get_template_directory_uri(); ?>/assets/images/homepage-flipbook-placeholder.jpg" alt="Recent Issue of the Lotus Guide">
		<?php } ?>
	</a> -->
	<div data-configid="3152707/47108743" style="width:100%; height:325px;" class="issuuembed"></div>
	<script type="text/javascript" src="//e.issuu.com/embed.js" async="true"></script>
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
	<!--<p><?php //echo get_option('newsletter_text') ?> <a href="<?php //echo get_option('newsletter_link_url') ?>"><?php //echo get_option('newsletter_link_text') ?></a></p>-->
	<!--Begin CTCT Sign-Up Form-->
	<!-- EFD 1.0.0 [Mon May 08 17:59:51 EDT 2017] -->
	<!--<link rel='stylesheet' type='text/css' href='https://static.ctctcdn.com/h/contacts-embedded-signup-assets/1.0.2/css/signup-form.css'>-->
	<div class="ctct-embed-signup">
	   <div>
	       <span id="success_message" style="display:none;">
	           <div style="text-align:center;">Thanks for signing up!</div>
	       </span>
	       <form data-id="embedded_signup:form" class="ctct-custom-form Form" name="embedded_signup" method="POST" action="https://visitor2.constantcontact.com/api/signup">
	           <p>Sign up to receive our newsletter right to your inbox!</p>
	           <!-- The following code must be included to ensure your sign-up form works properly. -->
	           <input data-id="ca:input" type="hidden" name="ca" value="557e5a8e-b497-4119-9499-2cb58d82f86d">
	           <input data-id="list:input" type="hidden" name="list" value="3">
	           <input data-id="source:input" type="hidden" name="source" value="EFD">
	           <input data-id="required:input" type="hidden" name="required" value="list,email,first_name">
	           <input data-id="url:input" type="hidden" name="url" value="">
	           <p data-id="Email Address:p" ><label data-id="Email Address:label" data-name="email" class="ctct-form-required">Email Address</label> <input data-id="Email Address:input" type="text" name="email" value="" maxlength="80"></p>
	           <p data-id="First Name:p" ><label data-id="First Name:label" data-name="first_name" class="ctct-form-required">First Name</label> <input data-id="First Name:input" type="text" name="first_name" value="" maxlength="50"></p>
	           <p data-id="City:p" ><label data-id="City:label" data-name="address_city">City</label> <input data-id="City:input" type="text" name="address_city" value="" maxlength="50"></p>
			   <div><small class="dk_newsletter_legal">By submitting this form, you are granting Lotus Guide permission to email you. You may unsubscribe via the link found at the bottom of every email.  (See our <a href="http://www.constantcontact.com/legal/privacy-statement" target="_blank">Email Privacy Policy</a> for details.)</small></div>
			   <button type="submit" class="dk_submit_btn" data-enabled="enabled">Sign Up</button>
	       </form>
	   </div>
	</div>
	<script type='text/javascript'>
	   var localizedErrMap = {};
	   localizedErrMap['required'] = 		'This field is required.';
	   localizedErrMap['ca'] = 			'An unexpected error occurred while attempting to send email.';
	   localizedErrMap['email'] = 			'Please enter your email address in name@email.com format.';
	   localizedErrMap['birthday'] = 		'Please enter birthday in MM/DD format.';
	   localizedErrMap['anniversary'] = 	'Please enter anniversary in MM/DD/YYYY format.';
	   localizedErrMap['custom_date'] = 	'Please enter this date in MM/DD/YYYY format.';
	   localizedErrMap['list'] = 			'Please select at least one email list.';
	   localizedErrMap['generic'] = 		'This field is invalid.';
	   localizedErrMap['shared'] = 		'Sorry, we could not complete your sign-up. Please contact us to resolve this.';
	   localizedErrMap['state_mismatch'] = 'Mismatched State/Province and Country.';
		localizedErrMap['state_province'] = 'Select a state/province';
	   localizedErrMap['selectcountry'] = 	'Select a country';
	   var postURL = 'https://visitor2.constantcontact.com/api/signup';
	</script>
	<script type='text/javascript' src='https://static.ctctcdn.com/h/contacts-embedded-signup-assets/1.0.2/js/signup-form.js'></script>
	<!--End CTCT Sign-Up Form-->
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
		<?php // Ensure the global $post variable is in scope
		global $post;
		// Retrieve the next 3 upcoming events
		$events = tribe_get_events( array(
		    'posts_per_page' => 3,
		) );
		// Loop through the events: set up each one as the current post then use
		// template tags to display the title and content
		foreach ( $events as $post ) {
			setup_postdata( $post ); ?>
			<p><strong><?php echo tribe_get_start_date( $post ); ?></strong><br><?php echo "$post->post_title"; ?></p>
		<?php } ?>
	<a class="dk_btn" href="<?php echo get_site_url(); ?>/events">View the Calendar</a>
	<?php } ?>

</div>
