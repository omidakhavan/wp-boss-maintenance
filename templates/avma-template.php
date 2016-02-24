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
          <span><?php echo avma_get_option ( 'avma_content_title' , 'design_tab' ); ?></span>
        </div>
       <style>
       /**Describtion Color**/
       <?php echo avma_get_option ( 'avma_style' , 'design_tab' ); ; ?>
          body{
            background-image: url(<?php AVMA_URL . avma_feedburner('avma_bg') ?>);
          }
          /** Title Color */
          #avma_h1{
            color: <?php echo avma_get_option ( 'vma_title_color' , 'design_tab' ); ?> ;
          }
          /** Body Text Color */
          #avma_article{
            color: <?php echo  avma_get_option ( 'avma_body_color' , 'design_tab' ) ; ?> ;
          }
       </style>

    <?php  
    $avma_count_active = avma_get_option ( 'avma_count', 'general_tab' );
    if ( $avma_count_active == 'Active' ) : ?>
      <!--Maintenace Describtion OutPut-->
      <div class="avma_clearfix" id="avma_messages">
        <article> <?php echo avma_get_option ( 'avma_describ' , 'design_tab' ); ?></article>
      </div>
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

      <div id="avma_social">
       <!--Social Link-->
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
        } 
        ?>
      </div>
      <div id="avma_cpy">
        Copyright &copy;
        <?php echo date("Y"); ?>
        <?php bloginfo('name'); ?>
        All Rights Reserved.
      </div>
  </div> 
</body>
</html>


