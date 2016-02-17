<?php

/**
 * @link              http://averta.net
 * @since             1.0.0
 * @package           averta-maintenance
 *
 * Plugin Name:       averta maintenance 
 * Description:       Comming Soon And Maintenace Page For Wordpress With Usefull Options.
 * Version:           1.0.0
 * Author:            Averta
 * Author URI:        http://averta.net.com/
 * Text Domain:       avla_maintenance
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}
/**
 * Define Some Var
 */
define( 'AVMA_VER', '1.0.0' );
define( 'AVMA_DIR', plugin_dir_path(  __FILE__  ));
define( 'AVMA_URL', plugins_url( '' , __FILE__ ));
/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-plugin-name-activator.php
 */
function avma_activate() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-avma-maintenance-activator.php';
	Avma_Meitenance_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-plugin-name-deactivator.php
 */
function avma_deactive() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-avma-maintenance-deactivator.php';
	Avma_Maintenance_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'avma_activate' );
register_deactivation_hook( __FILE__, 'avma_deactive' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-avma-maintenance.php';

/**
 * Begins execution of the plugin.
 *
 * @since    1.0.0
 */
function run_avma_maintenance() {

	$plugin = new Avma_Maintenance();
	$plugin->run();

}
run_avma_maintenance();
