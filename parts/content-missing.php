<div id="post-not-found" class="hentry">

	<?php if ( is_search() ) : ?>
		<div class="dk_noresults">
			<h3><?php _e( 'Sorry, No Results.', 'jointswp' );?></h3>
			<p><?php _e( 'Try your search again.', 'jointswp' );?></p>
		</div>
		<section class="search">
		    <p><?php get_search_form(); ?></p>
		</section> <!-- end search section -->
	<?php else: ?>

		<header class="article-header">
			<h1><?php _e( 'Oops, Post Not Found!', 'jointswp' ); ?></h1>
		</header>

		<section class="entry-content">
			<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'jointswp' ); ?></p>
		</section>

		<section class="search">
		    <p><?php get_search_form(); ?></p>
		</section> <!-- end search section -->

	<?php endif; ?>

</div>
