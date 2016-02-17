<?php
/**
 * @link              http://averta.net
 * @since             1.0.0
 * @package           averta-maintenance
 *
 * */
class Avma_Maintenance_Temp {

    protected $avma_slug;
	private static $instance;
	protected $templates;

	/**
	 * Returns an instance of this class. An implementation of the singleton design pattern.
	 */
	public static function get_instance() {
		if( null == self::$instance ) {
			self::$instance = new Avma_Maintenance_Temp();
		} 
		return self::$instance;
	} 

	/**
	 * Initializes the plugin by setting localization, filters, and administration functions.
	 */
	private function __construct() {
		$this->templates = array();
		add_filter('page_attributes_dropdown_pages_args', array( $this, 'register_project_templates' ) );
		add_filter('wp_insert_post_data', array( $this, 'register_project_templates' ) );
		add_filter('template_include', array( $this, 'view_project_template') );
				register_deactivation_hook( __FILE__, array( $this, 'deactivate' ) );
				$this->templates = array(
					'avma-template.php'     => __( 'Averta Coming Soon!', $this->avma_slug )
				);
			$templates = wp_get_theme()->get_page_templates();
			$templates = array_merge( $templates, $this->templates );
	} 

	/**
	 * Adds our template to the pages cache in order to trick WordPress
	 * into thinking the template file exists where it doens't really exist.
	 */
	public function register_project_templates( $atts ) {
		$cache_key = 'page_templates-' . md5( get_theme_root() . '/' . get_stylesheet() );
		$templates = wp_cache_get( $cache_key, 'themes' );
			if ( empty( $templates ) ) {
				$templates = array();
			} 
				wp_cache_delete( $cache_key , 'themes');
				$templates = array_merge( $templates, $this->templates );
				wp_cache_add( $cache_key, $templates, 'themes', 1800 );
				return $atts;
	} 

	/**
	 * Checks if the template is assigned to the page
	 */
	public function view_project_template( $template ) {
		global $post;
		if ( !isset( $post ) ) return $template;
			if ( ! isset( $this->templates[ get_post_meta( $post->ID, '_wp_page_template', true ) ] ) ) {
				return $template;
			}
			$file = AVMA_DIR . 'templates/' . get_post_meta( $post->ID, '_wp_page_template', true );
			if( file_exists( $file ) ) {
				return $file;
			}
			return $template;
	} 

	/**
	 * Delete Templates from Theme
	 */
	public function delete_template( $filename ){				
		$theme_path = get_template_directory();
		$template_path = $theme_path . '/' . $filename;  
		if( file_exists( $template_path ) ) {
			unlink( $template_path );
		}
		wp_cache_delete( $cache_key , 'themes');
	}

	/**
	 * Retrieves and returns the slug of this plugin.
	 */
	public function get_locale() {
		return $this->avma_slug;
	} 
}