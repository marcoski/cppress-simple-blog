<?php
$footerWidgetQuery = new WP_Query('pagename=footer-widgets');
while ( $footerWidgetQuery->have_posts() ) : $footerWidgetQuery->the_post();
	the_content();
endwhile;
wp_reset_postdata();