<?php
namespace CpPressSimpleBlog\Filter;

use CpPress\Application\WP\Hook\Filter;
use CpPress\CpPress;

class WidgetsFilter extends Filter{
	
	private static $instance = null;
	
	public static function add(){
		if(is_null(self::$instance)){
			self::$instance = new static(CpPress::$App);
		}
		
		self::$instance->register('cppress_widget_slider_id', function($id){
			return 'home-slider';
		});
		
		self::$instance->register('cppress_widget_the_title', function($the_title, $title){
			return self::$instance->theTitle($the_title, $title);
		}, 9, 2);
		
		self::$instance->register('cppresss_widget_socialbutton_container_open', function($open){
			return self::$instance->wrapSocialButtons(true);
		});
		
		self::$instance->register('cppress_widget_socialbutton_container_close', function($close){
			return self::$instance->wrapSocialButtons(false);
		});
		
		self::$instance->register('cppress_widget_socialbutton_before', function($before){
			return self::$instance->wrapSocialButton(true);
		});
		
		self::$instance->register('cppress_widget_socialbutton_after', function($after){
			return self::$instance->wrapSocialButton(false);
		});
		
		self::$instance->register('cppress_widget_socialbutton_icon_classes', function($classes, $title, $network){
			return array('fa', 'fa-' . $network['icon']);
		}, 10, 3);
		
		self::$instance->execAll();
	}
	
	public function wrapSocialButtons($isBefore){
		if($isBefore){
			return '<ul class="social-icon">';
		}
		return '</ul>';
	}
	
	public function wrapSocialButton($isBefore){
		if($isBefore){
			return '<li>';
		}
		
		return '</li>';
	}
	
	
	public function theTitle($the_title, $title){
		if(strtolower($title) == 'stamp social' ||
				strtolower($title) == 'in collaborazione con' ||
				strtolower($title) == 'contattaci'){
			return '<div class="widget-title"><h3>' . $title . '</h3></div>';
		}
		return $the_title;
	}
	
	
	
}