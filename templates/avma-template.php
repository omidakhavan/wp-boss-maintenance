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
<title><?php avma_page_title() ?></title>
<body> <h1><?php avma_content_title() ?></h1>
 <style>
body{
  background-image: url(<?php AVMA_URL . avma_bg() ; ?>);
}
 </style>
<?php  
$avma_count_active = avma_get_option ( 'avma_count', 'general_tab' );
if ( $avma_count_active == 'Active' ) : ?>
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
    <article> <?php avma_describ() ?></article>
    <?php wp_footer(); ?> 
</body>
</html>
