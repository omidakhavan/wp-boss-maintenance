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
add_action( 'wp_head', 'avma_js_style' );
function avma_js_style(){
  wp_enqueue_style( 'avma_style', AVMA_URL.'/public/css/style.css', array(), '1.0.0' ) ;
}

add_action( 'wp_head', 'avma_js_script' );
function avma_js_script(){
  wp_enqueue_script( 'avma_script', AVMA_URL.'/public/js/averta-maintenance-js.js', array(), '1.0.0' ) ;

}


?>
<!DOCTYPE html>
<html>
<head>
<?php wp_head(); ?> 
  <script>   
      ( function( $ ) {  
        $(document).ready(function() {
          var ctdown = { avma_ct : avma.avma_date};
          var enddate = ctdown.avma_ct ;
          $("#countdown").countdown({
            date: enddate , 
            format: "off" 
          },
          function() { 
          });
        });
      })( jQuery );
   </script>  
</head>
<title><?php echo avma_page_title(); ?></title>
<body> 
    <img id="avma_logo" src="<?php echo avma_logo() ; ?>"></img>
    <h1 id="avma_h1"><?php echo avma_content_title() ; ?></h1>
 <style>
 <?php echo avma_style() ; ?>
    body{
      background-image: url(<?php AVMA_URL . avma_bg() ?>);
    }
    #avma_h1{
      color: <?php echo vma_title_color() ; ?> ;
    }
    #avma_article{
      color: <?php echo avma_body_color() ; ?> ;
    }
 </style>

<?php  
$avma_count_active = avma_get_option ( 'avma_count', 'general_tab' );
if ( $avma_count_active == 'Active' ) : ?>
  <article id="avma_article"> <?php echo avma_describ() ; ?></article>
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
      <?php  if ( avma_feedburner( 'active' ) == 'active' && avma_feedburner( 'select' ) == 'FeedBurner' ) : ?>
        <form action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open('http://feedburner.google.com/fb/a/mailverify?uri=<?php echo avma_feedburner( 'link' ) ; ?>', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true">
            <input type="hidden" value="<?php echo avma_feedburner( 'link' ) ?>" name="uri"/>
            <input type="hidden" name="loc" value="en_US"/>
            <input id="notify_txt" type="text" name="email" placeholder="<?php echo avma_feedburner( 'txt' ); ?>"/>
            <button id="notify_btn" type="submit"><?php echo avma_feedburner( 'btn' ) ; ?></button>
        </form>
      <?php endif ; ?>
      <?php if ( avma_social( 'active' ) == 'active' ) {
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

