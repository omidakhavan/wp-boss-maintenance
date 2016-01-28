<?php
/**
 * @link              http://averta.net
 * @since             1.0.0
 * @package           averta-maintenance
 *
 * */
function avma_get_option( $option, $section, $default = '' ) {
	if ( empty( $option ) )
		return;
    $options = get_option( $section );
    if ( isset( $options[$option] ) ) {
        return $options[$option];
    }
    return $default;
}

/**
 * Redirect function
 */
add_action( 'template_redirect', 'avma_disable_wp', 9 );
if ( !function_exists( 'avma_disable_wp' ) ) {
	function avma_disable_wp ( $template) {
		$avma_activation = avma_get_option ( 'avma_active', 'general_tab' );
		$avma_exclude    = avma_get_option ( 'avma_exclude', 'general_tab' );
		if  ( $avma_activation == 'on' ) {
			//if ( !is_admin() && !is_super_admin()  ){
				//*****1 solution*****//
				// $content ="jhgggggggggggggggggggggggggggggggggggggggg";
                //wp_die($content, get_bloginfo( 'name' ) . ' - ' . __('Website Under Maintenance', 'avla-maintenance'), array('response' => '503'));
                // $t =  wp_redirect(  $redirect_url  );
				//*****2 solution*****//
				$avma_result_exclude = explode( '|', $avma_exclude );
                if( !is_admin() && !is_super_admin() && !preg_match("/login|admin|$avma_result_exclude|dashboard|account/i",$_SERVER['REQUEST_URI']) > 0){
	              	apply_filters( 'avma_change_temp', $redirect_url =  AVMA_DIR . 'templates/avma-template.php' );
					include($redirect_url);
					exit();

                }
            //}    	
		}
	}
}

/**
 * Admin Notice Message
 */
add_action( 'admin_notices', 'avma_carefull_msg' );
function avma_carefull_msg (){
	$avma_admin_notice = avma_get_option ( 'avma_notif', 'general_tab' );
	if ( $avma_admin_notice == 'on' ) {
		?>
	    <div class="updated">
	        <p><?php _e( 'Coming Soon Plugin Was Activated', 'avla-maintenance' ); ?></p>
	    </div>
	    <?php
	}
}







?>
