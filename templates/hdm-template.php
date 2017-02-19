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


?>

<!DOCTYPE html>
<html>
<head>
<?php do_action( 'hdm_head' ); ?> 
</head>
<title><?php echo hdm_page_title(); ?></title>
<body>
  <div id="wrapper">
    <div id="hdm_content">
        <!--Template Logo-->
        <div id="hdm_logo">
          <img src="<?php echo hdm_get_option ( 'hdm_logo' , 'design_tab' ); ?>"></img>
        </div>
        <!--Template Header Title-->
        <div class="hdm_clearfix" id="hdm_title">
          <span id="hdm_cntnt_ti"><?php echo hdm_get_option ( 'hdm_content_title' , 'design_tab' ); ?></span>
        </div>
       <style>
        /**Describtion Color**/
        <?php echo hdm_get_option ( 'hdm_style' , 'design_tab' ); ; ?>
        /** Title Color */
        #hdm_cntnt_ti{color: <?php echo hdm_get_option ( 'vma_title_color' , 'design_tab' ); ?> ;}
        /** Body Text Color */
        #hdm_article{color: <?php echo  hdm_get_option ( 'hdm_body_color' , 'design_tab' ) ; ?> ;}
       </style>
      <!-- BackGround Color --> 
      <?php if ( hdm_get_option( 'hdm_bg_select', 'design_tab' ) == 'color' ) : ?>
        <style>
           div#hdm_content{ background-color: <?php echo hdm_get_option( 'hdm_bg_color', 'design_tab' ); ?>  } ;
        </style>
      <?php endif ; ?>  
      <!-- image backgound -->  
      <?php if ( hdm_get_option( 'hdm_bg_select', 'design_tab') == 'image' ) : ?>
        <style>
          div#hdm_content{  background-color: transparent; } 
          body{ background-image: url(<?php hdm_URL . hdm_feedburner('hdm_bg') ?>);}
        </style>
      <?php endif ; ?> 
      <!--BackGround Options-->
      <?php if ( hdm_get_option( 'hdm_bg_select', 'design_tab') == 'image' ) : 
      $hdm_im_option = hdm_get_option( 'hdm_bg_option','design_tab' );
      if ( $hdm_im_option == 'stretch') : ?>
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
    <div class="hdm_clearfix" id="hdm_messages">
      <article id="hdm_article"> <?php echo hdm_get_option ( 'hdm_describ' , 'design_tab' ); ?></article>
    </div>
    <?php  
    $hdm_count_active = hdm_get_option ( 'hdm_count', 'general_tab' );
    if ( $hdm_count_active == 'active' ) : 
      $hdm_counter_color = hdm_get_option ( 'hdm_counter_color', 'general_tab' );
    ?>
      <!--Maintenace Describtion OutPut-->
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
    </div> 
  <?php endif ; ?>
      <?php wp_footer();?>
      <?php do_action( 'hdm_frm' ) ;  ?>

      <div class="hdm_newsletter">
        <!------Feed Burner------>
        <?php  if ( hdm_feedburner( 'active' ) == 'active' && hdm_feedburner( 'select' ) == 'FeedBurner' ) : ?>
          <div class="hdm_title_news">
            <span><?php _e( 'Subscribtion','avla-maintenance' ); ?></span>
          </div>
          <div class="hdm_msg_news">
           <span><?php _e( 'Subscribe for our feeds','avla-maintenance' ); ?></span>
          </div>
          <form class="hdm_form_news" action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open('http://feedburner.google.com/fb/a/mailverify?uri=<?php echo hdm_feedburner( 'link' ) ; ?>', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true">
              <input type="hidden" value="<?php echo hdm_feedburner( 'link' ) ?>" name="uri"/>
              <input type="hidden" name="loc" value="en_US"/>
              <input class="notify_txt" id="notify_txt" type="text" name="email" placeholder="<?php echo hdm_feedburner( 'txt' ); ?>"/>
              <button class="notify_btn" id="notify_btn" type="submit"><?php echo hdm_feedburner( 'btn' ) ; ?></button>
          </form>
     
        <?php endif ; ?>
      </div>

      <div class="hdm_newsletter">
        <!--Mail Chimp-->
        <?php  if ( hdm_feedburner( 'active' ) == 'active' && hdm_feedburner( 'select' ) == 'mailchimp' ) : ?>
          <div class="hdm_title_news">
            <span><?php _e( 'Subscribtion','avla-maintenance' ); ?></span>
          </div>
          <div class="hdm_msg_news">
           <span><?php _e( 'Subscribe for our feeds','avla-maintenance' ); ?></span>
          </div>
        <form class="hdm_form_news" action="hdm-template.php" method="post" >
              <input type="hidden" name="loc" value="en_US"/>
              <input id="mail_chimp" type="text" name="mail_chimp" placeholder="<?php echo hdm_feedburner( 'txt' ); ?>"/>
              <button   class="notify_btn" id="notify_chimp_btn" type="submit"><?php echo hdm_feedburner( 'btn' ) ; ?></button>
        </form>
          <?php chim_msg() ?>
        <?php endif ; ?>
      </div>

      <?php 
      // Contact Form
      $hdm_cntct_active = hdm_get_option ( 'hdm_contact_active', 'com_tab' );
      if ( $hdm_cntct_active == 'Active' ) : 
      ?>
     <!--Contact Form Tittle-->
     <div id="hdm_cntct_frm" class="hdm_clearfix">
        <div id="hdm_acontact_title">
          <h2><?php _e( 'Stay in Touch', 'avla-maintenance' ); ?></h2>
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
        $video_ogg  =  hdm_get_option( 'hdm_bg_video','design_tab' ); 
        $video_mp4  =  hdm_get_option( 'hdm_bg_mp4'  ,'design_tab' ); 
        $video_webm =  hdm_get_option( 'hdm_bg_webm' ,'design_tab' ); 
      ?>
      <div id="hdm_video" >
        <video autoplay loop poster=""  id="bgvid">
          <style> #hdm_content{  background-color: transparent } ; </style>
            <source src="<?php echo $video_mp4 ?> " type="video/mp4">
            <source src="<?php echo $video_webm ?> " type="video/webm">
            <source src="<?php echo $video_ogg; ?> " type="video/ogg">
            Your browser does not support HTML5 video.
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
       ?><style>
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
</body>
</html>


