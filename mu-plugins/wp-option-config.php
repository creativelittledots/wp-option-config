<?php
/*
Plugin Name: WP Option Config
Description: A Wordpress MU Plugin that checks a config file for options when calling get_option function
Author: Creative Little Dots
Version: 1.0
Author URI: https://creativelittledots.co.uk
License: GPL2
*/

namespace OptionConfig;

class Config {
	
	public static $config = [];
	public static $instance = null;
	
	public static function init() {
		
		if( ! static::$instance ) {
		
			static::$instance = new static();
			
		}
		
		return static::$instance;
		
	}
	
	public function __construct() {
		
		if( ! defined( 'CONFIG_PATH' ) ) {

			define( 'CONFIG_PATH', ABSPATH . 'config.php' );
			
		}
		
		if( file_exists( CONFIG_PATH ) ) {
			
			static::$config = include CONFIG_PATH;
			
			foreach( static::$config as $key => $value ) {
				
				add_filter( 'pre_option_' . $key, function() use($value) {
					
					return $value;
					
				} );
				
			}
			
		}
		
	}
	
	public static function get($key, $default = false) {
		
		return is_array( static::$config ) && isset( static::$config[$key] ) ? static::$config[$key] : $default;
		
	}
	
}

Config::init();

if( ! function_exists( 'config' ) ) {

	function config($key, $default = false) {
	
		return Config::get($key, $default);
	
	}

}

//echo config( 'test_option' );
