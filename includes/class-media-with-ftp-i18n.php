<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://oberonlai.blog
 * @since      1.0.0
 *
 * @package    Media_With_Ftp
 * @subpackage Media_With_Ftp/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Media_With_Ftp
 * @subpackage Media_With_Ftp/includes
 * @author     Pontus Abrahamsson / Oberon Lai <m615926@gmail.com>
 */
class Media_With_Ftp_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'media-with-ftp',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
