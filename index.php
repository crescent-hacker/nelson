<?php
/**
 * Front to the WordPress application. This file doesn't do anything, but loads
 * wp-blog-header.php which does and tells WordPress to load the theme.
 *
 * @package WordPress
 */

/**
 * Tells WordPress to load the WordPress theme and output it.
 *
 * @var bool
 */
define('WP_USE_THEMES', true);
if(ereg('gzip',$_SERVER['HTTP_ACCEPT_ENCODING'])){
if(substr($_SERVER['REQUEST_URI'],0,10)!='/wp-content/uploads/')ob_start('ob_gzhandler');
}
require( dirname( __FILE__ ) . '/wp-blog-header.php' );
