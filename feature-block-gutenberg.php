<?php
/**
 * Plugin Name: Gutenberg Feature Block
 * Plugin URI: https://catapultthemes.com/
 * Description: Add feature blocks using Gutenberg
 * Author: Catapult Themes
 * Author URI: https://catapultthemes.com/
 * Version: 1.0.0
 * License: GPL2+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 *
 * @package Gutenberg_Feature_Blocks
 */

//  Exit if accessed directly.
defined('ABSPATH') || exit;

function gfblock_load_plugin_textdomain() {
	load_plugin_textdomain( 'gfblock', FALSE, basename( dirname( __FILE__ ) ) . '/languages/' );
}
// add_action( 'plugins_loaded', 'gfblock_load_plugin_textdomain' );

/**
 * Define constants
 **/
if ( ! defined( 'GFBLOCK_PLUGIN_URL' ) ) {
	define( 'GFBLOCK_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
}
if ( ! defined( 'GFBLOCK_PLUGIN_VERSION' ) ) {
	define( 'GFBLOCK_PLUGIN_VERSION', '1.0.0' );
}
if ( ! defined( 'GFBLOCK_PLUGIN_NAME' ) ) {
	define( 'GFBLOCK_PLUGIN_NAME', trim( dirname( plugin_basename( __FILE__ ) ), '/' ) );
}
if ( ! defined( 'GFBLOCK_PLUGIN_DIR' ) ) {
	define( 'GFBLOCK_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
}

/**
 * Enqueue the block's assets for the editor.
 *
 * `wp-blocks`: Includes block type registration and related functions.
 * `wp-element`: Includes the WordPress Element abstraction for describing the structure of your blocks.
 * `wp-i18n`: To internationalize the block's text.
 *
 * @since 1.0.0
 */
function gfblock_enqueue_block_editor_assets() {
	// Scripts.
	wp_enqueue_script(
		'gfblock-block', // Handle.
		GFBLOCK_PLUGIN_URL . 'block/block.js', // File.
		array( 'wp-blocks', 'wp-i18n', 'wp-element' ), // Dependencies.
		filemtime( GFBLOCK_PLUGIN_DIR . 'block/block.js' ) // filemtime — Gets file modification time.
	);

	// Styles.
	wp_enqueue_style(
		'gfblock-block-editor', // Handle.
		GFBLOCK_PLUGIN_URL . 'assets/css/editor.css', // File.
		array( 'wp-edit-blocks' ), // Dependency.
		filemtime( GFBLOCK_PLUGIN_DIR . 'assets/css/editor.css' ) // filemtime — Gets file modification time.
	);
}
add_action( 'enqueue_block_editor_assets', 'gfblock_enqueue_block_editor_assets' );

/**
 * Enqueue the block's assets for the frontend.
 *
 * @since 1.0.0
 */
function gfblock_enqueue_block_assets() {
	wp_enqueue_style(
		'gfblock-frontend', // Handle.
		GFBLOCK_PLUGIN_URL . 'assets/css/style.css', // File.
		array( 'wp-blocks' ), // Dependency.
		filemtime( GFBLOCK_PLUGIN_DIR . 'assets/css/style.css' ) // filemtime — Gets file modification time.
	);
}
add_action( 'enqueue_block_assets', 'gfblock_enqueue_block_assets' );
