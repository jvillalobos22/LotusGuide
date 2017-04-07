<div class="dk_sidebar">
	<!-- Search Bar Module -->
	<form role="search" method="get" class="search-form dk_searchbar" action="<?php echo home_url( '/' ); ?>">
		<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search Here', 'jointswp' ) ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'jointswp' ) ?>" />
		<input type="submit" class="search-submit button dk_searchsubmit" value="<?php echo esc_attr_x( '...', 'jointswp' ) ?>" />
		<i class="fa fa-search" aria-hidden="true"></i>
	</form>
	<!-- Featured Business Module -->
	<h3 class="dk_heading">Featured Business</h3>
	<a class="dk_adlink_container" href="#">
		<img src="<?php echo get_template_directory_uri(); ?>/assets/images/home-sidebar-ad-1.jpg" alt="addalt">
		<h4>Business Name Goes Here</h4>
	</a>
	<!-- Recent Issue Module -->
	<h3 class="dk_heading">Recent Issue</h3>
	<a href="#">
		<img src="<?php echo get_template_directory_uri(); ?>/assets/images/homepage-flipbook-placeholder.jpg" alt="addalt">
	</a>
	<!-- Newsletter Module -->
	<h3 class="dk_heading">Newsletter</h3>
	<p>Sign up to receive our newsletter right to your inbox! <a href="#">Get Started Now!</a></p>
	<!-- Social Media Module -->
	<h3 class="dk_heading">Socialize</h3>
	<p>Facebook buttons</p>
	<!-- Upcoming Events Module -->
	<h3 class="dk_heading">Upcoming Events</h3>
	<p><strong>February 14, 2017</strong><br>Valentine's Dinner at The Elk's Lodge</p>
	<p><strong>February 14, 2017</strong><br>Valentine's Dinner at The Elk's Lodge</p>
	<a class="dk_btn" href="#">View the Calendar</a>
</div>
