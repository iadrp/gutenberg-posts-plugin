<?php
/**
 * Gutenberg Posts Block Plugin
 *
 * @package Gutenberg Posts Block
 *
 * @wordpress-plugin
 * Plugin Name:  Gutenberg Posts Block
 * Description:  Custom Posts block for Gutenberg
 * Version:      1.0.0
 * Author:       Adrian P
 * Text Domain:  gutenberg-blocks
 * Domain Path:  /languages
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'GPB_VERSION', '1.1.0' );
define( 'GPB_NAME', 'Gutenberg Posts Block' );
define( 'GPB_FILE', __FILE__ );
define( 'GPB_BASE', plugin_basename( __FILE__ ) );
define( 'GPB_PATH', plugin_dir_path( __FILE__ ) );
define( 'GPB_URL', plugin_dir_url( __FILE__ ) );
function gutenberg_posts_block_textdomain() {

	load_plugin_textdomain(
		'gutenberg-posts-block',
		false,
		basename( dirname( __FILE__ ) ) . '/languages'
	);

	// Translate Plugin Description.
	__( 'Gutenberg Posts Block', 'gutenberg-posts-block' );

}
add_action( 'plugins_loaded', 'gutenberg_posts_block_textdomain' );

// Initialize plugin.
require_once GPB_PATH . 'initialize.php';
