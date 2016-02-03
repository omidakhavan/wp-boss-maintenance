<?php
/**
 * @link              http://averta.net
 * @since             1.0.0
 * @package           averta-maintenance
 *
 * */

/**
 * Enqueue countdown script 
 */
add_action( 'admin_enqueue_scripts', 'avma_scripts' ) ;
add_action( 'wp_enqueue_scripts', 'avma_scripts' ) ;
function avma_scripts () {
	wp_enqueue_script( "jquery" ) ;
	wp_enqueue_script( 'avma_script_js', AVMA_URL.'/public/js/avma-maintenance-js.js', array(), '1.0.0' , true );

}
/**
 * get option from setting page
 * @param  [type] $option  [description]
 * @param  [type] $section [description]
 * @param  string $default [description]
 * @return [type]          [description]
 */
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
		$avma_result_exclude = explode( '|', $avma_exclude );
	    $avma_costum_redirect = avma_get_option ( 'avma_redirect', 'general_tab' );
		$avma_activation      = avma_get_option ( 'avma_active', 'general_tab'   );
		$avma_exclude         = avma_get_option ( 'avma_exclude', 'general_tab'  );
		if  ( $avma_activation == 'on' &&  $avma_costum_redirect != "" ) {
	            if( !is_admin() && !is_super_admin() && !preg_match("/login|admin|$avma_result_exclude|dashboard|account/i",$_SERVER['REQUEST_URI']) > 0){
	            	wp_redirect( $avma_costum_redirect  ) ;
				}
	    } elseif ( $avma_activation == 'on' &&  $avma_costum_redirect == "" ) {
            if( !is_admin() && !is_super_admin() && !preg_match("/login|admin|dashboard|$avma_result_exclude|account/i",$_SERVER['REQUEST_URI']) > 0){
              	apply_filters( 'avma_change_temp', $redirect_url =  AVMA_DIR . 'templates/avma-template.php' );
				include( $redirect_url );
				exit();

	        }
	    }      
	}
}


/**
 * Admin Notice Message
 */
add_action( 'admin_notices', 'avma_carefull_msg' );
if ( !function_exists( 'avma_carefull_msg' ) ) {
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
}

/**
 *  CountDown Calculation 
 */
add_action( 'admin_footer', 'avma_count_down' );
add_action( 'wp_head', 'avma_count_down' );
if ( !function_exists( 'avma_count_down' ) ) {
	function avma_count_down (){
			$avma_count_date = avma_get_option ( 'avma_start_date', 'general_tab' );
			wp_localize_script( 'avma_script_js', 'avma' , $json = 
				array(
				'avma_date' => $avma_count_date
				));
	}
}

/**
 * Background Image 
 */
add_action( 'admin_footer', 'avma_bg' );
if ( !function_exists( 'avma_bg' ) ) {
	function avma_bg () {
		$avma_bg = avma_get_option ( 'avma_bg' , 'design_tab' );
		if ( !empty( $avma_bg ) ) {
		echo $avma_bg ;			
		}
	}
}

/**
 * Page Title 
 */
add_action( 'admin_footer', 'avma_page_title' );
if ( !function_exists( 'avma_page_title' ) ) {
	function avma_page_title () {
		$avma_page_title = avma_get_option ( 'avma_page_title' , 'design_tab' );
		if ( !empty( $avma_page_title ) ) {
		 $avma_page_title ;	
		 }else{
		 $avma_page_title = get_bloginfo();
		 }		
	}
}

/**
 * Template Header Title 
 */
add_action( 'admin_footer', 'avma_content_title' );
if ( !function_exists( 'avma_content_title' ) ) {
	function avma_content_title () {
		$avma_content_title = avma_get_option ( 'avma_content_title' , 'design_tab' );
		if ( !empty( $avma_content_title ) ) {
		 _e( $avma_content_title, 'averta-maintenance' ) ;	
		 }else{
		 $avma_content_title = _e( 'Coming Soon...', 'averta-maintenance' );
		 }		
	}
}

add_action( 'admin_footer', 'avma_describ' );
if ( !function_exists( 'avma_describ' ) ) {
	function avma_describ () {
		$avma_describ = avma_get_option ( 'avma_describ' , 'design_tab' );
		if ( !empty( $avma_describ ) ) {
		 _e( $avma_describ, 'averta-maintenance' ) ;	
		 }else{
		 return ;
		 }		
	}
}




?>
