<?php
/**
 * @link              http://omidakhavan.ir
 * @since             1.0.0
 * @package           boss-maintenance
 *
 * */

/**
 * Include Mailchimp api
 */
require_once hdm_DIR.'admin/includes/hdm-maintenance-chimp.php';
 
/**
 * get option from setting page
 * @param  [type] $option  [description]
 * @param  [type] $section [description]
 * @param  string $default [description]
 * @return [type]          [description]
 */
function hdm_get_option( $option, $section, $default = '' ) {
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
add_action( 'template_redirect', 'hdm_disable_wp', 9 );
function hdm_disable_wp ( $template ) {

    $hdm_custom_redirect = hdm_get_option ( 'hdm_redirect', 'general_tab' );

	$hdm_activation      = hdm_get_option ( 'hdm_active', 'general_tab'   );

	if  ( $hdm_activation == 'on' &&  $hdm_custom_redirect != "" ) {

		if( !is_admin() && !is_super_admin() && !preg_match("/login|admin|dashboard|account/i",$_SERVER['REQUEST_URI']) > 0){

			wp_redirect( $hdm_custom_redirect  ) ;

		}

    } elseif ( $hdm_activation == 'on' &&  $hdm_custom_redirect == "" ) {

        if( !is_admin() && !is_super_admin() && !preg_match("/wp-login|wp-admin|dashboard|account/i",$_SERVER['REQUEST_URI']) > 0) {

          	apply_filters( 'hdm_change_temp', $redirect_url =  hdm_DIR . 'templates/hdm-template.php' );

			include( $redirect_url );

			exit();

        }
    }  
}


/**
 * Admin Notice Message
 */
add_action( 'admin_notices', 'hdm_carefull_msg' );
function hdm_carefull_msg () {

	$hdm_admin_notice = hdm_get_option ( 'hdm_notif', 'general_tab' );
	$hdm_admin_active = hdm_get_option ( 'hdm_active', 'general_tab' );
	
	if ( $hdm_admin_active == 'on' && $hdm_admin_notice == 'on' ) {
		?>
	    <div class="updated">
	        <p><?php _e( 'Your site is under maintenance and only admin can view pages.', 'bsscommingsoon' ); ?></p>
	    </div>
	    <?php
	}
}


/**
 * Page Title 
 */
function hdm_page_title () {

	$hdm_page_title = hdm_get_option ( 'hdm_page_title' , 'design_tab' );

	if ( !empty( $hdm_page_title ) ) {

		return $hdm_page_title ;

	} else {

		return $hdm_page_title = get_bloginfo();
		
	}		
}

/**
 * [hdm_cntct_frm Contact form]
 * @return [type] [Contact form]
 */
function hdm_cntct_frm() {

	if ( !isset( $_POST[ 'name' ] ) && !isset( $_POST[ 'mail' ] ) ) {
		return;
	}
			
	$hdm_error = array() ;
	$name = sanitize_text_field( $_POST [ 'name' ] );

	// validate name field
	if ( !preg_match('/^[a-zA-Z ]*$/', $name) ) {
		$name = "";
		$hdm_error['name'] = _e( 'Please enter valid name.', 'bsscommingsoon' );	
		return $hdm_error ;						
	}

	$mail = sanitize_email( $_POST [ 'mail' ] );

	//validate mail field
	if ( $mail ) {
		$mail = "" ;
		$hdm_error ['mail'] = _e( 'Please enter valid email address.', 'bsscommingsoon' );
		return $hdm_error ;
	}

	$GLOBALS['$name'] ;
	$GLOBALS['$mail'] ;

	$msg  = sanitize_text_field( $_POST [ 'msg' ] );

	//success
	if ( empty( $hdm_error ) ) { 

		$form_content = __( "User Mail : $mail \n User Message: $msg", 'bsscommingsoon' );

		$hdm_admin_mail = hdm_get_option ( 'hdm_contact_email', 'com_tab' );

		$subject = __( 'Maintenace Message', 'bsscommingsoon' );

		wp_mail( $hdm_admin_mail, $subject, $form_content ) ;

		echo '<span id="hdm_suc">  _e( 'Your message was successfuly sent!', 'bsscommingsoon' )

		</span> ' ;

	} else {

		return $hdm_error ;

	}	
}

/**
 * [hdm_feedburner description]
 * @param  [type] $input [description]
 * @return [type]        [description]
 */
function hdm_feedburner( $input ) { 
$hdm_feed_act = hdm_get_option( 'hdm_newsle_active', 'com_tab' );
$hdm_select_feed = hdm_get_option ( 'hdm_news_select', 'com_tab' );
$hdm_feedburn = hdm_get_option( 'hdm_sub_feed', 'com_tab' );
$hdm_feed_btn = hdm_get_option( 'hdm_sub_feed_btn', 'com_tab' );
$hdm_feed_txt = hdm_get_option( 'hdm_sub_feed_txt', 'com_tab' );
$hdm_bg = hdm_get_option ( 'hdm_bg' , 'design_tab' );

	switch ($input) {
		case 'hdm_bg':
		    echo $hdm_bg ;
			break;
		case 'active':
			return $hdm_feed_act ;
			break;
		case 'select':
			return $hdm_select_feed;
			break;
		case 'link':
			return $hdm_feedburn;
			break;
		case 'btn':
			return $hdm_feed_btn;
			break;
		case 'txt':
			return $hdm_feed_txt;
			break;		
		
		default:
			return 'not match!' ;
			break;
	}

}
/**
 * [hdm_social description]
 * @param  [type] $input [description]
 * @return [type]        [description]
 */
function hdm_social( $input ) { 
		
	switch ( $input ) {
		case 'active':
			$hdm_social    = hdm_get_option( 'hdm_social'   , 'com_tab' );
			return $hdm_social ;
			break;
		case 'facebook':
			$hdm_social_fa = hdm_get_option( 'hdm_social_fa', 'com_tab' );
			if ( !empty( $hdm_social_fa ) ) { 
				echo  "<li id='hdm_fa' class='the-icons span3' data-social='facebook'><a class='demo-icon icon-facebook' href=$hdm_social_fa><i>&#xe803;</i></a></li>" ;
				break;
			}else{
				break;	
			}	
		case 'twitter':
			$hdm_social_tw = hdm_get_option( 'hdm_social_tw', 'com_tab' );
			if ( !empty( $hdm_social_tw ) ) { 
				echo "<li id='hdm_tw' class='the-icons span3' data-social='twitter'><a class='demo-icon icon-twitter' href=$hdm_social_tw><i>&#xe802;</i></a></li>" ;
				break;
			}else{
		    	break;
		}
		case 'instagram':
			$hdm_social_in = hdm_get_option( 'hdm_social_in', 'com_tab' );
			if 	( !empty( $hdm_social_in ) ) { 
				echo "<li id='hdm_in' class='the-icons span3' data-social='instagram'><a class='demo-icon icon-instagram' href= $hdm_social_in><i>&#xe807;</i></a></li>" ;
				break;
			}else{
		    	break;
		    }
		case 'youtube':
			$hdm_social_yo = hdm_get_option( 'hdm_social_yo', 'com_tab' );
			if ( !empty( $hdm_social_yo ) ) { 
				echo "<li id='hdm_yo' class='the-icons span3' data-social='youtube'><a class='demo-icon icon-youtube' href= $hdm_social_yo ><i>&#xe808;</i></a></li>" ;
				break;
		    }else{
		    	break;
		    }
		case 'googleplus':
			$hdm_social_g  = hdm_get_option( 'hdm_social_g' , 'com_tab' );
			if ( !empty( $hdm_social_g ) ) { 
				echo "<li id='hdm_g' class='the-icons span3' data-social='google plus'><a class='demo-icon icon-gplus' href=$hdm_social_g ><i>&#xe806;</i></a></li>" ;
				break;	
		    }else{
		    	break;
		    }
		case 'pintrest':
			$hdm_social_pi = hdm_get_option( 'hdm_social_pi', 'com_tab' );
			if ( !empty( $hdm_social_pi ) ) { 
				echo "<li id='hdm_pi' class='the-icons span3' data-social='pinterest'><a class='demo-icon icon-pinterest' href=$hdm_social_pi><i>&#xe801;</i></a></li>";
				break;
		    }else{
		    	break;
		    }
		case 'linkedin':
			$hdm_social_li = hdm_get_option( 'hdm_social_li', 'com_tab' );
			if ( !empty( $hdm_social_li ) ) { 
				echo "<li id='hdm_li' class='the-icons span3' data-social='linkedin'><a class='demo-icon icon-linkedin' href= $hdm_social_li><i>&#xe800;</i></a></li>" ;
				break;
		    }else{
		    	break;
		    }
		case 'dribble':
			$hdm_social_dr = hdm_get_option( 'hdm_social_dr', 'com_tab' );
			if ( !empty ( $hdm_social_dr ) ) { 
				echo "<li id='hdm_dr' class='the-icons span3' data-social='dribbble'><a class='demo-icon icon-dribbble' href= $hdm_social_dr ><i>&#xe804;</i></a></li>" ;
				break;
		    }else{
		    	break;
		    }
		case 'github':
			$hdm_social_gi = hdm_get_option( 'hdm_social_gi', 'com_tab' );
			if ( !empty( $hdm_social_gi ) ) { 
				echo "<li id='hdm_fa' class='the-icons span3' data-social='icon-github'><a class='demo-icon icon-github' href= $hdm_social_gi ><i>&#xe805;</i></a></li>" ;
				break;
			}else{
				break;
			}	
		case 'socolor':
			$hdm_so_color  = hdm_get_option( 'hdm_so_color' , 'com_tab' );
			if ( !empty( $hdm_so_color ) ) { 
				echo $hdm_so_color ;
				break;
		    }else{
		    	echo "black";
		    }

		default:

			break;
	}	
}

/**
 * add subscriber to mailchimp
 */
//Get mailchimp api key 
$hdm_chimp = hdm_get_option( 'hdm_chimp_api', 'com_tab' );
//get
$hdm_chimp_id = hdm_get_option( 'hdm_chimp_list', 'com_tab' );

use \DrewM\MailChimp\MailChimp;
 
$av_chimp = new MailChimp ($hdm_chimp);
//Hash the subscriber mail
$hdm_chimp_subs = $av_chimp->subscriberHash( $_POST[ 'mail_chimp' ]);
// add subscriber to list 
$result_add = $av_chimp->post("lists/$hdm_chimp_id/members", [
                'email_address' => $hdm_chimp_subs,
                'status'        => 'subscribed',
            ]);
$last_error = $av_chimp->getLastError();
global $last_error;


/**
 * [chim_msg generate message of mailchimp operation]
 * @return [string] [message]
 */
function chim_msg() { 
	if ( !empty( $_POST[ 'mail_chimp' ] ) ) {  
		if ( is_null( $last_error ) ) {
			echo '<div id="chimp_suc">' ;
			_e( 'Successfuly Subscribed', 'bsscommingsoon' );
			echo '</div>';
		}else{
			 echo '<div id="chimp_error" >' . $last_error . '</div>' ;
		}
    }
}

/**
 * [hdm_maintenace_help Help Tab]
 */
add_filter( 'contextual_help', 'hdm_maintenace_help', 10, 2 );
function hdm_maintenace_help( $contextual_help, $screen_id) {
     
    switch( $screen_id ) {
        case 'toplevel_page_hdm-maintenace' :
    		 // To add a whole tab group
            get_current_screen()->add_help_tab( array(
            'id'        => 'hdm_general',
            'title'     => __( 'First view' ),
            'content'   => __( '<P>'.'<strong>'.'Active Plugin'.'<strong/>'.'<p>'.'When you triggered Maintenance to active,There are three way in front of you First, you can check the active and your site will be directed to custom template Secondly, will happen when you have custom link and fill the special place that embedded Thirdly, when you want to take special page to coming soon just go to your specific page and on the right hand combo box select averta maintenace template.'.'<P>'.'<strong>'.'Counter'.'<strong/>'.'<p>'. 'When you active plugin you can choose template with counter or without any counter demonstration the time calculation its matching with you local time but date will be calculate from js date function and has not any relation with you local date.'.'<P>'.'<strong>'.'Template Background'.'<strong/>'.'<p>'.'You whatever you want can change your style the one of the customazation section is change your template background color or set image for your background please keep in your mind that background image priority higher than background color.','bsscommingsoon' )

            ) );

            get_current_screen()->add_help_tab( array(
            'id'        => 'hdm_dev',
            'title'     => __( 'Developer' ),
            'content'   => __( 'As intrested user you can check this out <a href="http://omidakhavan.ir" >  </a>', 'bsscommingsoon' )
            ) );
            break;
    }
    return $contextual_help;

}

