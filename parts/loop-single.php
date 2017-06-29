<?php
$obj = get_queried_object();

$titleArray = str_word_count($obj->post_title, 1);
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
<article id="post-<?php the_ID(); ?>" <?php post_class('dk_post'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

	<header class="article-header">
		<h1 class="entry-title single-title" itemprop="headline"><?php echo $preTitle; ?><span><?php echo $postTitle; ?></span></h1>
		<!-- <h1 class="entry-title single-title" itemprop="headline"><?php the_title(); ?></h1> -->
		<?php get_template_part( 'parts/content', 'byline' ); ?>
    </header> <!-- end article header -->

    <section class="entry-content" itemprop="articleBody">
		<?php if(the_post_thumbnail('full')) { ?>
			<div class="dk_featuredimg">
				<?php the_post_thumbnail('full'); ?>
			</div>
		<?php } ?>

		<div class="dk_postcontent">
			<?php the_content(); ?>
		</div>
	</section> <!-- end article section -->

	<footer class="article-footer">
		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'jointswp' ), 'after'  => '</div>' ) ); ?>
		<p class="tags"><?php the_tags('<span class="tags-title">' . __( 'Tags:', 'jointswp' ) . '</span> ', ', ', ''); ?></p>
	</footer> <!-- end article footer -->

	<?php comments_template(); ?>

</article> <!-- end article -->
