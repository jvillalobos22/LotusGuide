<?php get_header(); ?>

<div id="content" class="dk_secondarypage dk_search">

	<div id="inner-content" class="row">

		<main id="main" class="large-8 medium-8 small-12 columns" role="main">
			<div class="dk_maincontent">
				<header>
					<h1 class="archive-title">Search <span>Results</span></h1>
					<h2 class="dk_subheading">Showing Results For: <?php echo esc_attr(get_search_query()); ?></h2>
				</header>

				<?php
					if (have_posts()) : while (have_posts()) : the_post();
					$post_type = get_post_type();
					?>
					<?php if($post_type == 'business_listing') { ?>
						<div class="dk_bizsearch">
							<span class="dk_classification">Business Listing</span>
							<?php get_template_part( 'parts/content', 'business-listing'); ?>
						</div>
					<?php } else { ?>
					<!-- To see additional archive styles, visit the /parts directory -->
					<article class="dk_articlesearch">

						<span class="dk_classification">
						<?php if($post_type == 'page') {
							echo 'Page';
						} else {
							echo 'Article';
						}
						?>
						</span>
						<h2><a href="<?php the_permalink(); ?>" title="Read more"><?php the_title(); ?></a></h2>
						<div class="dk_blogexcerpt">
							<div class="dk_excerptimg">
								<div class="dk_desktop">
									<?php the_post_thumbnail( 'thumbnail' ); ?>
								</div>
								<div class="dk_mobile">
									<?php the_post_thumbnail( 'medium_large' ); ?>
								</div>
							</div>
							<?php the_excerpt(); ?>
							<div class="dk_clearfix"></div>
						</div>
					</article>
					<?php } ?>

				<?php endwhile; ?>

					<?php joints_page_navi(); ?>

				<?php else : ?>

					<?php get_template_part( 'parts/content', 'missing' ); ?>

			    <?php endif; ?>
			</div>
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
