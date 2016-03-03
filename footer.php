<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package CpPress_Sipmle_Blog_Theme
 */

?>
		</div>
		<?php get_template_part('template-parts/footer-widgets'); ?>
		<div class="copyright">
      <div class="container">
        <div class="row">
          <div class="col-md-12"><a href="#page-top" class="btn btn-secondary scrolltop btn-scrolltop"><i class="fa fa-chevron-up"></i></a></div>
        </div>
        <div class="row">
          <div class="col-md-6 col-sm-6 copyright-left">
            <p>Published on Creative Commons.</p>
          </div>
          <div class="col-md-6 col-sm-6 copyright-right">
            <p>Develped by <strong><a href="http://www.commonhelp.it" target="_blank">Commonhelp.</a></strong></p>
          </div>
        </div>
      </div>
    </div>
    <div class="navbar-secondary navbar-secondary-hide">
	    <nav class="navbar navbar-default" role="navigation">
				<div class="container-fluid">
					<!-- Brand and toggle get grouped for better mobile display -->
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="<?php echo home_url(); ?>"><img src="<?php echo get_stylesheet_directory_uri()?>/img/logo.png" alt="logo"></a>
					</div>
					<?php get_template_part('template-parts/secondary-navigation'); ?>
				</div><!-- /.container-fluid -->
			</nav>
		</div>
<?php wp_footer(); ?>

</body>
</html>
