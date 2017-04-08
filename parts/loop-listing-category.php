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
    $listingCatDesk = $listingCatFields['desceditor'];
?>
<div class="dk_listingcat">
    <h2><?php echo $obj->name ?></h2>
    <div class="dk_listingcat_description">
        <img class="dk_listingcat_img" src="<?php echo $listingCatImg; ?>" alt="<?php echo $listingCatAlt; ?>">
        <?php echo $listingCatDesk ?>
    </div>

    <!-- Loop Through Listings that fall within this category -->
    <div class="dk_listings_loop">
        <?php $the_query = new WP_Query(array(
            'post_type' => 'business_listing',
            'posts_per_page' => 100,
            'category_name' => $obj->slug
        ));
        while ( $the_query->have_posts() ) :
            $the_query->the_post();

            $listingFields = get_post_meta( $post->ID, 'business_listings', true );
            $listingAddress = $listingFields['address'];
            $listingPhone = $listingFields['phone'];
            $cleanPhone = preg_replace('/[^0-9]/', '', $listingPhone);
            $listingWebsite = $listingFields['website'];
            $listingEmail = $listingFields['email'];
            $listingDescription = $listingFields['businessdescription'];
            $listingImg = $listingFields['listingimg'];
            $listingImgalt = $listingFields['listingimgalt'];
            $listingFacebook = $listingFields['facebook'];
            $listingGoogle = $listingFields['googleplus'];
            $listingYelp = $listingFields['yelp'];
            $listingTwitter = $listingFields['twitter'];
            $listingLinkedin = $listingFields['linkedin'];
            ?>
            <div class="dk_business_listing">
                <div class="row">
                    <div class="large-3 medium-3 small-12 columns dk_businessimg">
                        <?php if($listingImg != '') { ?>
                            <img src="<?php echo $listingImg; ?>" alt="<?php echo $listingImgalt; ?>">
                        <?php } else { ?>
                            Standard Image
                        <?php } ?>
                    </div>
                    <div class="large-9 medium-9 small-12 columns">
                        <h5><?php echo the_title(); ?></h5>
                        <div class="dk_business_details">
                            <a href="tel:+1<?php echo $cleanPhone; ?>"><?php echo $listingPhone; ?></a>
                            <a href="mailto:<?php echo $listingEmail; ?>"><?php echo $listingEmail; ?></a>
                            <a href="<?php echo $listingWebsite; ?>" target="_blank"><?php echo $listingWebsite; ?></a>
                            <address><?php echo $listingAddress; ?></address>
                        </div>
                        <!-- Add Social Media Btns -->
                    </div>
                    <div class="large-12 columns">
                        <p class="dk_businessdescription">
                            <?php echo $listingDescription; ?>
                        </p>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
    <!-- End Listings Loop -->
</div>
<!-- End Listing Category -->
