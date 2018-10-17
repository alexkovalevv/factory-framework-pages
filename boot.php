<?php
	/**
	 * Factory Pages
	 *
	 * @author Alex Kovalev <alex.kovalevv@gmail.com>
	 * @copyright (c) 2018, Webcraftic Ltd
	 *
	 * @package core
	 * @since 1.0.1
	 */

	// Exit if accessed directly
	if( !defined('ABSPATH') ) {
		exit;
	}

	// module provides function only for the admin area
	if( !is_admin() ) {
		return;
	}

	if( defined('FACTORY_PAGES_000_LOADED') ) {
		return;
	}

	define('FACTORY_PAGES_000_LOADED', true);

	define('FACTORY_PAGES_000_VERSION', '4.0.9');

	define('FACTORY_PAGES_000_DIR', dirname(__FILE__));
	define('FACTORY_PAGES_000_URL', plugins_url(null, __FILE__));

	if( !defined('FACTORY_FLAT_ADMIN') ) {
		define('FACTORY_FLAT_ADMIN', true);
	}

	load_plugin_textdomain('wbcr_factory_pages_000', false, dirname(plugin_basename(__FILE__)) . '/langs');

	require(FACTORY_PAGES_000_DIR . '/pages.php');
	require(FACTORY_PAGES_000_DIR . '/includes/page.class.php');
	require(FACTORY_PAGES_000_DIR . '/includes/admin-page.class.php');
	require(FACTORY_PAGES_000_DIR . '/templates/impressive-page.class.php');

