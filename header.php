<!doctype html>

  <html class="no-js"  <?php language_attributes(); ?>>

	<head>
		<meta charset="utf-8">
		<!-- Force IE to use the latest rendering engine available -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<!-- Mobile Meta -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta class="foundation-mq">
		<!-- If Site Icon isn't set in customizer -->
		<?php if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) { ?>
			<!-- Icons & Favicons -->
			<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png">
			<link href="<?php echo get_template_directory_uri(); ?>/assets/images/apple-icon-touch.png" rel="apple-touch-icon" />
			<!--[if IE]>
				<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
			<![endif]-->
			<meta name="msapplication-TileColor" content="#f01d4f">
			<meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/assets/images/win8-tile-icon.png">
	    	<meta name="theme-color" content="#121212">
	    <?php } ?>
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
		<?php wp_head(); ?>
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700" rel="stylesheet">
		<!-- Drop Google Analytics here -->
		<!-- end analytics -->

	</head>

	<!-- Uncomment this line if using the Off-Canvas Menu -->

	<body <?php body_class(); ?>>

		<div class="off-canvas-wrapper dk_bodywrapper">

			<?php get_template_part( 'parts/content', 'offcanvas' ); ?>

			<div class="off-canvas-content" data-off-canvas-content>
                <?php
                global $post;

                if(!empty($post)) {
                    $pageTemplate = get_post_meta($post->ID, '_wp_page_template', true);
                }
                //echo $pageTemplate;
                ?>
				<header class="header" role="banner">
                    <?php
                    $post_type = get_post_type();
                    // echo '<code>Post Type = '.$post_type.'</code>';
                    // echo '<code>$post->ID = '.$post->ID.'</code>';
                    ?>
                    <div class="row dk_header_row">
                        <div class="dk_logo"><a href="<?php echo get_home_url(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/lotus-guide-logo.png" alt="Lotus Guide Logo"></a></div>
                        <div class="dk_header_contact">
                            <div class="dk_headerphone">
                                <a href="tel:+15308948433">530-894-8433</a> | <a href="tel:+15308948433">530-89-GUIDE</a>
                            </div>
                            <div class="dk_headersocial">
                                <a class="dk_facebook" href="<?php echo get_option('facebook_link') ?>" target="_blank">
                                    <i class="fa fa-facebook" aria-hidden="true"></i>
                                </a>
                                <a class="dk_youtube" href="<?php echo get_option('youtube_link') ?>" target="_blank">
                                    <i class="fa fa-youtube" aria-hidden="true"></i>
                                </a>
                                <a class="dk_twitter" href="<?php echo get_option('twitter_link') ?>" target="_blank">
                                    <i class="fa fa-twitter" aria-hidden="true"></i>
                                </a>
                                <a class="dk_googleplus" href="<?php echo get_option('google_plus_link') ?>" target="_blank">
                                    <i class="fa fa-google-plus" aria-hidden="true"></i>
                                </a>
                                <a class="dk_yelp" href="<?php echo get_option('yelp_link') ?>" target="_blank">
                                    <i class="fa fa-yelp" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                    </div>
					<!-- This navs will be applied to the topbar, above all content
						  To see additional nav styles, visit the /parts directory -->
					<?php get_template_part( 'parts/nav', 'offcanvas-topbar' ); ?>

				</header> <!-- end .header -->
