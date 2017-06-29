<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?> role="article">
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
</article> <!-- end article -->
