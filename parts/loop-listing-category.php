<?php // Start Listing Category
    $obj = get_queried_object();
    /*echo '<pre>';
    print_r( $obj );
    echo '</pre>';*/
    /*echo '<code>';
    print_r( $obj->slug );
    echo '</code>';*/

    $listingCatAry = get_term_meta( $obj->term_id, 'listingFields' );
    $listingCatFields = $listingCatAry[0];

    $listingCatImg = $listingCatFields['imageurl'];
    $listingCatAlt = $listingCatFields['imagealt'];
    $listingCatDesc = $listingCatFields['desceditor'];

    $titleArray = str_word_count($obj->name, 1);
    $preTitle = '';
    $postTitle = '';
    $numOfWords = count($titleArray);

    if($numOfWords > 1) {
        $n = 1;
        foreach($titleArray as $subTitle) {
            if($n == $numOfWords) {
                // last word
                $postTitle = $subTitle;
            } else {
                // not last word
                if($subTitle == 's') {
                    $subTitle = '\'s';
                }
                $preTitle .= $subTitle;
                if($titleArray[$n] != 's'){
                    $preTitle .= ' ';
                }

            }
            $n = $n + 1;
        }
    } else {
        // Title is only one word
        $postTitle = $obj->name;
    }

?>
<div class="dk_listingcat">
    <h1><?php echo $preTitle; ?><span><?php echo $postTitle; ?></span></h1>
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
