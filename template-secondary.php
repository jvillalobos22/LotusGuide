<?php
/*
Template Name: Secondary Page Template
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
					?>

					<div class="dk_maincontent" <?php post_class(''); ?>>
						<img class="dk_topimg" src="<?php echo get_template_directory_uri(); ?>/assets/images/secondary-header-placeholder-940x300.jpg" alt="addalt">
						<h1 class="page-title"><?php echo $preHeading; ?> <span><?php echo $postHeading; ?></span></h1>
						<?php if($pageSubheading != '') { ?><h2 class="dk_subheading"><?php echo $pageSubheading; ?></h2><?php } ?>
					    <?php the_content(); ?>
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
