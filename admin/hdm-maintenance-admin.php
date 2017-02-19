<?php

/**
 * @link              http://omidakhavan.ir
 * @since             1.0.0
 * @package           boss-maintenance
 *
 **/

class hdm_Maintenance_Admin {


	private $hdm_maintenance;
	private $version;

	public function __construct( $hdm_maintenance, $version ) {

		$this->hdm_maintenance = $hdm_maintenance;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->hdm_maintenance, hdm_URL . '/admin/css/hdm_maintenance.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( $this->hdm_maintenance, hdm_URL . '/admin/js/hdm-maintenance.min.js', array( 'jquery' ), $this->version, false );
		

	}

}
