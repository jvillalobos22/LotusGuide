<?php
/*
Template Name: Homepage Template
*/
?>

<?php get_header(); ?>

	<div id="content" class="dk_homepage">
		<?php

				$args = array(
					'post_type' => 'slide',
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
						  $sliderImg = get_field('slide_image');
					?>
					<li class="dk_slide">
						<img src="<?php echo $sliderImg['url']; ?>" alt="<?php echo $sliderImg['alt']; ?>">
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
					$preHeading = get_field('homepage_title_prefix');
					$postHeading = get_field('homepage_title_ending');
					$pageSubheading = get_field('page_subheading');
					?>

					<div class="dk_maincontent" <?php post_class(''); ?>>

						<h1 class="page-title"><?php echo $preHeading; ?> <span><?php echo $postHeading; ?></span></h1>
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
							<img src="<?php echo get_template_directory_uri(); ?>/assets/images/home-banner-ad-1.jpg" alt="addalt">
							<img src="<?php echo get_template_directory_uri(); ?>/assets/images/home-banner-ad-2.jpg" alt="addalt">
						</div>

					</div> <!-- end dk_maincontent -->

				<?php endwhile; endif; ?>

			</main> <!-- end #main -->
			<aside class="large-4 medium-4 small-12 columns">
				<div class="dk_sidebar">
					<h3>Featured Business</h3>
				</div>
			</aside>
		</div> <!-- end #inner-content -->

	</div> <!-- end #content -->

<?php get_footer(); ?>
