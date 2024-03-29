<?php
/**
 * Plugin Name:       Example Post Meta
 * Description:       Example block scaffolded with Create Block tool.
 * Requires at least: 6.1
 * Requires PHP:      8.0
 * Version:           0.1.0
 * Author:            The WordPress Contributors
 * License:           GPL-3.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain:       example-post-meta
 *
 * @package           create-block
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */
function example_post_meta_block_init() {
	register_block_type( __DIR__ . '/build' );
}
add_action( 'init', 'example_post_meta_block_init' );


/**
 * Registers the meta key for REST API usage in the Block Editor.
 *
 * @see https://developer.wordpress.org/reference/functions/register_meta/
 */
function example_post_meta_register_meta() {

	register_meta ('post', 'your_meta_key', array(
		'show_in_rest' => true,
		'type' => 'string',
		'single' => true,
		'sanitize_callback' => 'sanitize_text_field',
		'auth_callback' => function() { 
			return current_user_can( 'edit_posts' );
		}
	));
}
add_action( 'init', 'example_post_meta_register_meta' );
