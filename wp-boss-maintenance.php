<?php

/**
 * @link              http://omidakhavan.ir
 * @since             1.0.1
 * @package           boss-maintenance
 *
 * Plugin Name:       Wp Boss Maintenance 
 * Description:       Create Comming Soon Page In WordPress Like A BOSS.
 * Version:           1.0.1
 * Author:            Omid Akhavan
 * Author URI:        http://omidakhavan.ir
 * Text Domain:       bsscommingsoon
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}
/**
 * Define Some Var
 */
define( 'hdm_VER', '1.0.1' );
define( 'hdm_DIR', plugin_dir_path(  __FILE__  ));
define( 'hdm_URL', plugins_url( '' , __FILE__ ));
/**
 * The code that runs during plugin activation.
 * This action is documented in includes/plugin-name-activator.php
 */
function hdm_activate() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/hdm-maintenance-activator.php';
	hdm_Meitenance_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/plugin-name-deactivator.php
 */
function hdm_deactive() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/hdm-maintenance-deactivator.php';
	hdm_Maintenance_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'hdm_activate' );
register_deactivation_hook( __FILE__, 'hdm_deactive' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/hdm-maintenance.php';

/**
 * Begins execution of the plugin.
 *
 * @since    1.0.0
 */
function run_hdm_maintenance() {

	$plugin = new hdm_Maintenance();
	$plugin->run();

}
run_hdm_maintenance();
