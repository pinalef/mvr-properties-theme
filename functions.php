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

// ==============================================================================
// 🛑 CONSOLIDACIÓN DE ASSETS (CSS Y JS) DEL TEMA HIJO
// Ruta corregida: /js/theme.min.js
// ==============================================================================
function child_theme_assets()
{

	// 1. DEQUEUE: Desactivar los estilos y scripts del tema PADRE (UnderStrap) para evitar conflictos.
	wp_dequeue_style('understrap-styles');
	wp_deregister_style('understrap-styles');
	wp_dequeue_script('understrap-scripts');
	wp_deregister_script('understrap-scripts');

	// 2. ENQUEUE CSS: Cargar el CSS compilado del hijo (theme.min.css)
	// Asumimos que el CSS sigue estando en /dist/css/theme.min.css o ajusta la ruta si es necesario.
	$css_path = '/dist/css/theme.min.css';
	$css_ver = file_exists(get_stylesheet_directory() . $css_path) ? filemtime(get_stylesheet_directory() . $css_path) : '1.0.0';

	wp_enqueue_style(
		'child-theme-compiled-css',
		get_stylesheet_directory_uri() . $css_path,
		array(),
		$css_ver
	);

	// 3. ENQUEUE JS: Cargar el JavaScript compilado del hijo (theme.min.js, que incluye Bootstrap)
	// 🛑 RUTA CORREGIDA: Buscamos en /js/ para coincidir con la salida de tu compilación local.
	$js_path = '/js/theme.min.js';
	$js_ver = '1.0.0'; // Versión fija para asegurar que el PHP no falle si el archivo no existe.

	// CRÍTICO: El JS debe depender de jQuery y cargarse en el footer para Bootstrap
	wp_enqueue_script(
		'child-bootstrap-js',
		get_stylesheet_directory_uri() . $js_path,
		array('jquery'),
		$js_ver,
		true
	);

	// 4. Cargar Bootstrap Icons (CDN)
	wp_enqueue_style(
		'bootstrap-icons-cdn',
		'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css',
		[],
		null
	);

	// 1. Cargar CSS de Swiper desde CDN
	wp_enqueue_style(
		'swiper-css',
		'https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.css',
		array(),
		'12.0.3'
	);

	// 6. Cargar CSS Personalizado para la galería (DESPUÉS del CSS base de Swiper)
	$css_custom_path = '/css/swiper-custom.css';
	$css_custom_ver = '1.0.3'; // Usamos una versión nueva para forzar la recarga

	wp_enqueue_style(
		'swiper-custom-css',
		get_stylesheet_directory_uri() . $css_custom_path,
		array('swiper-css'), // Dependencia CRÍTICA: se carga después de Swiper CSS
		$css_custom_ver
	);
	// ---------------------------------------------------------------------
	// FIN SWIPER ASSETS
	// ---------------------------------------------------------------------

	// 2. Cargar JS de Swiper desde CDN
	wp_enqueue_script(
		'swiper-js',
		'https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.js',
		array('jquery'),
		'12.0.3',
		true // Cargar en el footer
	);

	// 3. Cargar Script de Inicialización (asumiendo que está en /js/swiper-init.js)
	$js_path = '/js/swiper-init.js';
	$js_ver = file_exists(get_stylesheet_directory() . $js_path) ? filemtime(get_stylesheet_directory() . $js_path) : '1.0.0';

	wp_enqueue_script(
		'swiper-init',
		get_stylesheet_directory_uri() . $js_path,
		array('swiper-js'), // Depende de que Swiper ya se haya cargado
		$js_ver,
		true // Cargar en el footer
	);
}
// Usamos una prioridad ALTA (99) para anular la configuración del tema padre.
add_action('wp_enqueue_scripts', 'child_theme_assets', 99);


// ------------------------------------------------------------------------------
// Menús
// ------------------------------------------------------------------------------

function child_register_menus()
{
	register_nav_menus([
		'primary' => __('Primary Menu', 'child-understrap'),
	]);
}
add_action('after_setup_theme', 'child_register_menus');


function register_footer_menus()
{
	register_nav_menus(array(
		'footer-menu-rapido' => esc_html__('Menú Rápido del Footer', 'text-domain'),
		'footer-menu-legal'  => esc_html__('Menú Legal del Footer', 'text-domain'),
	));
}
add_action('after_setup_theme', 'register_footer_menus');

// ------------------------------------------------------------------------------
// CPT Propiedades
// ------------------------------------------------------------------------------

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


// ------------------------------------------------------------------------------
// Taxonomías Propiedades
// ------------------------------------------------------------------------------

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


	// TAXONOMÍA: COMUNA
	$labels_comuna = array(
		'name'              => _x('Comunas', 'taxonomy general name'),
		'singular_name'     => _x('Comuna', 'taxonomy singular name'),
		'search_items'      => __('Buscar Comunas'),
		'all_items'         => __('Todas las Comunas'),
		'parent_item'       => __('Región/Provincia'), // Pensando a futuro
		'parent_item_colon' => __('Región/Provincia:'),
		'edit_item'         => __('Editar Comuna'),
		'update_item'       => __('Actualizar Comuna'),
		'add_new_item'      => __('Añadir Nueva Comuna'),
		'new_item_name'     => __('Nueva Comuna'),
		'menu_name'         => __('Comuna'),
	);
	$args_comuna = array(
		'hierarchical'      => true, // Como categorías. Permite anidar (ej: Santiago -> Providencia)
		'labels'            => $labels_comuna,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array('slug' => 'comuna'), // URL: /comuna/providencia/
	);
	register_taxonomy('comuna', array('propiedad'), $args_comuna);
}
add_action('init', 'registrar_taxonomias_propiedades');
