<?php
/**
 * Preview Posts Everywhere
 *
 *
 * @package   Preview Posts Everywhere
 * @author    Pawel Wawrzyniak <sensei@wpsamurai.pl>
 * @license   GPL-2.0+
 * @link      http://wpsamurai.pl
 * @copyright 2013 Pawel Wawrzyniak
 *
 * @wordpress-plugin
 * Plugin Name: Preview Posts Everywhere
 * Plugin URI:  http://wpsamurai.pl/preview-posts-everywhere
 * Description: This plugin will allow you to preview your drafts on home, category, archive and search pages (and in many other places).
 * Version:     1.0.1
 * Author:      Pawel Wawrzyniak (WPSamurai.pl)
 * Author URI:  http://wpsamurai.pl
 * Text Domain: wpsam-pde
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path: /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

require_once( plugin_dir_path( __FILE__ ) . 'wpsam-ppe-functions.php' );
require_once( plugin_dir_path( __FILE__ ) . 'class-wpsam-ppe-settings.php' );
require_once( plugin_dir_path( __FILE__ ) . 'class-wpsam-ppe.php' );

register_activation_hook( __FILE__, array( 'Wpsam_Ppe_Settings', 'activate' ) );

add_action( 'plugins_loaded', array( 'Wpsam_Ppe_Settings', 'get_instance' ) );
add_action( 'plugins_loaded', array( 'Wpsam_Ppe', 'get_instance' ) );
