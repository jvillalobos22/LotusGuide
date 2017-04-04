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

						$calloutLeftHeading = $homeMeta['callout-left-heading'];
						$calloutLeftImg = $homeMeta['callout-left-image'];
						$calloutLeftAlt = $homeMeta['callout-left-imagealt'];
						$calloutLeftSubheading = $homeMeta['callout-left-subheading'];
						$calloutLeftParagraph = $homeMeta['callout-left-paragraph'];
						$calloutLeftBtnText = $homeMeta['callout-left-btntext'];
						$calloutLeftBtnLink = $homeMeta['callout-left-btnlink'];

						$calloutRightHeading = $homeMeta['callout-right-heading'];
						$calloutRightImg = $homeMeta['callout-right-image'];
						$calloutRightAlt = $homeMeta['callout-right-imagealt'];
						$calloutRightSubheading = $homeMeta['callout-right-subheading'];
						$calloutRightParagraph = $homeMeta['callout-right-paragraph'];
						$calloutRightBtnText = $homeMeta['callout-right-btntext'];
						$calloutRightBtnLink = $homeMeta['callout-right-btnlink'];

						$bannerAdOne = $homeMeta['banner-ad-one'];
						$bannerAdOneAlt = $homeMeta['banner-ad-onealt'];
						$bannerAdOneLink = $homeMeta['banner-ad-one-link'];

						$testimonialHeading = $homeMeta['testimonial-heading'];
						$testimonialQuote = $homeMeta['testimonial-quote'];
						$testimonialName = $homeMeta['testimonial-name'];

						$bannerAdTwo = $homeMeta['banner-ad-two'];
						$bannerAdTwoAlt = $homeMeta['banner-ad-twoalt'];
						$bannerAdTwoLink = $homeMeta['banner-ad-two-link'];
					?>

					<div class="dk_maincontent" <?php post_class(''); ?>>

						<h1 class="page-title"><?php echo $preHeading; ?> <span><?php echo $postHeading; ?></span></h1>
						<?php if($pageSubheading != '') { ?><h2 class="dk_subheading"><?php echo $pageSubheading; ?></h2><?php } ?>
					    <?php the_content(); ?>
						<div class="row dk_homecallouts">
							<div class="large-6 medium-6 small-12 columns">
								<div class="dk_callout">
									<h3 class="dk_heading"><?php echo $calloutLeftHeading; ?></h3>
									<img src="<?php echo $calloutLeftImg; ?>" alt="<?php echo $calloutLeftAlt; ?>">
									<h4><?php echo $calloutLeftSubheading; ?></h4>
									<p><?php echo $calloutLeftParagraph; ?></p>
									<a class="dk_btn" href="<?php echo $calloutLeftBtnLink; ?>"><?php echo $calloutLeftBtnText; ?></a>
								</div>
							</div>
							<div class="large-6 medium-6 small-12 columns">
								<div class="dk_callout">
									<h3 class="dk_heading"><?php echo $calloutRightHeading; ?></h3>
									<img src="<?php echo $calloutRightImg; ?>" alt="<?php echo $calloutRightAlt; ?>">
									<h4><?php echo $calloutRightSubheading; ?></h4>
									<p><?php echo $calloutRightParagraph; ?></p>
									<a class="dk_btn" href="<?php echo $calloutRightBtnLink; ?>"><?php echo $calloutRightBtnText; ?></a>
								</div>
							</div>
						</div>
						<div class="dk_home_adbanners">
							<a href="<?php echo $bannerAdOneLink; ?>" target="_blank"><img src="<?php echo $bannerAdOne; ?>" alt="<?php echo $bannerAdOneAlt; ?>"></a>
							<div class="dk_home_testimonial" style="background-image: url(<?php echo get_template_directory_uri(); ?>/assets/images/homepage-testimonial-stock.jpg);">
								<div class="dk_caption">
									<h4><?php echo $testimonialHeading; ?></h4>
									<p>&ldquo;<?php echo $testimonialQuote; ?>&ldquo;</p>
									<p><strong><?php echo $testimonialName; ?></strong></p>
								</div>
							</div>
							<a href="<?php echo $bannerAdTwoLink; ?>" target="_blank"><img src="<?php echo $bannerAdTwo; ?>" alt="<?php echo $bannerAdTwoAlt; ?>"></a>
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
			</aside>
		</div> <!-- end #inner-content -->

	</div> <!-- end #content -->

<?php get_footer(); ?>
