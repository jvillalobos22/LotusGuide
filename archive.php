<?php
	$obj = get_queried_object();
	/*echo '<pre>';
	print_r( $obj );
	echo '</pre>';*/
	echo '<code>';
	print_r( $obj->slug );
	echo '</code>';

get_header(); ?>

	<div id="content" class="dk_archive">

		<div id="inner-content" class="row">

		    <main id="main" class="large-8 medium-8 small-12 columns" role="main">

				<?php if ( is_tax( 'listing-category' ) ) {
						$listingAry = get_term_meta( $obj->term_id, 'listingFields' );
						$listingFields = $listingAry[0];

						$listingImg = $listingFields['imageurl'];
						$listingAlt = $listingFields['imagealt'];
						$listingDesk = $listingFields['desceditor'];
					?>
					<div class="dk_listingcat">
						<h2><?php echo $obj->name ?></h2>
						<div class="dk_listingcat_description">
							<img class="dk_listingcat_img" src="<?php echo $listingImg; ?>" alt="<?php echo $listingAlt; ?>">
							<?php echo $listingDesk ?>
						</div>

						<?php $the_query = new WP_Query(array(
							'post_type' => 'business_listing',
							'posts_per_page' => 100,
							'category_name' => $obj->slug
						));
						while ( $the_query->have_posts() ) :
							$the_query->the_post();
							echo '<h5>';
								the_title();
							echo '</h5>';
						endwhile;
						?>
					</div>

				<?php } else { ?>
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

			</main> <!-- end #main -->
			<aside class="large-4 medium-4 small-12 columns">
				<?php get_sidebar(); ?>
			</aside>

	    </div> <!-- end #inner-content -->

	</div> <!-- end #content -->

<?php get_footer(); ?>
