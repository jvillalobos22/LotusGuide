<?php
/*
Template Name: Blog Index Template
*/
?>

<?php get_header(); ?>
<div id="content" class="dk_secondarypage dk_blog">
	<div id="inner-content" class="row">
	    <main id="main" class="large-8 medium-8 small-12 columns" role="main">
			<div class="dk_maincontent" <?php post_class(''); ?>>
				<?php
					if (have_posts()) : while (have_posts()) : the_post();
						$secPageMeta = get_post_meta( $post->ID, 'secpage', true );
						$preHeading = $secPageMeta['secpage-title-prefix'];
						$postHeading = $secPageMeta['secpage-title-ending'];
						$pageSubheading = $secPageMeta['secpage-subheading'];

						$bannerImg = $secPageMeta['banner-image'];
						$bannerAlt = $secPageMeta['banner-image-alt'];
					?>

						<?php if($bannerImg != '') { ?>
							<img class="dk_topimg" src="<?php echo $bannerImg; ?>" alt="<?php echo $bannerAlt; ?>">
						<?php } ?>
						<h1 class="page-title"><?php echo $preHeading; ?> <span><?php echo $postHeading; ?></span></h1>
						<?php if($pageSubheading != '') { ?><h2 class="dk_subheading"><?php echo $pageSubheading; ?></h2><?php } ?>
						<div class="dk_content_block">
					    	<?php the_content(); ?>
						</div>
				<?php endwhile; endif; ?>

				<article>
					<?php // Display blog posts on any page @ https://m0n.co/l
					$temp = $wp_query; $wp_query= null;
					$wp_query = new WP_Query(); $wp_query->query('posts_per_page=5' . '&paged='.$paged);
					while ($wp_query->have_posts()) : $wp_query->the_post(); ?>

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

					<?php endwhile; ?>

					<?php if ($paged > 1) { ?>

					<nav id="nav-posts" class="dk_blognav">
						<div class="prev"><?php next_posts_link('<i class="fa fa-caret-left" aria-hidden="true"></i> Previous Posts'); ?></div>
						<div class="next"><?php previous_posts_link('Newer Posts <i class="fa fa-caret-right" aria-hidden="true"></i>'); ?></div>
					</nav>

					<?php } else { ?>

					<nav id="nav-posts" class="dk_blognav">
						<div class="prev"><?php next_posts_link('<i class="fa fa-caret-left" aria-hidden="true"></i> Previous Posts'); ?></div>
					</nav>

					<?php } ?>

					<?php wp_reset_postdata(); ?>
				</article>
			</div> <!-- end dk_maincontent -->
		</main> <!-- end #main -->
		<aside class="large-4 medium-4 small-12 columns">
			<?php get_sidebar(); ?>
		</aside>
	</div> <!-- end #inner-content -->
</div> <!-- end #content -->
<?php get_footer(); ?>
