<?php
/**
 * Understrap Child Theme functions and definitions
 *
 * @package UnderstrapChild
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;



/**
 * Removes the parent themes stylesheet and scripts from inc/enqueue.php
 */
function understrap_remove_scripts() {
	wp_dequeue_style( 'understrap-styles' );
	wp_deregister_style( 'understrap-styles' );

	wp_dequeue_script( 'understrap-scripts' );
	wp_deregister_script( 'understrap-scripts' );
}
add_action( 'wp_enqueue_scripts', 'understrap_remove_scripts', 20 );



/**
 * Enqueue our stylesheet and javascript file
 */
function theme_enqueue_styles() {

	// Get the theme data.
	$the_theme = wp_get_theme();

	$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
	// Grab asset urls.
	$theme_styles  = "/css/child-theme{$suffix}.css";
	$theme_scripts = "/js/child-theme{$suffix}.js";

	wp_enqueue_style( 'child-understrap-styles', get_stylesheet_directory_uri() . $theme_styles, array(), $the_theme->get( 'Version' ) );
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'child-understrap-scripts', get_stylesheet_directory_uri() . $theme_scripts, array(), $the_theme->get( 'Version' ), true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );



/**
 * Load the child theme's text domain
 */
function add_child_theme_textdomain() {
	load_child_theme_textdomain( 'understrap-child', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'add_child_theme_textdomain' );



/**
 * Overrides the theme_mod to default to Bootstrap 5
 *
 * This function uses the `theme_mod_{$name}` hook and
 * can be duplicated to override other theme settings.
 *
 * @return string
 */
function understrap_default_bootstrap_version() {
	return 'bootstrap5';
}
add_filter( 'theme_mod_understrap_bootstrap_version', 'understrap_default_bootstrap_version', 20 );



/**
 * Loads javascript for showing customizer warning dialog.
 */
function understrap_child_customize_controls_js() {
	wp_enqueue_script(
		'understrap_child_customizer',
		get_stylesheet_directory_uri() . '/js/customizer-controls.js',
		array( 'customize-preview' ),
		'20130508',
		true
	);
}
add_action( 'customize_controls_enqueue_scripts', 'understrap_child_customize_controls_js' );



/**** custom functions ****/

// enqueue custom stylesheet
function bbc_stylesheet_js() {
	wp_enqueue_style( 'bbc-style', get_stylesheet_directory_uri() . '/css/bbc-style.css' );
	wp_enqueue_script( 'bbc-js', get_stylesheet_directory_uri() . '/js/bbc-js.js', array(), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'bbc_stylesheet_js' );

// enqueue admin stylesheet
add_action( 'admin_enqueue_scripts', 'load_admin_style' );
function load_admin_style() {
	wp_enqueue_style( 'bbc-style', get_stylesheet_directory_uri() . '/css/bbc-style.css' );
    wp_enqueue_style( 'admin_css', get_stylesheet_directory_uri() . '/css/bbc-admin-style.css', false, '1.0.0' );
}

// add to content
function add_global_sections($content) {
    return;
}
//add_filter('the_content', 'add_global_sections');


// Set the default color palette for certain fields
function set_acf_color_picker_default_palettes() {
	
	$primary = get_field('primary', 'style');
	$secondary = get_field('secondary', 'style');
	$accent = get_field('accent', 'style');
	$text = get_field('text', 'style');
	$light = get_field('light', 'style');
	$white = get_field('white', 'style');
	
?>
<script>
let setDefaultPalette = function() {
    acf.add_filter('color_picker_args', function( args, $field ){

        // Find the field key
        let targetFieldKey = $field[0]['dataset']['key'];

        // Set color options for the field
        // if field is accordion_icon_background_color
        if ( 'field_64371b51ab13a' === targetFieldKey ) {
            args.palettes = [ '<?php echo $primary; ?>', '<?php echo $secondary; ?>', '<?php echo $accent; ?>', '<?php echo $text; ?>', '<?php echo $light; ?>', '<?php echo $white; ?>' ];
        }

        // Return
        return args;
    });
}
setDefaultPalette();
</script>
<?php
}
add_action('acf/input/admin_footer', 'set_acf_color_picker_default_palettes');

function slug_editor_body_margin_fix( $settings ) {
	if ( isset( $settings['content_style'] ) ) {
		$settings['content_style'] .= ' body#tinymce { margin: 9px 10px; }';
	} else {
		$settings['content_style'] = 'body#tinymce { margin: 9px 10px; }';
	}
	return $settings;
}
add_filter( 'tiny_mce_before_init', 'slug_editor_body_margin_fix' );


// include separate functions files
require_once( __DIR__ . '/functions/schema.php');
require_once( __DIR__ . '/functions/root-style.php');

add_action( 'init', 'register_acf_blocks' );
function register_acf_blocks() {
    register_block_type( __DIR__ . '/global-templates/blocks/hero' );
}