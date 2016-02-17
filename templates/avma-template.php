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
<?php wp_head(); ?> 
</head>
<title><?php echo avma_page_title(); ?></title>
<body> 
    <!--Template Logo-->
    <img id="avma_logo" src="<?php echo avma_get_option ( 'avma_logo' , 'design_tab' ); ?>"></img>
    <!--Template Header Title-->
    <h1 id="avma_h1"><?php echo avma_get_option ( 'avma_content_title' , 'design_tab' ); ?></h1>
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
  <article id="avma_article"> <?php echo avma_get_option ( 'avma_describ' , 'design_tab' ); ?></article>
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
<?php endif ; ?>
    <?php wp_footer();?>
    <?php do_action( 'avma_frm' ) ;  

    // Contact Form
    $avma_cntct_active = avma_get_option ( 'avma_contact_active', 'com_tab' );
    if ( $avma_cntct_active == 'Active' ) : 
    ?>
      <h2><?php _e( 'Contact Us', 'averta-maintenance' ); ?></h2>
      <form action="avma-template.php" method="POST"> 
        <p class="name">
          <input type="text" name="name" id="name" value= "<?php $name ?>" placeholder="<?php _e( 'Example Name' , 'averta-maintenance' ) ; ?>" required/>
          <label for="name"><?php _e ( 'Name','averta-maintenance' );?></label>
        </p>

        <p class="mail">
          <input type="text" name="mail" id="mail" value="<?php $mail ?>" placeholder=" <?php _e ( 'mail@example.com', 'averta-maintenance' ); ?> " required/>
          <label for="mail"><?php _e ( 'Email', 'averta-maintenance');?></label>
        </p>
        <p class="msg">
          <textarea name="msg" row="4" cols="50" placeholder="<?php _e ( 'Write something to us maximum 300 character', 'averta-maintenance' ); ?>"  required /></textarea>
          <label for="msg"><?php _e( 'Message' , 'averta-maintenance' ); ?></label>
        </p>
        
        <p class="submit">
          <input type="submit" name="submit" value="Send" />
        </p>
      </form>

      <?php  avma_cntct_frm() ?>
  <?php endif ; ?>

      <!------Feed Burner------>
      <?php  if ( avma_feedburner( 'active' ) == 'active' && avma_feedburner( 'select' ) == 'FeedBurner' ) : ?>
        <form action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open('http://feedburner.google.com/fb/a/mailverify?uri=<?php echo avma_feedburner( 'link' ) ; ?>', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true">
            <input type="hidden" value="<?php echo avma_feedburner( 'link' ) ?>" name="uri"/>
            <input type="hidden" name="loc" value="en_US"/>
            <input id="notify_txt" type="text" name="email" placeholder="<?php echo avma_feedburner( 'txt' ); ?>"/>
            <button id="notify_btn" type="submit"><?php echo avma_feedburner( 'btn' ) ; ?></button>
        </form>
      <?php endif ; ?>

      <!--Mail Chimp-->
      <?php  if ( avma_feedburner( 'active' ) == 'active' && avma_feedburner( 'select' ) == 'mailchimp' ) : ?>
        <form action="avma-template.php" method="post" >
            <input type="hidden" name="loc" value="en_US"/>
            <input id="mail_chimp" type="text" name="mail_chimp" placeholder="<?php echo avma_feedburner( 'txt' ); ?>"/>
            <button id="notify_chimp_btn" type="submit"><?php echo avma_feedburner( 'btn' ) ; ?></button>
      </form>
        <?php chim_msg() ?>
      <?php endif ; 

     //Social Link   
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

</body>
</html>


