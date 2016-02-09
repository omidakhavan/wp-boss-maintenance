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
add_action( 'admin_init', 'avma_bg' );
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
add_action( 'admin_init', 'avma_page_title' );
if ( !function_exists( 'avma_page_title' ) ) {
	function avma_page_title () {
		$avma_page_title = avma_get_option ( 'avma_page_title' , 'design_tab' );
		if ( !empty( $avma_page_title ) ) {
		 return $avma_page_title ;	
		 }else{
		 return $avma_page_title = get_bloginfo();
		}		
	}
}

/**
 * Template Header Title 
 */
add_action( 'admin_init', 'avma_content_title' );
if ( !function_exists( 'avma_content_title' ) ) {
	function avma_content_title () {
		$avma_content_title = avma_get_option ( 'avma_content_title' , 'design_tab' );
		if ( !empty( $avma_content_title ) ) {
		 return $avma_content_title ;	
		 }else{
		  return $avma_content_title ;
		 }		
	}
}
/**
 * Maintenace Describtion OutPut
 */
add_action( 'admin_init', 'avma_describ' );
if ( !function_exists( 'avma_describ' ) ) {
	function avma_describ () {
		$avma_describ = avma_get_option ( 'avma_describ' , 'design_tab' );
		if ( !empty( $avma_describ ) ) {
		return  $avma_describ ;
		}		
	}
}

/**
 * Template Logo 
 */
add_action( 'admin_init', 'avma_logo' );
if ( !function_exists( 'avma_logo' ) ) {
	function avma_logo () {
		$avma_logo = avma_get_option ( 'avma_logo' , 'design_tab' );
		if ( !empty( $avma_logo ) ) {
		return $avma_logo ;			
		}
	}
}

/**
 * Title Color
 */
add_action( 'admin_init', 'vma_title_color' );
if ( !function_exists( 'vma_title_color' ) ) {
	function vma_title_color () {
		$vma_title_color = avma_get_option ( 'vma_title_color' , 'design_tab' );
		if ( !empty( $vma_title_color ) ) {
		return $vma_title_color ;  
		}		
	}
}

/**
 * Describtion Color
 */
add_action( 'admin_init', 'avma_body_color' );
if ( !function_exists( 'avma_body_color' ) ) {
	function avma_body_color () {
		$avma_body_color = avma_get_option ( 'avma_body_color' , 'design_tab' );
		if ( !empty( $avma_body_color ) ) {
		  return $avma_body_color ;	
		 }		
	}
}

/**
 * Describtion Color
 */
add_action( 'admin_init', 'avma_style' );
if ( !function_exists( 'avma_style' ) ) {
	function avma_style () {
		$avma_style = avma_get_option ( 'avma_style' , 'design_tab' );
		 return $avma_style;	
	}
}

/**
 * [avma_cntct_frm description]
 * @return [type] [description]
 */
function avma_cntct_frm() {
	if ( isset( $_POST[ 'name' ] ) || isset( $_POST[ 'mail' ] ) || isset( $POST[ 'msg' ] ) ) {
			
		$avma_error = array() ;
		$name = trim( $_POST [ 'name' ] );
		// validate name field
		if ( !preg_match('/^[a-zA-Z ]*$/', $name) ) {
			$name = "";
			$avma_error['name'] = _e( 'Please enter valid name', 'avla-maintenance' );	
			return $avma_error ;						
		}
		$mail = trim( $_POST [ 'mail' ] );
		//validate mail field
		if ( !filter_var( $mail, FILTER_VALIDATE_EMAIL ) ) {
			$mail = "" ;
			$avma_error ['mail'] = _e( 'Pllease enter valid email address', 'avla-maintenance' );
			return $avma_error ;
		}
		$GLOBALS['$name'] ;
		$GLOBALS['$mail'] ;
		$msg  = trim( $_POST [ 'msg' ] );
		//success
		if ( empty( $avma_error ) ) { 
			$form_content = __( "User Mail : $mail \n User Message: $msg", 'avla-maintenance' );
			$avma_admin_mail = avma_get_option ( 'avma_contact_email', 'com_tab' );
			$subject = __( 'Maintenace Message', 'avla-maintenance' );
			wp_mail( $avma_admin_mail, $subject, $form_content ) ;
			echo '<span id="avma_suc">' ;
			 _e( 'Your message was successfuly sent!', 'avla-maintenance' );
			 echo  '</span> ' ;
	    }else{
	    	return $avma_error ;
	    }
	}		
}

/**
 * [avma_feedburner description]
 * @param  [type] $input [description]
 * @return [type]        [description]
 */
function avma_feedburner( $input ) { 
$avma_feed_act = avma_get_option( 'avma_newsle_active', 'com_tab' );
$avma_select_feed = avma_get_option ( 'avma_news_select', 'com_tab' );
$avma_feedburn = avma_get_option( 'avma_sub_feed', 'com_tab' );
$avma_feed_btn = avma_get_option( 'avma_sub_feed_btn', 'com_tab' );
$avma_feed_txt = avma_get_option( 'avma_sub_feed_txt', 'com_tab' );

	switch ($input) {
		case 'active':
			return $avma_feed_act ;
			break;
		case 'select':
			return $avma_select_feed;
			break;
		case 'link':
			return $avma_feedburn;
			break;
		case 'btn':
			return $avma_feed_btn;
			break;
		case 'txt':
			return $avma_feed_txt;
			break;		
		
		default:
			return 'not match!' ;
			break;
	}

}
/**
 * [avma_social description]
 * @param  [type] $input [description]
 * @return [type]        [description]
 */
function avma_social( $input ) { 
	$avma_social    = avma_get_option( 'avma_social'   , 'com_tab' );
	$avma_social_fa = avma_get_option( 'avma_social_fa', 'com_tab' );
	$avma_social_tw = avma_get_option( 'avma_social_tw', 'com_tab' );
	$avma_social_in = avma_get_option( 'avma_social_in', 'com_tab' );
	$avma_social_yo = avma_get_option( 'avma_social_yo', 'com_tab' );
	$avma_social_g  = avma_get_option( 'avma_social_g' , 'com_tab' );
	$avma_social_pi = avma_get_option( 'avma_social_pi', 'com_tab' );
	$avma_social_li = avma_get_option( 'avma_social_li', 'com_tab' );
	$avma_social_dr = avma_get_option( 'avma_social_dr', 'com_tab' );
	$avma_social_gi = avma_get_option( 'avma_social_gi', 'com_tab' );
		
		switch ( $input ) {
			case 'active':
				return $avma_social ;
				break;
			case 'facebook':
				if ( !empty( $avma_social_fa ) ) { 
					echo  "<div id='avma_fa'><a href= $avma_social_fa ><img src='' /></a></div>" ;
					break;
				}else{
					break;	
				}	
			case 'twitter':
				if ( !empty( $avma_social_tw ) ) { 
					echo "<div id='avma_tw'><a href= $avma_social_tw ><img src='' /></a></div>" ;
					break;
			    }else{
			    	break;
			    }
			case 'instagram':
				if 	( !empty( $avma_social_in ) ) { 
					echo "<div id='avma_in'><a href= $avma_social_in><img src='' /></a></div>" ;
					break;
			    }else{
			    	break;
			    }
			case 'youtube':
				if ( !empty( $avma_social_yo ) ) { 
					echo "<div id='avma_yo'><a href= $avma_social_yo ><img src='' /></a></div>" ;
					break;
			    }else{
			    	break;
			    }
			case 'googleplus':
				if ( !empty( $avma_social_g ) ) { 
					echo "<div id='avma_g'><a href=$avma_social_g ><img src='' /></a></div>" ;
					break;	
			    }else{
			    	break;
			    }
			case 'pintrest':
				if ( !empty( $avma_social_pi ) ) { 
					echo "<div id='avma_pi'><a href= $avma_social_pi ><img src='' /></a></div> ";
					break;
			    }else{
			    	break;
			    }
			case 'linkedin':
				if ( !empty( $avma_social_li ) ) { 
					echo "<div id='avma_li'><a href= $avma_social_li><img src='' /></a></div>" ;
					break;
			    }else{
			    	break;
			    }
			case 'dribble':
				if ( !empty ( $avma_social_dr ) ) { 
					echo "<div id='avma_dr'><a href= $avma_social_dr ><img src='' /></a></div>" ;
					break;
			    }else{
			    	break;
			    }
			case 'github':
				if ( !empty( $avma_social_gi ) ) { 
					echo "<div id='avma_fa'><a href= $avma_social_gi'><img src='' /></a></div>" ;
					break;
			    }else{
			    	break;
			    }

			default:

				break;
		}	
}









