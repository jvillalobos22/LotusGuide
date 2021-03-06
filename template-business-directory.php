<?php
/*
Template Name: Business Directory
*/
?>

<?php

$customURL = get_site_url().'/listing-category/';

$secPageMeta = get_post_meta( $post->ID, 'secpage', true );
$preHeading = $secPageMeta['secpage-title-prefix'];
$postHeading = $secPageMeta['secpage-title-ending'];
$pageSubheading = $secPageMeta['secpage-subheading'];

$bannerImg = $secPageMeta['banner-image'];
$bannerAlt = $secPageMeta['banner-image-alt'];

get_header();
?>

<div id="content" class="dk_secondarypage dk_businessdirectory">
	<div id="inner-content" class="row">
	    <main id="main" class="large-8 medium-8 small-12 columns" role="main">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<div class="dk_maincontent" <?php post_class(''); ?>>
				<div class="dk_directory">
					<div class="row">
						<div class="large-12 columns">
							<?php if($bannerImg != '') { ?>
								<img class="dk_topimg" src="<?php echo $bannerImg; ?>" alt="<?php echo $bannerAlt; ?>">
							<?php } ?>
							<h1 class="page-title"><?php echo $preHeading; ?> <span><?php echo $postHeading; ?></span></h1>
							<?php if($pageSubheading != '') { ?><h2 class="dk_subheading"><?php echo $pageSubheading; ?></h2><?php } ?>
							<div class="dk_content_block">
						    	<?php the_content(); ?>
							</div>
						</div>
					</div>
					<div class="row">
	                <?php

	                    $args = array(
	                        'hide_empty' => 0, // set to 1 before launch
	                        'orderby' => 'name',
	                        'order' => 'ASC',
	                        'parent' => 0,
	                        'hierarchical' => true,
	                        'taxonomy' => 'listing-category'
	                    );
	                    $categories = get_categories($args);
						$catCount = count($categories);
						$halfCount = ceil($catCount / 2);
						//echo '<code>$catCount = '.$catCount.'</code><br>';
						//echo '<code>$halfCount = '.$halfCount.'</code><br>';

						$loopCount = 0;
	                    foreach($categories as $category) {
							$subargs = array(
	                            'hide_empty' => 0, // set to 1 before launch
	                            'orderby' => 'name',
	                            'order' => 'ASC',
	                            'parent' => $category->cat_ID,
	                            'hierarchical' => true,
	                            'taxonomy' => 'listing-category'
	                        );
							//echo '<br><p>'.$customURL.$category->slug.'</p>'; // uncomment to see cat url
							//echo '<p>Id = '.$category->cat_ID.'</p>'; // uncomment to see cat ids
							if($loopCount == 0 || $loopCount == $halfCount) {
								echo '<div class="large-6 medium-12 small-12 columns">';
								echo '<ul class="accordion" data-accordion data-allow-all-closed="true">';
							}
	                        $subCategories = get_categories($subargs);
							if($subCategories) {// Has Subcategories
								echo
									'<li class="accordion-item" data-accordion-item><a href="#" class="accordion-title">'.$category->name.' <i class="fa fa-caret-down" aria-hidden="true"></i></a>';
									echo '<div class="accordion-content" data-tab-content>';
									echo '<a class="dk_subcat" href="'.$customURL.$category->slug.'">
										<strong>All '.$category->name.' Listings</strong></a>';
									foreach($subCategories as $sub) {
			                            echo
			                                '<a class="dk_subcat" href="'.$customURL.$sub->slug.'">
			                                    <i class="fa fa-caret-right" aria-hidden="true"></i> '.$sub->name.'
			                                </a>';
			                        }
									echo '</div></li>';

							} else {// No Subcategories
								echo
									'<li><a href="'.$customURL.$category->slug.'">
										'.$category->name.'
									</a></li>';
							}
							if($loopCount == $halfCount - 1) {
								echo '</ul></div>';
							}
							$loopCount = $loopCount + 1;
	                    }
						echo '</ul></div>';
	                ?>
					</div>
				</div>
			</div><!-- /dk_maincontent -->
			<?php endwhile; endif; ?>
		</main> <!-- end #main -->
		<aside class="large-4 medium-4 small-12 columns">
			<?php get_sidebar(); ?>
		</aside>
	</div> <!-- end #inner-content -->
</div> <!-- end #content -->

<?php get_footer(); ?>
