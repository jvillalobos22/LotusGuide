<?php
/*
Template Name: Business Directory
*/
?>

<?php
$customURL = get_site_url().'/listing-category/';

get_header();
?>

	<div id="content" class="dk_secondarypage">

		<div id="inner-content" class="row">

		    <main id="main" class="large-8 medium-8 small-12 columns" role="main">

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
                    foreach($categories as $category) {
                        echo
                            '<a href="'.$customURL.$category->slug.'">
                                '.$category->name.'
                            </a><br><p>'.$customURL.$category->slug.'</p>';
                        //echo '<p>Id = '.$category->cat_ID.'</p>'; // uncomment to see cat ids

                        $subargs = array(
                            'hide_empty' => 0, // set to 1 before launch
                            'orderby' => 'name',
                            'order' => 'ASC',
                            'parent' => $category->cat_ID,
                            'hierarchical' => true,
                            'taxonomy' => 'listing-category'
                        );
                        $subCategories = get_categories($subargs);
                        foreach($subCategories as $sub) {
                            echo
                                '<a style="margin-left: 2rem;" href="'.$customURL.$sub->slug.'">
                                    '.$sub->name.'
                                </a><br>';
                        }
                        /*
                        $the_query = new WP_Query(array(
                            'post_type' => 'business_listing',
                            'posts_per_page' => 100,
                            'category_name' => $category->slug
                        ));
                        while ( $the_query->have_posts() ) :
                        $the_query->the_post();
                        echo '<h5>';
                            the_title();
                        echo '</h5>';
                    endwhile;*/
                    }
                ?>

			</main> <!-- end #main -->
			<aside class="large-4 medium-4 small-12 columns">
				<div class="dk_sidebar">
					<!-- Search Bar Module -->
					<form role="search" method="get" class="search-form dk_searchbar" action="<?php echo home_url( '/' ); ?>">
						<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search Here', 'jointswp' ) ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'jointswp' ) ?>" />
						<input type="submit" class="search-submit button dk_searchsubmit" value="<?php echo esc_attr_x( '...', 'jointswp' ) ?>" />
						<i class="fa fa-search" aria-hidden="true"></i>
					</form>
					<!-- About Module -->
					<h3 class="dk_heading">About the Lotus Guide</h3>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate turpis eget finibus dictum. Sed non erat quis ex semper iaculis eu eu lectus.</p>
					<a class="dk_btn" href="#">Learn More</a>
					<!-- Advertise With Us Module -->
					<h3 class="dk_heading">Advertise With Us</h3>
					<p>Build your business success with printed media, email, video and online advertising designed for your target audience!</p>
					<a class="dk_btn" href="#">Get the Details</a>
					<!-- Testimonial Module -->
					<h3 class="dk_heading">Testimonials From Our Users</h3>
					<p>&ldquo;I began advertising in the Lotus Guide in the Summer of 2015 and have benefited from a steady increase in new client leads and exposure to the community. Rahasya and Dhara have been quite helpful in making the process as streamlined and “painless” as possible!...&rdquo;</p>
					<a class="dk_btn" href="#">Our Testimonials</a>
				</div>
			</aside>
		</div> <!-- end #inner-content -->

	</div> <!-- end #content -->

<?php get_footer(); ?>
