<?php get_header(); ?>
<div id="content" class="dk_secondarypage dk_blog">
	<div id="inner-content" class="row">
	    <main id="main" class="large-8 medium-8 small-12 columns" role="main">
			<div class="dk_maincontent" <?php post_class(''); ?>>
			    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			    	<?php get_template_part( 'parts/loop', 'single' ); ?>
			    <?php endwhile; else : ?>
			   		<?php get_template_part( 'parts/content', 'missing' ); ?>
			    <?php endif; ?>
			</div><!-- /dk_maincontent -->
		</main> <!-- end #main -->
		<aside class="large-4 medium-4 small-12 columns">
			<?php get_sidebar(); ?>
		</aside>

	</div> <!-- end #inner-content -->

</div> <!-- end #content -->

<?php get_footer(); ?>
