<?php
namespace CpPressSimpleBlog\Filter;

use CpPress\Application\WP\Hook\Filter;
use CpPress\CpPress;

class LayoutFilter extends Filter{
	
	private static $instance = null;
	
	public static function add(){
		if(is_null(self::$instance)){
			self::$instance = new static(CpPress::$App);
		}
		
		self::$instance->register('cppress_layout_widget_before', function($before, $cell, $section){
			return self::$instance->widgetWrapper($before, $cell, $section, true);
		}, 10, 3);
		
		self::$instance->register('cppress_layout_widget_after', function($after, $cell, $section){
			return self::$instance->widgetWrapper($after, $cell, $section, false);
		}, 10, 3);
		
		self::$instance->register('cppress_layout_grid_container_open', function($open, $section){
			if($section !== 'footer'){
				return self::$instance->removeContainer();
			}
				
			return $open;
		}, 10, 2);
		
		self::$instance->register('cppress_layout_grid_container_close', function($close, $section){
			if($section !== 'footer'){
				return self::$instance->removeContainer();
			}
				
			return $close;
		}, 10, 2);
		
		self::$instance->register('the_content_more_link', function($more, $link){
			return self::$instance->more($more, $link);
		}, 10, 2);
		
		self::$instance->register('cppress_layout_cell_classes', function($classes, $id, $cell, $section){
			if($section == 'footer'){
				$small = 'col-sm-' . ($cell['weight']*2);
				$verySmall = 'col-xs-12';
				$classes[] = $small;
				$classes[] = $verySmall;
			}
			
			return $classes;
		}, 10, 4);
		
		self::$instance->register('cppress-cf-submit', function($submit, $classes){
			$pattern = '@<button type="submit" value="[^\W]+" class="([^\d]+)">([^\W]+)</button></div>@';
			if(preg_match($pattern, $submit, $matches)){
				$classes = array('btn', 'btn-secondary');
				$submitText = '<i class="fa fa-envelope-o"></i> ' . $matches[2];
				return '<div class="cppress-cf-submit">
						<button type="submit" value="' . $matches[2] . '" class="' . implode(' ', $classes) . '">' . $submitText . '</button>
					</div>';
			}
			
			return $submit;
		}, 10, 2);
	
		self::$instance->execAll();
	}
	
	public function widgetWrapper($return, $cell, $section, $isBefore){
		if($section !== 'footer'){
			if($isBefore){
				return '<div class="content-article">';
			}
			
			return '</div>';
		}
		
		if($section === 'footer'){
			if($isBefore){
				return '<div class="widget-footer">';
			}
			
			return '</div>';
		}
		return $return;
	}
	
	public function removeContainer(){
		return '';
	}
	
	public function more($more, $link){
		return '<a class="btn btn-secondary btn-sm" href="' . get_permalink() . '">Read more <i class="fa fa-angle-right"></i></a>';
	}
	
}