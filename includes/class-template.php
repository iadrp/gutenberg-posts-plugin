<?php
/**
 * Gutenberg Template example
 *
 * @package  Gutenberg Posts Block
 * @author   Adrian P
 */

namespace Gutenberg_Custom_Blocks\Includes;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Handle Gutenberg template for custom post type
 *
 * @class Gutenberg_Custom_Blocks\Includes\Temmplate
 * @since 1.0.0
 */
class Template {

	/**
	 * Initialization
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function __construct() {

		register_activation_hook( GPB_FILE, [ $this, 'rewrite_flush' ] );
		add_action( 'init', [ $this, 'register_post_type' ] );

	}

	/**
	 * Flushing rewrite on activation
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function rewrite_flush() {

		$this->register_post_type();
		flush_rewrite_rules();

	}

	/**
	 * Register post type for the template example
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function register_post_type() {

		// Custom post type arguments.
		$args = [
			'public'        => true,
			'show_in_rest'  => true,
			'label'         => __( 'Gutenberg templates', 'gutenberg-posts-block' ),
			'rest_base'     => 'GPB-templates',
			// Add blocks to the template.
			'template'      => $this->template_blocks(),
			// Lock the template to prevent adding new blocks.
			'template_lock' => 'all',
			// Add editor support at least.
			'supports'      => [
				'title',
				'editor',
			],
		];

		// Register GPB-template custom post type.
		register_post_type( 'GPB-template', $args );

	}

	/**
	 * Blocks template
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function template_blocks() {

		return [
			// Image block.
			[
				'core/image',
			],
			// Paragraph block.
			[
				'core/paragraph',
				[
					'placeholder' => __( 'Add Description...', 'gutenberg-posts-block' ),
				],
			],
			// List block.
			[
				'core/list',
				[
					'align' => 'left',
				],
			],
		];

	}
}
