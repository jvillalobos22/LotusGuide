<?php
/*
Template Name: Pickup Locations Template
*/
?>

<?php get_header(); ?>

	<div id="content" class="dk_secondarypage">

		<div id="inner-content" class="row">

		    <main id="main" class="large-8 medium-8 small-12 columns" role="main">

				<?php
					if (have_posts()) : while (have_posts()) : the_post();
						$secPageMeta = get_post_meta( $post->ID, 'secpage', true );
						$preHeading = $secPageMeta['secpage-title-prefix'];
						$postHeading = $secPageMeta['secpage-title-ending'];
						$pageSubheading = $secPageMeta['secpage-subheading'];

						$bannerImg = $secPageMeta['banner-image'];
						$bannerAlt = $secPageMeta['banner-image-alt'];
					?>

					<div class="dk_maincontent" <?php post_class(''); ?>>
						<div class="dk_directory dk_pickup_locations">
							<?php if($bannerImg != '') { ?>
								<img class="dk_topimg" src="<?php echo $bannerImg; ?>" alt="<?php echo $bannerAlt; ?>">
							<?php } ?>
							<h1 class="page-title"><?php echo $preHeading; ?> <span><?php echo $postHeading; ?></span></h1>
							<?php if($pageSubheading != '') { ?><h2 class="dk_subheading"><?php echo $pageSubheading; ?></h2><?php } ?>
							<div class="dk_content_block">
						    	<?php the_content(); ?>
							</div>
							<?php
								$args = array(
									'post_type' => 'pickup_location',
									'orderby' => 'menu_order',
									'posts_per_page' => -1
								);

								$slides = new WP_Query( $args );
								if ( $slides->have_posts() ) :
									$loopCount = 0;
									$halfCount = 11;
							?>
								<div class="row collapse">
								<?php while ( $slides->have_posts() ) : $slides->the_post();
									$meta = get_post_meta( $post->ID, 'pickup_locations', true );
									if($loopCount == 0 || $loopCount == $halfCount) {
										echo '<div class="large-6 medium-12 small-12 columns">';
										echo '<ul class="accordion" data-accordion data-allow-all-closed="true">';
									}
								?>
								<li class="accordion-item" data-accordion-item><a href="#" class="accordion-title"><?php echo the_title(); ?> <i class="fa fa-caret-down" aria-hidden="true"></i></a>
									<div class="accordion-content" data-tab-content>
										<?php the_content(); ?>
									</div>
								</li>
								<?php

								if($loopCount == ($halfCount - 1) || $loopCount == 21) {
									echo '</ul></div>';
								}
								$loopCount = $loopCount + 1;
								endwhile; ?>

							<?php endif; ?>
							</div>
						</div>
					</div> <!-- end dk_maincontent -->

				<?php endwhile; endif; ?>
			</main> <!-- end #main -->
			<aside class="large-4 medium-4 small-12 columns">
				<div class="dk_sidebar">
					<!-- Search Bar Module -->
					<form role="search" method="get" class="search-form dk_searchbar" action="<?php echo home_url( '/' ); ?>">
						<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search Here', 'jointswp' ) ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'jointswp' ) ?>" />
						<input type="submit" class="search-submit button dk_searchsubmit" value="<?php echo esc_attr_x( '...', 'jointswp' ) ?>" />
						<i class="fa fa-search" aria-hidden="true"></i>
					</form>
					<!-- About Module -->
					<h3 class="dk_heading">About the Lotus Guide</h3>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate turpis eget finibus dictum. Sed non erat quis ex semper iaculis eu eu lectus.</p>
					<a class="dk_btn" href="#">Learn More</a>
					<!-- Advertise With Us Module -->
					<h3 class="dk_heading">Advertise With Us</h3>
					<p>Build your business success with printed media, email, video and online advertising designed for your target audience!</p>
					<a class="dk_btn" href="#">Get the Details</a>
					<!-- Testimonial Module -->
					<h3 class="dk_heading">Testimonials From Our Users</h3>
					<p>&ldquo;I began advertising in the Lotus Guide in the Summer of 2015 and have benefited from a steady increase in new client leads and exposure to the community. Rahasya and Dhara have been quite helpful in making the process as streamlined and “painless” as possible!...&rdquo;</p>
					<a class="dk_btn" href="#">Our Testimonials</a>
				</div>
			</aside>
		</div> <!-- end #inner-content -->

	</div> <!-- end #content -->

<?php get_footer(); ?>
