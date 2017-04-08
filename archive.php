<?php get_header(); ?>

	<div id="content" class="dk_archive">

		<div id="inner-content" class="row">

		    <main id="main" class="large-8 medium-8 small-12 columns" role="main">
				<div class="dk_maincontent">

				<?php if ( is_tax( 'listing-category' ) ) {
					get_template_part( 'parts/loop', 'listing-category');
				} else { ?>
					<header>
						<h1 class="page-title"><?php the_archive_title();?></h1>
						<?php the_archive_description('<div class="taxonomy-description">', '</div>');?>
					</header>

					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

						<!-- To see additional archive styles, visit the /parts directory -->
						<?php get_template_part( 'parts/loop', 'archive' ); ?>

					<?php endwhile; ?>

						<?php joints_page_navi(); ?>

					<?php else : ?>

						<?php get_template_part( 'parts/content', 'missing' ); ?>

					<?php endif; ?>
				<?php } ?>
				</div>
			</main> <!-- end #main -->
			<aside class="large-4 medium-4 small-12 columns">
				<?php get_sidebar(); ?>
			</aside>

	    </div> <!-- end #inner-content -->

	</div> <!-- end #content -->

<?php get_footer(); ?>
