<?php
$customURL = get_site_url().'/listing-category/';

$listingFields = get_post_meta( $post->ID, 'business_listings', true );

if($listingFields['featured'] === 'true') {
    $listingFeatured = true;
} else {
    $listingFeatured = false;
}

$listingAddress = $listingFields['address'];
$listingPhone = $listingFields['phone'];
$cleanPhone = preg_replace('/[^0-9]/', '', $listingPhone);
$listingWebsite = $listingFields['website'];
$websitePretty = preg_replace("(^https?://)", "", $listingWebsite );
$listingEmail = $listingFields['email'];
$listingDescription = $listingFields['businessdescription'];
$listingImg = $listingFields['listingimg'];
$listingImgalt = $listingFields['listingimgalt'];
$listingFacebook = $listingFields['facebook'];
$listingGoogle = $listingFields['googleplus'];
$listingYelp = $listingFields['yelp'];
$listingTwitter = $listingFields['twitter'];
$listingLinkedin = $listingFields['linkedin'];

$listingTerms = get_the_terms( $post->ID, 'listing-category' );
$listingTags = get_the_tags();
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
            <a class="dk_webaddress" href="<?php echo $listingWebsite; ?>" target="_blank"><?php echo $websitePretty; ?></a>
            <address><?php echo $listingAddress; ?></address>
            <div class="dk_business_details">
                <a href="mailto:<?php echo $listingEmail; ?>"><?php echo $listingEmail; ?></a>
                <a href="tel:+1<?php echo $cleanPhone; ?>"><?php echo $listingPhone; ?></a>
                <div class="dk_social">
                    <?php if($listingFacebook != '') { ?>
                        <a class="dk_facebook" href="<?php echo $listingFacebook; ?>" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                    <?php } ?>
                    <?php if($listingGoogle != '') { ?>
                        <a class="dk_google" href="<?php echo $listingGoogle; ?>" target="_blank"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
                    <?php } ?>
                    <?php if($listingYelp != '') { ?>
                        <a class="dk_yelp" href="<?php echo $listingYelp; ?>" target="_blank"><i class="fa fa-yelp" aria-hidden="true"></i></a>
                    <?php } ?>
                    <?php if($listingTwitter != '') { ?>
                        <a class="dk_twitter" href="<?php echo $listingTwitter; ?>" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                    <?php } ?>
                    <?php if($listingLinkedin != '') { ?>
                        <a class="dk_linkedin" href="<?php echo $listingLinkedin; ?>" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                    <?php } ?>
                </div>
            </div>
            <p class="dk_businessdescription">
                <?php echo $listingDescription; ?>
            </p>
            <p class="dk_cattags">
                <?php if($listingTerms) { ?>
                    <strong>Listed Under: </strong>
                    <?php
                    $numTerms = count($listingTerms);
                    $i = 0;
                    foreach ($listingTerms as $term) {
                        if( ++$i === $numTerms) {
                            echo '<a href="'.$customURL.$term->slug.'">'.$term->name.'</a>';
                        } else {
                            echo '<a href="'.$customURL.$term->slug.'">'.$term->name.'</a>'.', ';
                        }
                    }
                    echo '<br>';
                } ?>
                <?php if($listingTags) { ?>
                    <strong>Tags: </strong>
                    <?php
                    $numTags = count($listingTags);
                    $i = 0;
                    foreach ($listingTags as $tag) {
                        if( ++$i === $numTags) {
                            echo $tag->name;
                        } else {
                            echo $tag->name . ', ';
                        }
                    }
                } ?>
            </p>
        </div>
    </div>
</div>
