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

// functions.php

function crear_cpt_propiedades()
{
	$labels = array(
		'name'                  => _x('Propiedades', 'Post Type General Name', 'text_domain'),
		'singular_name'         => _x('Propiedad', 'Post Type Singular Name', 'text_domain'),
		'menu_name'             => __('Propiedades', 'text_domain'),
		'name_admin_bar'        => __('Propiedad', 'text_domain'),
	);
	$args = array(
		'label'                 => __('Propiedad', 'text_domain'),
		'description'           => __('Propiedades de la corredora', 'text_domain'),
		'labels'                => $labels,
		'supports'              => array('title', 'editor', 'thumbnail'), // Título, descripción y foto destacada
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-admin-home', // Ícono
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
	);
	register_post_type('propiedad', $args);
}
add_action('init', 'crear_cpt_propiedades', 0);

// functions.php

function registrar_taxonomias_propiedades()
{

	// TAXONOMÍA: TIPO DE OPERACIÓN (Venta, Arriendo)
	$labels_operacion = array(
		'name'              => _x('Tipos de Operación', 'taxonomy general name'),
		'singular_name'     => _x('Tipo de Operación', 'taxonomy singular name'),
		'search_items'      => __('Buscar Tipos de Operación'),
		'all_items'         => __('Todos los Tipos'),
		'parent_item'       => __('Tipo Padre'),
		'parent_item_colon' => __('Tipo Padre:'),
		'edit_item'         => __('Editar Tipo de Operación'),
		'update_item'       => __('Actualizar Tipo de Operación'),
		'add_new_item'      => __('Añadir Nuevo Tipo de Operación'),
		'new_item_name'     => __('Nuevo Tipo de Operación'),
		'menu_name'         => __('Tipo de Operación'),
	);
	$args_operacion = array(
		'hierarchical'      => true, // Como categorías (pueden tener jerarquía)
		'labels'            => $labels_operacion,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array('slug' => 'operacion'), // URL amigable: /operacion/venta/
	);
	register_taxonomy('tipo_operacion', array('propiedad'), $args_operacion);


	// TAXONOMÍA: TIPO DE PROPIEDAD (Casa, Departamento)
	$labels_tipo = array(
		'name'              => _x('Tipos de Propiedad', 'taxonomy general name'),
		'singular_name'     => _x('Tipo de Propiedad', 'taxonomy singular name'),
		'search_items'      => __('Buscar Tipos de Propiedad'),
		'all_items'         => __('Todos los Tipos'),
		'parent_item'       => null, // No jerárquica
		'parent_item_colon' => null,
		'edit_item'         => __('Editar Tipo de Propiedad'),
		'update_item'       => __('Actualizar Tipo de Propiedad'),
		'add_new_item'      => __('Añadir Nuevo Tipo de Propiedad'),
		'new_item_name'     => __('Nuevo Tipo de Propiedad'),
		'menu_name'         => __('Tipo de Propiedad'),
	);
	$args_tipo = array(
		'hierarchical'      => false, // Como etiquetas (no jerárquica)
		'labels'            => $labels_tipo,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array('slug' => 'tipo-propiedad'), // URL: /tipo-propiedad/casa/
	);
	register_taxonomy('tipo_propiedad', array('propiedad'), $args_tipo);


	// TAXONOMÍA: ESTADO (En Venta, Vendida, etc.)
	$labels_estado = array(
		'name'              => _x('Estados', 'taxonomy general name'),
		'singular_name'     => _x('Estado', 'taxonomy singular name'),
		'search_items'      => __('Buscar Estados'),
		'all_items'         => __('Todos los Estados'),
		'edit_item'         => __('Editar Estado'),
		'update_item'       => __('Actualizar Estado'),
		'add_new_item'      => __('Añadir Nuevo Estado'),
		'new_item_name'     => __('Nuevo Estado'),
		'menu_name'         => __('Estado de la Propiedad'),
	);
	$args_estado = array(
		'hierarchical'      => true,
		'labels'            => $labels_estado,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array('slug' => 'estado'), // URL: /estado/en-venta/
	);
	register_taxonomy('estado_propiedad', array('propiedad'), $args_estado);
}
add_action('init', 'registrar_taxonomias_propiedades');
