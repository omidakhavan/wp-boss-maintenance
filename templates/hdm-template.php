<?php
/**
 * @link              http://omidakhavan.ir
 * @since             1.0.0
 * @package           boss-maintenance
 *
 * */
/**
 * enqueue js and style
 */
require_once hdm_DIR . 'admin/includes/hdm-maintenance-functions.php' ; 

hdm_template_style();
hdm_template_script();
?>

<!DOCTYPE html>
<html>
	<head>
		<title><?php echo hdm_page_title(); do_action( 'hdm_head' ); ?></title>
	</head>
<body>
	<div class="hdm-wrapper">

		<div class="hdm-content">

			<!--Template Logo-->
			<?php if ( hdm_get_option( 'hdm_logo' , 'design_tab' ) ) : ?>
				<div id="hdm_logo">
					<img src="<?php echo hdm_get_option( 'hdm_logo' , 'design_tab' ) ; ?>"></img>
				</div>
			<?php endif; ?>

			<!--Template Header Title-->
			<?php if ( hdm_get_option( 'hdm_content_title' , 'design_tab' ) ) : ?>
				<div class="hdm-title">
					<span class="htm-measage-title"><?php echo hdm_get_option ( 'hdm_content_title' , 'design_tab' ); ?></span>
				</div>
			<?php endif; ?>

			<!-- Background image -->  
			<?php if ( hdm_get_option( 'hdm_bg_select', 'design_tab') == 'image' ) : ?>
				<style>
					.hdm-content{  background-color: transparent; } 
					body{ background-image: url(<?php hdm_URL . hdm_feedburner('hdm_bg') ?>);}
				</style>
			<?php endif ; ?>

			<!--BackGround image options-->
			<?php 
			if ( hdm_get_option( 'hdm_bg_select', 'design_tab') == 'image' ) : ?>

				<?php $hdm_im_option = hdm_get_option( 'hdm_bg_option','design_tab' ); ?>

				<?php if ( $hdm_im_option == 'stretch') : ?>
					<style>
						body{ background-repeat:no-repeat; background-size:100% 100%; } 
					</style>
				<?php endif ; ?>

				<?php if ( $hdm_im_option == 'contain') : ?>
					<style>
						body{ background-repeat:no-repeat; background-size:contain; } 
					</style>
				<?php endif ; ?>

				<?php if ( $hdm_im_option == 'cover') : ?>
					<style>
						body{ background-repeat:no-repeat; background-size:cover; } 
					</style>
				<?php endif ; ?>

				<?php if ( $hdm_im_option == 'repeat') : ?>
					<style>
						body{ background-repeat:repeat; } 
					</style>
				<?php endif ; ?>

				<?php if ( $hdm_im_option == 'repeatx') : ?>
					<style>
						body{ background-repeat:repeat-x; } 
					</style>
				<?php endif ; ?>

				<?php if ( $hdm_im_option == 'repeaty') : ?>
					<style>
						body{ background-repeat:repeat-y; } 
					</style>
				<?php endif ; ?>

			<?php endif ; ?>

			<!-- article messsages  -->
			<?php if ( hdm_get_option ( 'hdm_describ' , 'design_tab' ) ) : ?>
				<div class="hdm_clearfix" id="hdm_messages">
					<article class="hdm-message-article"> <?php echo hdm_get_option ( 'hdm_describ' , 'design_tab' ); ?></article>
				</div>
			<?php endif; ?>

			<?php  
			// check counter is active ?
			if ( hdm_get_option ( 'hdm_count', 'general_tab' ) == 'active' ) : 

				$hdm_counter_color = hdm_get_option ( 'hdm_counter_color', 'general_tab' );
			?>
			<!-- get styles -->
			<style>
				#hdm_counter ul#countdown li{ color: <?php echo $hdm_counter_color ; ?> }
			</style>

			<div class="hdm_clearfix" id="hdm_counter">
				<ul class="clockdiv" id="countdown">
					<li>
						<span class="days">00</span>
						<p class="timeRefDays">days</p>
					</li>
					<li>
						<span class="hours">00</span>
						<p class="timeRefHours">hours</p>
					</li>
					<li>
						<span class="minutes">00</span>
						<p class="timeRefMinutes">minutes</p>
					</li>
					<li>
						<span class="seconds">00</span>
						<p class="timeRefSeconds">seconds</p>
					</li>
				</ul>
			</div>
			<?php endif ; ?>

			<?php wp_footer();?>

			<?php do_action( 'hdm_frm' ) ;  ?>
			
			 <!-- News letter -->
			<?php  if ( hdm_feedburner( 'active' ) == 'active' && hdm_feedburner( 'select' ) == 'FeedBurner' ) : ?>
			<div class="hdm_newsletter">

					<div class="hdm_title_news">
						<h4><?php _e( 'Subscribtion','bsscommingsoon' ); ?></h4>
					</div>

					<div class="hdm_msg_news">
						<p><?php _e( 'Subscribe for our feeds','bsscommingsoon' ); ?></p>
					</div>

					<form class="hdm_form_news" action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open('http://feedburner.google.com/fb/a/mailverify?uri=<?php echo hdm_feedburner( 'link' ) ; ?>', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true">
						<input type="hidden" value="<?php echo hdm_feedburner( 'link' ) ?>" name="uri"/>
						<input type="hidden" name="loc" value="en_US"/>
						<input class="notify_txt" id="notify_txt" type="text" name="email" placeholder="<?php echo hdm_feedburner( 'txt' ); ?>"/>
						<button class="notify_btn" id="notify_btn" type="submit"><?php echo hdm_feedburner( 'btn' ) ; ?></button>
					</form>
			</div>
			<?php endif ; ?>
			
			<!-- Mail Chimp -->
			<?php  if ( hdm_feedburner( 'active' ) == 'active' && hdm_feedburner( 'select' ) == 'mailchimp' ) : ?>
			<div class="hdm_newsletter">
				<!--Mail Chimp-->
					<div class="hdm_title_news">
						<span><?php _e( 'Subscribtion','bsscommingsoon' ); ?></span>
					</div>
					<div class="hdm_msg_news">
						<span><?php _e( 'Subscribe for our feeds','bsscommingsoon' ); ?></span>
					</div>
					<form class="hdm_form_news" action="hdm-template.php" method="post" >
						<input type="hidden" name="loc" value="en_US"/>
						<input id="mail_chimp" type="text" name="mail_chimp" placeholder="<?php echo hdm_feedburner( 'txt' ); ?>"/>
						<button   class="notify_btn" id="notify_chimp_btn" type="submit"><?php echo hdm_feedburner( 'btn' ) ; ?></button>
					</form>
					<?php chim_msg() ?>
			</div>
			<?php endif ; ?>
					
		    <!-- Contact Form -->
			<?php 
			if ( hdm_get_option ( 'hdm_contact_active', 'com_tab' ) == 'Active' ) : 
				?>
			<!--Contact Form Tittle-->
			<div id="hdm_cntct_frm" class="hdm_clearfix">
				<div id="hdm_acontact_title">
					<h2><?php _e( 'Stay in Touch', 'bsscommingsoon' ); ?></h2>
				</div>
				<!--Contact Form-->
				<div id="hdm_contact_form">
					<form action="hdm-template.php" method="POST"> 
						<p class="name">
							<input type="text" name="name" id="name" value= "<?php $name ?>" placeholder="<?php _e( 'Name' , 'boss-maintenance' ) ; ?>" required/>
						</p>
						<p class="mail">
							<input type="text" name="mail" id="mail" value="<?php $mail ?>" placeholder=" <?php _e ( 'E-Mail', 'boss-maintenance' ); ?> " required/>
						</p>
						<p class="msg">
							<textarea id="hdm_msg" name="msg" row="4" cols="50" placeholder="<?php _e ( 'Message', 'boss-maintenance' ); ?>"  required /></textarea>
						</p>

						<p class="submit">
							<input type="submit" name="submit" value="Send Message" />
						</p>
					</form>
				</div>
			</div>
			<?php  hdm_cntct_frm() ?>
			<?php endif ; ?>

			<?php if ( hdm_get_option( 'hdm_bg_select', 'design_tab') == 'video' ) : ?>
					<!-- Video Background-->
					<?php
					$video_mp4  =  hdm_get_option( 'hdm_bg_mp4'  ,'design_tab' ); 
					$video_webm =  hdm_get_option( 'hdm_bg_webm' ,'design_tab' ); 
					$video_ogg  =  hdm_get_option( 'hdm_bg_video','design_tab' ); 
					?>
					<div id="hdm_video" >
						<video autoplay loop poster=""  id="bgvid">
							<style> .hdm-content{  background-color: transparent } ; </style>
							<source src="<?php echo $video_mp4 ?> " type="video/mp4">
							<source src="<?php echo $video_webm ?> " type="video/webm">
							<source src="<?php echo $video_ogg; ?> " type="video/ogg">
						</video>
					</div>
				<?php endif ; ?>  

				<div id="footer" class="hdm_clearfix">
					<!--Social Link-->
					<ul id="hdm_social">
						<?php   
						if ( hdm_social( 'active' ) == 'active' ) {
							hdm_social( 'facebook' );
							hdm_social( 'twitter' );
							hdm_social( 'instagram' );
							hdm_social( 'youtube' );
							hdm_social( 'googleplus' );
							hdm_social( 'pintrest' );
							hdm_social( 'linkedin' );
							hdm_social( 'dribble' );
							hdm_social( 'github' );
							?>
						<style>
							ul#hdm_social li a{
								color: <?php hdm_social( 'socolor' ); ?>;
							}
						</style>
						<?php };
						?>
					</ul>
				</div>    
				<!-- footer section --> 
				<div id="hdm_cpy">
					<?php echo hdm_get_option( 'hdm_footer' , 'com_tab' ); ?>
				</div>
		</div>
	</div> 
</body>
</html>


<?php
// enqueue styles in template
function hdm_template_style(){
	?>
	<!-- BackGround Color --> 
	<?php if ( hdm_get_option( 'hdm_bg_select', 'design_tab' ) == 'color' ) : ?>
		<style>
			.hdm-content{ background-color: <?php echo hdm_get_option( 'hdm_bg_color', 'design_tab' ); ?>  } ;
		</style>
	<?php endif ; ?>

	<style>
		/**Describtion Color**/
		<?php echo hdm_get_option ( 'hdm_style' , 'design_tab' ); ?>

		/** Title Color */
		.htm-measage-title{color: <?php echo hdm_get_option ( 'vma_title_color' , 'design_tab' ); ?> ;}
		
		/** maintenance message Color */
		<?php if ( hdm_get_option ( 'hdm_body_color' , 'design_tab' ) ) : ?>
			 .hdm-message-article{color: <?php echo  hdm_get_option ( 'hdm_body_color' , 'design_tab' ) ; ?> ;} 
		<?php endif; ?>
	</style>
	<?php
}

// enqueue scripts in templplates
function hdm_template_script(){
	wp_enqueue_script( 'boss-maintenance', hdm_URL.'/public/js/hdm-maintenance.min.js', array( 'jquery' ), '1.0.0', false ); // enqueue our scripts

	$hdm_count_date = hdm_get_option ( 'hdm_start_date', 'general_tab' ); // get start date

	wp_localize_script( 'boss-maintenance', 'hdm' , $json = 
		array(
			'hdm_date' => $hdm_count_date,
			'days'        => __( 'days', 'domain'    ),
			'day'         => __( 'day', 'domain'     ),
			'hours'       => __( 'hours', 'domain'   ),
			'hour'        => __( 'hour', 'domain'    ),
			'minutes'     => __( 'minutes', 'domain' ),
			'minute'      => __( 'minute', 'domain'  ),
			'seconds'     => __( 'seconds', 'domain' ),
			'second'      => __( 'second', 'domain'  )
			)); // loclize date to front end
}

