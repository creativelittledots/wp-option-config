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
	
	public static function init() {
		
		return new static();
		
	}
	
	public function __construct() {
		
		if( ! defined( 'CONFIG_PATH' ) ) {

			define( 'CONFIG_PATH', ABSPATH . 'config.php' );
			
		}
		
		if( file_exists( CONFIG_PATH ) ) {
			
			static::$config = include CONFIG_PATH;
			
			add_filter( 'all', function($value) { 
				
				if( count( func_get_args() ) == 2 ) {
				
					list($value, $key) = func_get_args();
					
					if ( is_string( $key ) && strpos( $key, 'pre_option_' ) !== false ) {
			
						return static::get($key, $value); 
						
					}
					
				}
				
				return $value;
			
			}, 10, 2 );
			
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