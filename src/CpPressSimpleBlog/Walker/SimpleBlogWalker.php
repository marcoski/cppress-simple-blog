<?php
namespace CpPressSimpleBlog\Walker;

use Walker_Nav_Menu;

class SimpleBlogWalker extends Walker_Nav_Menu{

	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
		$output .= "\n" . $indent . '<ul class="dropdown-menu">' . "\n";
	}

	public function start_el(  &$output, $item, $depth = 0, $args = array(), $id = 0 ){
		$indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' );
		if($item->post_title === 'divider'){
			$output .= '<li class="divider">';
			return;
		}
		$classes = array('nav-item');
		if(in_array('current-menu-item', $item->classes)){
			$classes[] = 'active';
		}
		if(in_array('menu-item-has-children', $item->classes)){
			$classes[] = 'dropdown';
		}

		$class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item )));

		$output .= $indent . '<li id="m'. $item->ID . '" class="' . $class_names . '">';
		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
		$linkAfter = $args->link_after;
		if(in_array('menu-item-has-children', $item->classes)){
			$attributes .= ' class="dropdown-toggle"';
			$attributes .= ' data-toggle="dropdown" data-hover="dropdown" data-delay="0"';
			$attributes .= ' data-close-others="true" aria-expanded="true"';
			$linkAfter .= '<i class="fa fa-angle-down"></i>';
		}

		$item_output = sprintf( '%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s',
				$args->before,
				$attributes,
				$args->link_before,
				apply_filters( 'the_title', $item->title, $item->ID ),
				$linkAfter,
				$args->after
		);

		// build html
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
			
	}
}