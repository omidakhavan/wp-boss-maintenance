<?php
/**
 * @link              http://averta.net
 * @since             1.0.0
 * @package           averta-maintenance
 *
 * */
/**
 * enqueue js and style
 */
require_once AVMA_DIR . 'admin/includes/avma-maintenance-functions.php' ; 


?>

<!DOCTYPE html>
<html>
<head>
<?php do_action( 'avma_head' ); ?> 
</head>
<title><?php echo avma_page_title(); ?></title>
<body>
  <div id="wrapper">
    <div id="avma_content">
        <!--Template Logo-->
        <div id="avma_logo">
          <img src="<?php echo avma_get_option ( 'avma_logo' , 'design_tab' ); ?>"></img>
        </div>
        <!--Template Header Title-->
        <div class="avma_clearfix" id="avma_title">
          <span id="avma_cntnt_ti"><?php echo avma_get_option ( 'avma_content_title' , 'design_tab' ); ?></span>
        </div>
       <style>
        /**Describtion Color**/
        <?php echo avma_get_option ( 'avma_style' , 'design_tab' ); ; ?>
        /** Title Color */
        #avma_cntnt_ti{color: <?php echo avma_get_option ( 'vma_title_color' , 'design_tab' ); ?> ;}
        /** Body Text Color */
        #avma_article{color: <?php echo  avma_get_option ( 'avma_body_color' , 'design_tab' ) ; ?> ;}
       </style>
      <!-- BackGround Color --> 
      <?php if ( avma_get_option( 'avma_bg_select', 'design_tab' ) == 'color' ) : ?>
        <style>
           div#avma_content{ background-color: <?php echo avma_get_option( 'avma_bg_color', 'design_tab' ); ?>  } ;
        </style>
      <?php endif ; ?>  
      <!-- image backgound -->  
      <?php if ( avma_get_option( 'avma_bg_select', 'design_tab') == 'image' ) : ?>
        <style>
          div#avma_content{  background-color: transparent; } 
          body{ background-image: url(<?php AVMA_URL . avma_feedburner('avma_bg') ?>);}
        </style>
      <?php endif ; ?> 
      <!--BackGround Options-->
      <?php if ( avma_get_option( 'avma_bg_select', 'design_tab') == 'image' ) : 
      $avma_im_option = avma_get_option( 'avma_bg_option','design_tab' );
      if ( $avma_im_option == 'stretch') : ?>
        <style>
           body{ background-repeat:no-repeat; background-size:100% 100%; } 
        </style>
      <?php endif ; ?>
      <?php if ( $avma_im_option == 'contain') : ?>
        <style>
           body{ background-repeat:no-repeat; background-size:contain; } 
        </style>
      <?php endif ; ?>
      <?php if ( $avma_im_option == 'cover') : ?>
        <style>
           body{ background-repeat:no-repeat; background-size:cover; } 
        </style>
      <?php endif ; ?>
      <?php if ( $avma_im_option == 'repeat') : ?>
        <style>
           body{ background-repeat:repeat; } 
        </style>
      <?php endif ; ?>
      <?php if ( $avma_im_option == 'repeatx') : ?>
        <style>
           body{ background-repeat:repeat-x; } 
        </style>
      <?php endif ; ?>
      <?php if ( $avma_im_option == 'repeaty') : ?>
        <style>
           body{ background-repeat:repeat-y; } 
        </style>
      <?php endif ; ?>
     <?php endif ; ?>  
    <div class="avma_clearfix" id="avma_messages">
      <article id="avma_article"> <?php echo avma_get_option ( 'avma_describ' , 'design_tab' ); ?></article>
    </div>
    <?php  
    $avma_count_active = avma_get_option ( 'avma_count', 'general_tab' );
    if ( $avma_count_active == 'active' ) : 
      $avma_counter_color = avma_get_option ( 'avma_counter_color', 'general_tab' );
    ?>
      <!--Maintenace Describtion OutPut-->
      <style>
        #avma_counter ul#countdown li{ color: <?php echo $avma_counter_color ; ?> }
      </style>
      <div class="avma_clearfix" id="avma_counter">
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
      <?php do_action( 'avma_frm' ) ;  ?>

      <div class="avma_newsletter">
        <!------Feed Burner------>
        <?php  if ( avma_feedburner( 'active' ) == 'active' && avma_feedburner( 'select' ) == 'FeedBurner' ) : ?>
          <div class="avma_title_news">
            <span><?php _e( 'Subscribtion','avla-maintenance' ); ?></span>
          </div>
          <div class="avma_msg_news">
           <span><?php _e( 'Subscribe for our feeds','avla-maintenance' ); ?></span>
          </div>
          <form class="avma_form_news" action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open('http://feedburner.google.com/fb/a/mailverify?uri=<?php echo avma_feedburner( 'link' ) ; ?>', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true">
              <input type="hidden" value="<?php echo avma_feedburner( 'link' ) ?>" name="uri"/>
              <input type="hidden" name="loc" value="en_US"/>
              <input class="notify_txt" id="notify_txt" type="text" name="email" placeholder="<?php echo avma_feedburner( 'txt' ); ?>"/>
              <button class="notify_btn" id="notify_btn" type="submit"><?php echo avma_feedburner( 'btn' ) ; ?></button>
          </form>
     
        <?php endif ; ?>
      </div>

      <div class="avma_newsletter">
        <!--Mail Chimp-->
        <?php  if ( avma_feedburner( 'active' ) == 'active' && avma_feedburner( 'select' ) == 'mailchimp' ) : ?>
          <div class="avma_title_news">
            <span><?php _e( 'Subscribtion','avla-maintenance' ); ?></span>
          </div>
          <div class="avma_msg_news">
           <span><?php _e( 'Subscribe for our feeds','avla-maintenance' ); ?></span>
          </div>
        <form class="avma_form_news" action="avma-template.php" method="post" >
              <input type="hidden" name="loc" value="en_US"/>
              <input id="mail_chimp" type="text" name="mail_chimp" placeholder="<?php echo avma_feedburner( 'txt' ); ?>"/>
              <button   class="notify_btn" id="notify_chimp_btn" type="submit"><?php echo avma_feedburner( 'btn' ) ; ?></button>
        </form>
          <?php chim_msg() ?>
        <?php endif ; ?>
      </div>

      <?php 
      // Contact Form
      $avma_cntct_active = avma_get_option ( 'avma_contact_active', 'com_tab' );
      if ( $avma_cntct_active == 'Active' ) : 
      ?>
     <!--Contact Form Tittle-->
     <div id="avma_cntct_frm" class="avma_clearfix">
        <div id="avma_acontact_title">
          <h2><?php _e( 'Stay in Touch', 'avla-maintenance' ); ?></h2>
        </div>
        <!--Contact Form-->
        <div id="avma_contact_form">
          <form action="avma-template.php" method="POST"> 
            <p class="name">
              <input type="text" name="name" id="name" value= "<?php $name ?>" placeholder="<?php _e( 'Name' , 'averta-maintenance' ) ; ?>" required/>
            </p>
            <p class="mail">
              <input type="text" name="mail" id="mail" value="<?php $mail ?>" placeholder=" <?php _e ( 'E-Mail', 'averta-maintenance' ); ?> " required/>
            </p>
            <p class="msg">
              <textarea id="avma_msg" name="msg" row="4" cols="50" placeholder="<?php _e ( 'Message', 'averta-maintenance' ); ?>"  required /></textarea>
            </p>
            
            <p class="submit">
              <input type="submit" name="submit" value="Send Message" />
            </p>
          </form>
        </div>
      </div>
        <?php  avma_cntct_frm() ?>
    <?php endif ; ?>

      <?php if ( avma_get_option( 'avma_bg_select', 'design_tab') == 'video' ) : ?>
      <!-- Video Background-->
      <?php
        $video_ogg  =  avma_get_option( 'avma_bg_video','design_tab' ); 
        $video_mp4  =  avma_get_option( 'avma_bg_mp4'  ,'design_tab' ); 
        $video_webm =  avma_get_option( 'avma_bg_webm' ,'design_tab' ); 
      ?>
      <div id="avma_video" >
        <video autoplay loop poster=""  id="bgvid">
          <style> #avma_content{  background-color: transparent } ; </style>
            <source src="<?php echo $video_mp4 ?> " type="video/mp4">
            <source src="<?php echo $video_webm ?> " type="video/webm">
            <source src="<?php echo $video_ogg; ?> " type="video/ogg">
            Your browser does not support HTML5 video.
        </video>
      </div>
    <?php endif ; ?>  
    <div id="footer" class="avma_clearfix">
       <!--Social Link-->
        <ul id="avma_social">
        <?php   
        if ( avma_social( 'active' ) == 'active' ) {
           avma_social( 'facebook' );
            avma_social( 'twitter' );
              avma_social( 'instagram' );
                avma_social( 'youtube' );
                  avma_social( 'googleplus' );
               avma_social( 'pintrest' );
              avma_social( 'linkedin' );
            avma_social( 'dribble' );
           avma_social( 'github' );
       ?><style>
          ul#avma_social li a{
            color: <?php avma_social( 'socolor' ); ?>;
          }
       </style>
        <?php };
        ?>
        </ul>
    </div>    
       <!-- footer section --> 
      <div id="avma_cpy">
        <?php echo avma_get_option( 'avma_footer' , 'com_tab' ); ?>
      </div>
  </div> 
</body>
</html>


