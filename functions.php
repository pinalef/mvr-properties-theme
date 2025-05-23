<?php

/**
 * UnderStrap functions and definitions
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

// UnderStrap's includes directory.
$understrap_inc_dir = 'inc';

// Array of files to include.
$understrap_includes = array(
	'/theme-settings.php',                  // Initialize theme default settings.
	'/setup.php',                           // Theme setup and custom theme supports.
	'/widgets.php',                         // Register widget area.
	'/enqueue.php',                         // Enqueue scripts and styles.
	'/template-tags.php',                   // Custom template tags for this theme.
	'/pagination.php',                      // Custom pagination for this theme.
	'/hooks.php',                           // Custom hooks.
	'/extras.php',                          // Custom functions that act independently of the theme templates.
	'/customizer.php',                      // Customizer additions.
	'/custom-comments.php',                 // Custom Comments file.
	'/class-wp-bootstrap-navwalker.php',    // Load custom WordPress nav walker. Trying to get deeper navigation? Check out: https://github.com/understrap/understrap/issues/567.
	'/editor.php',                          // Load Editor functions.
	'/block-editor.php',                    // Load Block Editor functions.
	'/deprecated.php',                      // Load deprecated functions.
);

// Load WooCommerce functions if WooCommerce is activated.
if (class_exists('WooCommerce')) {
	$understrap_includes[] = '/woocommerce.php';
}

// Load Jetpack compatibility file if Jetpack is activiated.
if (class_exists('Jetpack')) {
	$understrap_includes[] = '/jetpack.php';
}

// Include files.
foreach ($understrap_includes as $file) {
	require_once get_theme_file_path($understrap_inc_dir . $file);
}

add_action('wp_enqueue_scripts', 'enqueue_parent_styles');
function enqueue_parent_styles()
{
	wp_enqueue_style('understrap-styles', get_template_directory_uri() . '/css/theme.min.css');
}

//bootstrap icons
function child_understrap_enqueue_cdn_icons()
{
	wp_enqueue_style(
		'bootstrap-icons-cdn',
		'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css',
		[],
		null
	);
}
add_action('wp_enqueue_scripts', 'child_understrap_enqueue_cdn_icons');

//Menus
function child_register_menus()
{
	register_nav_menus([
		'primary' => __('Primary Menu', 'child-understrap'),
	]);
}
add_action('after_setup_theme', 'child_register_menus');


// 1) Dequeue / Deregister estilos del tema padre
function child_dequeue_parent_styles()
{
	// Bajo UnderStrap el handle suele ser 'understrap-styles'
	wp_dequeue_style('understrap-styles');
	wp_deregister_style('understrap-styles');
}
add_action('wp_enqueue_scripts', 'child_dequeue_parent_styles', 20);

// 2) Enqueue  CSS compilado del hijo (theme.min.css)
function child_enqueue_compiled_css()
{
	$ver = filemtime(get_stylesheet_directory() . '/dist/css/theme.min.css');
	wp_enqueue_style(
		'child-theme-compiled',
		get_stylesheet_directory_uri() . '/dist/css/theme.min.css',
		array(),
		$ver
	);
}
add_action('wp_enqueue_scripts', 'child_enqueue_compiled_css', 25);

// 3) Enqueue style.css al final (para overrides)
function child_enqueue_custom_css()
{
	$ver = filemtime(get_stylesheet_directory() . '/style.css');
	wp_enqueue_style(
		'child-custom-css',
		get_stylesheet_directory_uri() . '/style.css',
		array('child-theme-compiled'),
		$ver
	);
}
add_action('wp_enqueue_scripts', 'child_enqueue_custom_css', 30);
