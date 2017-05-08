<?php
/*
page.php
*/
?>

<?php get_header(); ?>

	<div id="content" class="dk_secondarypage dk_defaultpage">

		<div id="inner-content" class="row">

		    <main id="main" class="large-8 medium-8 small-12 columns" role="main">

				<?php
					if (have_posts()) : while (have_posts()) : the_post();

					?>

					<div class="dk_maincontent" <?php post_class(''); ?>>
						<div class="dk_content_block">
					    	<?php the_content(); ?>
						</div>

					</div> <!-- end dk_maincontent -->

				<?php endwhile; endif; ?>

			</main> <!-- end #main -->
			<aside class="large-4 medium-4 small-12 columns">
				<?php get_sidebar(); ?>
			</aside>
		</div> <!-- end #inner-content -->

	</div> <!-- end #content -->

<?php get_footer(); ?>
