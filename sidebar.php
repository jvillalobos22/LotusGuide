<?php
$post_type = get_post_type();
//if business_listing
if($post_type == 'business_listing') {
	$obj = get_queried_object();
	$listingCatAry = get_term_meta( $obj->term_id, 'listingFields' );
	$sidebarMeta = $listingCatAry[0];
} else { //if post, page
	$pageTemplate = get_post_meta($post->ID, '_wp_page_template', true);
	if($pageTemplate == 'template-blog.php') {
		$sidebarMeta = get_post_meta( 187, 'sidebar', true );
	} elseif ($pagetemplate == 'template-pickup-locations-index.php') {
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
	<a href="#">
		<img src="<?php echo get_template_directory_uri(); ?>/assets/images/homepage-flipbook-placeholder.jpg" alt="addalt">
	</a>
	<?php } ?>
	<!-- About Module -->
	<?php if($aboutWidget) { ?>
	<h3 class="dk_heading">About the Lotus Guide</h3>
	<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate turpis eget finibus dictum. Sed non erat quis ex semper iaculis eu eu lectus.</p>
	<a class="dk_btn" href="#">Learn More</a>
	<?php } ?>
	<!-- Advertise With Us Module -->
	<?php if($advertiseWidget) { ?>
	<h3 class="dk_heading">Advertise With Us</h3>
	<p>Build your business success with printed media, email, video and online advertising designed for your target audience!</p>
	<a class="dk_btn" href="#">Get the Details</a>
	<?php } ?>
	<!-- Testimonial Module -->
	<?php if($testimonialsWidget) { ?>
	<h3 class="dk_heading">Testimonials From Our Users</h3>
	<p>&ldquo;I began advertising in the Lotus Guide in the Summer of 2015 and have benefited from a steady increase in new client leads and exposure to the community. Rahasya and Dhara have been quite helpful in making the process as streamlined and “painless” as possible!...&rdquo;</p>
	<a class="dk_btn" href="#">Our Testimonials</a>
	<?php } ?>
	<!-- Newsletter Module -->
	<?php if($newsletter) { ?>
	<h3 class="dk_heading">Newsletter</h3>
	<p>Sign up to receive our newsletter right to your inbox! <a href="#">Get Started Now!</a></p>
	<?php } ?>
	<!-- Social Media Module -->
	<?php if($socializeWidget) { ?>
	<h3 class="dk_heading">Socialize</h3>
	<p>Facebook buttons</p>
	<?php } ?>
	<!-- Upcoming Events Module -->
	<?php if($upcomingEvents) { ?>
	<h3 class="dk_heading">Upcoming Events</h3>
	<p><strong>February 14, 2017</strong><br>Valentine's Dinner at The Elk's Lodge</p>
	<p><strong>February 14, 2017</strong><br>Valentine's Dinner at The Elk's Lodge</p>
	<a class="dk_btn" href="#">View the Calendar</a>
	<?php } ?>

</div>
