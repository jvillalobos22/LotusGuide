<?php // Start Listing Category
    $obj = get_queried_object();
    /*echo '<pre>';
    print_r( $obj );
    echo '</pre>';*/
    echo '<code>';
    print_r( $obj->slug );
    echo '</code>';

    $listingCatAry = get_term_meta( $obj->term_id, 'listingFields' );
    $listingCatFields = $listingCatAry[0];

    $listingCatImg = $listingCatFields['imageurl'];
    $listingCatAlt = $listingCatFields['imagealt'];
    $listingCatDesc = $listingCatFields['desceditor'];
?>
<div class="dk_listingcat">
    <h2><?php echo $obj->name ?></h2>
    <div class="dk_listingcat_description">
        <img class="dk_listingcat_img" src="<?php echo $listingCatImg; ?>" alt="<?php echo $listingCatAlt; ?>">
        <?php echo $listingCatDesc ?>
    </div>

    <!-- Loop Through Listings that fall within this category -->
    <div class="dk_listings_loop dk_clearfix">
        <?php $the_query = new WP_Query(array(
            'post_type' => 'business_listing',
            'posts_per_page' => 100,
            'orderby' => 'rand',
            'tax_query' => array(
                array(
                    'taxonomy' => 'listing-category',
                    'field' => 'slug',
                    'terms' => $obj->slug
                )
            )
        ));
        // Loop Through Featured Listings
        $atLeastOne = false;
        while ( $the_query->have_posts() ) :
            $the_query->the_post();

            $listingFields = get_post_meta( $post->ID, 'business_listings', true );

            if($listingFields['featured'] === 'true') {
                $listingFeatured = true;
                if($atLeastOne == false) {
                    echo '<div class="dk_featuredlistings">';
                    echo '<strong class="dk_featured_tag">Featured</strong>';
                    $atLeastOne = true;
                }
            } else {
                $listingFeatured = false;
            }

            if($listingFeatured) {
                // output listing
                get_template_part( 'parts/content', 'business-listing' );
            }
        endwhile;
        if($atLeastOne) { // If there was at least one featured item
            echo '</div>';
        }
        // Loop Through Non-Featured Listings
        while ( $the_query->have_posts() ) :
            $the_query->the_post();

            $listingFields = get_post_meta( $post->ID, 'business_listings', true );

            if($listingFields['featured'] === 'true') {
                $listingFeatured = true;
            } else {
                $listingFeatured = false;
            }

            if(!$listingFeatured) {
                // output listing
                get_template_part( 'parts/content', 'business-listing' );
            }
        endwhile; ?>
    </div>
    <!-- End Listings Loop -->
</div>
<!-- End Listing Category -->
