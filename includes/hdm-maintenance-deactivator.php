<?php

/**
 * @link              http://omidakhavan.ir
 * @since             1.0.0
 * @package           boss-maintenance
 *
 */

class hdm_Maintenance_Deactivator {

	/**
	 * @since    1.0.0
	 */
	public static function deactivate() {
		$a = get_option( 'general_tab' );
		$a['hdm_active'] = 'off' ;
		update_option('general_tab',$a );

	}

}
