<?php
/*
Template Name: Ad Testimonials Template
*/
?>

<?php get_header(); ?>

	<div id="content" class="dk_secondarypage_fullwidth dk_adtestimonials">

		<div id="inner-content" class="row">

		    <main id="main" class="large-12 medium-12 small-12 columns" role="main">
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
						<?php if($bannerImg != '') { ?>
							<img class="dk_topimg" src="<?php echo $bannerImg; ?>" alt="<?php echo $bannerAlt; ?>">
						<?php } ?>
						<h1 class="page-title"><?php echo $preHeading; ?> <span><?php echo $postHeading; ?></span></h1>
						<?php if($pageSubheading != '') { ?><h2 class="dk_subheading"><?php echo $pageSubheading; ?></h2><?php } ?>
						<div class="dk_content_block">
							<?php the_content(); ?>
						</div>
						<!-- Show All Testimonials -->
						<?php
							$args = array(
								'post_type' => 'ad_testimonial',
								'orderby' => 'menu_order',
								'posts_per_page' => -1
							);
							$adTestimonials = new WP_Query( $args );

							if ( $adTestimonials->have_posts() ) :
								while ( $adTestimonials->have_posts() ) : $adTestimonials->the_post();
									$meta = get_post_meta( $post->ID, 'ad_testimonial', true );
									?>
									<figure class="dk_testimonial">
									    <blockquote>
									        &ldquo;<?php echo $meta['testimonial-quote']; ?>&rdquo;
									    </blockquote>
									    <footer>
									        <cite class="author"><?php echo $meta['testimonial-details']; ?></cite>
									    </footer>
									</figure>

								<?php endwhile; endif; ?>
						<!-- End Testimonials -->
					</div> <!-- end dk_maincontent -->

				<?php endwhile; endif; ?>

			</main> <!-- end #main -->
		</div> <!-- end #inner-content -->

	</div> <!-- end #content -->

<?php get_footer(); ?>
