<?php 

use CpPress\Application\WP\Theme\Menu;
use CpPressSimpleBlog\Walker\SimpleBlogWalker;


$menu = new Menu('primary', '', new SimpleBlogWalker());
$menu->setShowOption(
		'items_wrap',
		apply_filters("cppress_theme_menu_items_wrap",'<ul class="nav navbar-nav navbar-right">%3$s</ul>')
);

?>
<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
<?php echo $menu->show(); ?>						
</div><!-- /.navbar-collapse -->