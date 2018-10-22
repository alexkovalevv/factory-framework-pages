<?php
	/**
	 * A group of classes and methods to create and manage pages.
	 *
	 * @author Alex Kovalev <alex.kovalevv@gmail.com>
	 * @copyright (c) 2018, Webcraftic Ltd
	 *
	 * @package core
	 * @since 1.0.0
	 */

	// Exit if accessed directly
	if( !defined('ABSPATH') ) {
		exit;
	}

	add_action('admin_menu', 'Wbcr_FactoryPages000::actionAdminMenu');
	add_action('network_admin_menu', 'Wbcr_FactoryPages000::actionAdminMenu');

	if( !class_exists('Wbcr_FactoryPages000') ) {
		/**
		 * A base class to manage pages.
		 *
		 * @since 1.0.0
		 */
		class Wbcr_FactoryPages000 {

			/**
			 * @var Wbcr_FactoryPages000_Page[]
			 */
			private static $pages = array();
			
			/**
			 * @param Wbcr_Factory000_Plugin $plugin
			 * @param $class_name
			 */
			public static function register($plugin, $class_name)
			{
				if( !isset(self::$pages[$plugin->getPluginName()]) ) {
					self::$pages[$plugin->getPluginName()] = array();
				}
				$page = new $class_name($plugin);
				if( is_multisite() && is_network_admin() && !$page->available_for_multisite ) {
					return;
				}
				self::$pages[$plugin->getPluginName()][] = $page;
			}

			public static function actionAdminMenu()
			{
				if( empty(self::$pages) ) {
					return;
				}

				foreach(self::$pages as $plugin_pages) {
					foreach($plugin_pages as $page) {
						$page->connect();
					}
				}
			}

			/**
			 * @param Wbcr_Factory000_Plugin $plugin
			 * @return array
			 */
			public static function getIds($plugin)
			{
				if( !isset(self::$pages[$plugin->getPluginName()]) ) {
					return array();
				}

				$result = array();
				foreach(self::$pages[$plugin->getPluginName()] as $page)
					$result[] = $page->getResultId();

				return $result;
			}
		}
	}

	if( !function_exists('wbcr_factory_pages_000_get_page_id') ) {
		/**
		 *
		 * @param Wbcr_Factory000_Plugin $plugin
		 * @param string $page_id
		 * @return string
		 */
		function wbcr_factory_pages_000_get_page_id($plugin, $page_id)
		{
			return $page_id . '-' . $plugin->getPluginName();
		}
	}
