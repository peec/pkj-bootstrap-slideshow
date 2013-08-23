<?php
/**
 * 
 * Add bootstrap slideshow to your template. ( Template requires a small modification ).
 * 
 * @package   PKJ - Locations
 * @author    Petter Kjelkenes <kjelkenes@gmail.com>
 * @license   LGPL
 * @link      http://pkj.no
 * @copyright 2013 Petter Kjelkenes ENK
 *
 * @wordpress-plugin
 * Plugin Name: PKJ - Bootstrap Slideshow
 * Plugin URI:  http://pkj.no/plugins/pkj-bootstrap-slideshow
 * Description: Add bootstrap slideshow to your template. ( Template requires a small modification ).
 * Version:     1.0.0
 * Author:      Petter Kjelkenes ENK
 * Author URI:  http://pkj.no
 * Text Domain: PkjBSSlide
 * License:     LGPL
 */

add_filter( 'pkj-base-loaded', function () {

	$name = "PKJ - Locations";
	$ns = 'PkjBSSlide';
	$dependencies =array('PkjCore');
	
	// -- Bootstrap --
	if (class_exists('PkjCore')) {
		require dirname(__FILE__) . "/lib/$ns.php";
		$pkjCore = PkjCore::getInstance();
		$pkjCore->registerChild(new $ns(
				__DIR__,
				$ns,
				// Dependencies
				$dependencies
		));
	} else {
		add_action( 'admin_notices', function () use ($name) {
			echo sprintf('<div class="error"><p>PKJ - Core plugin is needed for %s</p></div>', $name);
		});
	}

});