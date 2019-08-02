<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://oberonlai.blog
 * @since             1.0.1
 * @package           Media_With_Ftp
 *
 * @wordpress-plugin
 * Plugin Name:       Media with FTP
 * Plugin URI:        https://oberonlai.blog/media-with-ftp/
 * Description:       Let's you upload images to ftp-server and remove the uploads in the WordPress Media Library.
 * Version:           1.0.1
 * Author:            Oberon Lai
 * Author URI:        https://oberonlai.blog
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       media-with-ftp
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

require_once plugin_dir_path( __FILE__ ) . 'vendor/autoload.php';

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'MEDIA_WITH_FTP_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-media-with-ftp-activator.php
 */
function activate_media_with_ftp() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-media-with-ftp-activator.php';
	Media_With_Ftp_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-media-with-ftp-deactivator.php
 */
function deactivate_media_with_ftp() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-media-with-ftp-deactivator.php';
	Media_With_Ftp_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_media_with_ftp' );
register_deactivation_hook( __FILE__, 'deactivate_media_with_ftp' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-media-with-ftp.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_media_with_ftp() {

	$plugin = new Media_With_Ftp();
	$plugin->run();

}
run_media_with_ftp();