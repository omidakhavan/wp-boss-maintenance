<?php

/**
 * @link              http://averta.net
 * @since             1.0.0
 * @package           averta-maintenance
 *
 **/

class Avma_Maintenance_Admin {


	private $avma_maintenance;
	private $version;

	public function __construct( $avma_maintenance, $version ) {

		$this->avma_maintenance = $avma_maintenance;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->avma_maintenance, AVMA_URL . '/admin/css/avma_maintenance.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( $this->avma_maintenance, AVMA_URL . '/admin/js/avma.min.js', array( 'jquery' ), $this->version, false );
		

	}

}
