<?php
use CpPress\CpPress;
use CpPress\Application\WP\Admin\PostMeta;
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package CpPress_Sipmle_Blog_Theme
 */

$app = CpPress::$App;
$subTitle = PostMeta::find($post->ID, 'cp-press-page-subtitle');
get_header(); ?>
<div class="row">
	<div class="col-md-12">
		<div class="content-article">
			<div class="heading-title">
				<h2>
					<?php the_title('', ''); ?> 
					<?php if($subTitle != ''): ?>
						<small><?php echo $subTitle; ?></small>
					<?php endif; ?>
				</h2>
			</div>

			<div class="row">
				<div class="col-md-5 col-sm-5 hidden-xs">
				</div>
				<div class="col-md-7 col-sm-7 col-xs-12">
					<?php	$app::main('Breadcrumb', 'show', $app->getContainer(), array($post)); ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php 
	while( have_posts() ){ the_post(); }
	the_content();
?>
<?php
get_footer();
