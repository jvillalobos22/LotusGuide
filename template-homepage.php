<?php
/*
Template Name: Homepage Template
*/
?>

<?php get_header(); ?>

	<div id="content" class="dk_homepage">
		<?php

				$args = array(
					'post_type' => 'homepage_slide',
					'orderby' => 'menu_order',
					'posts_per_page' => -1
				);

				$slides = new WP_Query( $args );

				if ( $slides->have_posts() ) :
		?>
		<div class="dk_hero dk_slider row">
			<div class="dk_homeslider">
				<ul>
					<?php while ( $slides->have_posts() ) : $slides->the_post();

						$meta = get_post_meta( $post->ID, 'slides', true );
					?>
					<li class="dk_slide">
						<img src="<?php echo $meta['image']; ?>" alt="<?php echo $meta['alt']; ?>">
					</li>
					<?php endwhile; ?>
				</ul>
			</div>
		</div>
		<?php endif; ?>

		<div id="inner-content" class="row">

		    <main id="main" class="large-8 medium-8 small-12 columns" role="main">

				<?php
					if (have_posts()) : while (have_posts()) : the_post();
						$homeMeta = get_post_meta( $post->ID, 'homepage', true );
						$preHeading = $homeMeta['homepage-title-prefix'];
						$postHeading = $homeMeta['homepage-title-ending'];
						$pageSubheading = $homeMeta['homepage-subheading'];
					?>

					<div class="dk_maincontent" <?php post_class(''); ?>>

						<h1 class="page-title"><?php echo $homeMeta['super-cool-option']; ?> <span><?php echo $postHeading; ?></span></h1>
						<h2 class="dk_subheading"><?php echo $pageSubheading; ?></h2>
					    <?php the_content(); ?>
						<div class="row dk_homecallouts">
							<div class="large-6 medium-6 small-12 columns">
								<div class="dk_callout">
									<h3 class="dk_heading">Business Directory</h3>
									<img src="<?php echo get_template_directory_uri(); ?>/assets/images/homepage-callout-left.jpg" alt="addalt">
									<h4>Connecting People Through Healthy Living</h4>
									<p>Vivamus vitae dolor sed tortor tincidunt aliquam sed quis tortor. Fusce neque elit vestibulum non dolor nec. Vivamus vitae dolor sed tortor tincidunt aliquam sed quis tortor. Fusce neque elit vestibulum non dolor nec.</p>
									<a class="dk_btn" href="#">Visit the Directory</a>
								</div>
							</div>
							<div class="large-6 medium-6 small-12 columns">
								<div class="dk_callout">
									<h3 class="dk_heading">Advertise With the Lotus Guide</h3>
									<img src="<?php echo get_template_directory_uri(); ?>/assets/images/homepage-callout-left.jpg" alt="addalt">
									<h4>Our magazine is seen by xxx,xxx people!</h4>
									<p>Vivamus vitae dolor sed tortor tincidunt aliquam sed quis tortor. Fusce neque elit vestibulum non dolor nec. Vivamus vitae dolor sed tortor tincidunt aliquam sed quis tortor. Fusce neque elit vestibulum non dolor nec.</p>
									<a class="dk_btn" href="#">Get the Details</a>
								</div>
							</div>
						</div>
						<div class="dk_home_adbanners">
							<a href="#" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/home-banner-ad-1.jpg" alt="addalt"></a>
							<div class="dk_home_testimonial" style="background-image: url(<?php echo get_template_directory_uri(); ?>/assets/images/homepage-testimonial-stock.jpg);">

								<div class="dk_caption">
									<h4>Readers Love the Lotus Guide</h4>
									<p>&ldquo;Lotus Guide is a wonderful resource for the Northern California community for alternative health. Fun, uplifting and an all around feel good read. Dhara and Rahasya are also fantastic to work with for ads and marketing like minded business'. It's a win win! Thank you Lotus Guide for all the beautiful work you do. Thank you Lotus Guide for all the beautiful work you do.&ldquo;</p>
									<p><strong>Jody McNicholas</strong></p>
								</div>
							</div>
							<a href="#" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/home-banner-ad-2.jpg" alt="addalt"></a>
						</div>

					</div> <!-- end dk_maincontent -->

				<?php endwhile; endif; ?>

			</main> <!-- end #main -->
			<aside class="large-4 medium-4 small-12 columns">
				<div class="dk_sidebar">
					<form role="search" method="get" class="search-form dk_searchbar" action="<?php echo home_url( '/' ); ?>">
						<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search Here', 'jointswp' ) ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'jointswp' ) ?>" />
						<input type="submit" class="search-submit button dk_searchsubmit" value="<?php echo esc_attr_x( '...', 'jointswp' ) ?>" />
						<i class="fa fa-search" aria-hidden="true"></i>
					</form>
					<h3 class="dk_heading">Featured Business</h3>
					<a class="dk_adlink_container" href="#">
						<img src="<?php echo get_template_directory_uri(); ?>/assets/images/home-sidebar-ad-1.jpg" alt="addalt">
						<h4>Business Name Goes Here</h4>
					</a>
					<h3 class="dk_heading">Recent Issue</h3>
					<img src="<?php echo get_template_directory_uri(); ?>/assets/images/homepage-flipbook-placeholder.jpg" alt="addalt">
					<h3 class="dk_heading">Newsletter</h3>
					<p>Sign up to receive our newsletter right to your inbox! <a href="#">Get Started Now!</a></p>
					<h3 class="dk_heading">Socialize</h3>
					<p>Facebook buttons</p>
					<h3 class="dk_heading">Upcoming Events</h3>
					<p><strong>February 14, 2017</strong><br>Valentine's Dinner at The Elk's Lodge</p>
					<p><strong>February 14, 2017</strong><br>Valentine's Dinner at The Elk's Lodge</p>
					<a class="dk_btn" href="#">View the Calendar</a>
				</div>
			</aside>
		</div> <!-- end #inner-content -->

	</div> <!-- end #content -->

<?php get_footer(); ?>
