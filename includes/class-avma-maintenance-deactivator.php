<?php

/**
 * @link              http://averta.net
 * @since             1.0.0
 * @package           averta-maintenance
 *
 */

class Avma_Maintenance_Deactivator {

	/**
	 * @since    1.0.0
	 */
	public static function deactivate() {
		$a = get_option( 'general_tab');
		$a['avma_active'] = 'off' ;
		update_option('general_tab',$a );

	}

}
