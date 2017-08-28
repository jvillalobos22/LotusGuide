<?php
/*
page.php
*/
?>

<?php get_header(); ?>

	<div id="content" class="dk_secondarypage_fullwidth">

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

						// $pageTemplate = get_post_meta($post->ID, '_wp_page_template', true);
						// echo '<code>$pageTemplate = '.$pageTemplate.'</code>';
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

						<?php
					        if( is_page( array( 'advertise-with-us' ) ) ) {
								wp_nav_menu(array(
						           'container' => false, // Remove nav container
								   'before' => '<i class="fa fa-play" aria-hidden="true"></i>',
								   'menu_class' => 'dk_bullets', // Adding custom nav class
						           'menu_class' => 'dk_bullets', // Adding custom nav class
						           'theme_location' => 'advertise-menu', // Where it's located in the theme
						           'depth' => 5, // Limit the depth of the nav
						       ));
					        }
						?>

					</div> <!-- end dk_maincontent -->

				<?php endwhile; endif; ?>

			</main> <!-- end #main -->
		</div> <!-- end #inner-content -->

	</div> <!-- end #content -->

<?php get_footer(); ?>
