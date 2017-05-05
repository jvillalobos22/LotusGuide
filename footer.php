				<footer class="footer dk_footer" role="contentinfo">
					<div id="inner-footer" class="row dk_footer_inner">

						<!--<nav role="navigation">
    						<?php //joints_footer_links(); ?>
    					</nav>-->
						<div class="large-12 columns">
							<a href="#"><img class="dk_logo" src="<?php echo get_template_directory_uri(); ?>/assets/images/lotus-guide-logo.png" alt="Lotus Guide Logo"></a>
							<p class="source-org copyright">&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All Rights Reserved. Site&nbsp;by&nbsp;<a href="https://www.dkwebdesign.com" rel="nofollow" target="_blank">Dk&nbsp;Web&nbsp;Design</a>.</p>
						</div>
					</div> <!-- end #inner-footer -->
				</footer> <!-- end .footer -->
			</div>  <!-- end .main-content -->
		</div> <!-- end .off-canvas-wrapper -->
		<script>
			jQuery(document).ready(function($) {
				$('.dk_homeslider').unslider({
					autoplay: true,
					delay: 6000,
					nav: true,
					arrows: false
				});
			});
		</script>
		<script src="https://use.fontawesome.com/1b6c5f7bcd.js"></script>
		<?php wp_footer(); ?>
	</body>
</html> <!-- end page -->
