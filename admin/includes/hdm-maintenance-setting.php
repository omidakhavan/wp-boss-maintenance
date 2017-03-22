<?php
/**
 * @link              http://omidakhavan.ir
 * @since             1.0.0
 * @package           boss-maintenance
 *
 * */

require_once hdm_DIR . 'admin/includes/hdm-maintenance-settings-api.php' ;
class hdm_Settings {

    private $settings_api;
    function __construct() {
        $this->settings_api = new hdm_Settings_API;
        add_action( 'admin_init', array($this, 'admin_init') );
        add_action( 'admin_menu', array($this, 'admin_menu') );
    }
    function admin_init() {
        //set the settings
        $this->settings_api->set_sections( $this->get_settings_sections() );
        $this->settings_api->set_fields( $this->get_settings_fields() );
        //initialize settings
        $this->settings_api->admin_init();
    }
    function admin_menu() {
        add_menu_page( 'Maintenance Page Plugin ', 'Boss Maintenance', 'delete_posts', 'hdm-maintenace', array($this, 'plugin_page'),'dashicons-welcome-view-site',79
);
    }
    function get_settings_sections() {
        $sections = array(
            array(
                'id' => 'general_tab',
                'title' => __( 'General Settings', 'bsscommingsoon' )
            ),
            array(
                'id' => 'design_tab',
                'title' => __( 'Design Settings', 'bsscommingsoon' )
            ),
            array(
                'id' => 'com_tab',
                'title' => __( 'Contact Settings', 'bsscommingsoon' )
            )
        );
        return $sections;
    }
    /**
     * Returns all the settings fields
     *
     * @return array settings fields
     */
    function get_settings_fields() {
        $admin_email = get_option( 'admin_email' ); 
        $settings_fields = array(
            'general_tab' => array(
                array(
                    'name'              => 'hdm_div',
                    'label'             => __( '<span class="hdm_divi" > Activation </span>', 'bsscommingsoon' ),
                    'desc'              => __( '<hr>', 'bsscommingsoon' ),
                    'type'              => 'html',
                    'sanitize_callback' => 'esc_html'
                ),
                array(
                    'name'              => 'hdm_active',
                    'label'             => __( 'Active Maintenace Mode', 'bsscommingsoon' ),
                    'default'           => 'off',
                    'desc'              => __( 'Checked for activation.', 'bsscommingsoon' ),
                    'type'              => 'checkbox'
                ),
                array(
                    'name'              => 'hdm_notif',
                    'label'             => __( 'Dashboard Notifaction', 'bsscommingsoon' ),
                    'desc'              => __( 'Reminder notifaction message appear on dashboard', 'bsscommingsoon' ),
                    'type'              => 'checkbox'
                ),
                array(
                    'name'              => 'hdm_redirect',
                    'label'             => __( 'Redirect To :', 'bsscommingsoon' ),
                    'desc'              => __( 'Redirect to costum page (for example http://example.com) leave empty for disbale redirect.', 'bsscommingsoon' ),
                    'type'              => 'url',
                    'sanitize_callback' => 'esc_url',
                    'default'           => ''
                ),
                array(
                    'name'              => 'hdm_div01',
                    'label'             => __( '<span class="hdm_divi" > Counter </span>', 'bsscommingsoon' ),
                    'desc'              => __( '<hr>', 'bsscommingsoon' ),
                    'type'              => 'html'
                ),
                array(
                    'name'              => 'hdm_count',
                    'label'             => __( 'CountDown Activation', 'bsscommingsoon' ),
                    'type'              => 'radio',
                    'options'           => array(
                                        'active' => 'Active',
                                        'deactive'  => 'Deactive'
                                        )
                ),
                array(
                    'name'              => 'hdm_start_date',
                    'label'             => __( 'Date', 'bsscommingsoon' ),
                    'desc'              => __( 'Automatically disable maintenace mode at this date(mm/dd/yyyy 00:00:00)', 'bsscommingsoon' ),
                    'type'              => 'datetime',
                    'default'           => ''
                ),
                array(
                    'name'              => 'hdm_counter_color',
                    'label'             => __( 'Counter Color', 'bsscommingsoon' ),
                    'type'              => 'color',
                    'default'           => ''
                ),    
            ),
            'design_tab' => array(
                array(
                    'name'              => 'hdm_div02',
                    'label'             => __( '<span class="hdm_divi" > Logo </span>', 'bsscommingsoon' ),
                    'desc'              => __( '<hr>', 'bsscommingsoon' ),
                    'sanitize_callback' => 'esc_html',
                    'type'              => 'html'
                ),
                array(
                    'name'              => 'hdm_logo',
                    'label'             => __( 'Logo', 'bsscommingsoon' ),
                    'desc'              => __( 'Choose logo for your maintenace page', 'bsscommingsoon' ),
                    'type'              => 'file',
                    'default'           => ''
                ),
                array(
                    'name'              => 'hdm_div03',
                    'label'             => __( '<span class="hdm_divi" > Messages </span>', 'bsscommingsoon' ),
                    'desc'              => __( '<hr>', 'bsscommingsoon' ),
                    'sanitize_callback' => 'esc_html',
                    'type'              => 'html'
                ),
                array(
                    'name'              => 'hdm_page_title',
                    'label'             => __( 'Page Title', 'bsscommingsoon' ),
                    'desc'              => __( 'Title of page Notice : if empty will be show your defualt blog info.', 'bsscommingsoon' ),
                    'type'              => 'text',
                    'sanitize_callback' => 'sanitize_text_field',
                    'default'           => ''
                ),
                array(
                    'name'              => 'hdm_content_title',
                    'label'             => __( 'Message Title', 'bsscommingsoon' ),
                    'desc'              => __( 'Title of message that you want to display on your maintenace page.', 'bsscommingsoon' ),
                    'type'              => 'text',
                    'sanitize_callback' => 'sanitize_text_field',
                    'default'           => ''
                ),
                array(
                    'name'              => 'vma_title_color',
                    'label'             => __( 'Message Title Color', 'bsscommingsoon' ),
                    'desc'              => __( 'Pick Message Color ', 'bsscommingsoon' ),
                    'type'              => 'color',
                    'default'           => ''
                ),             
                array(
                    'name'              => 'hdm_describ',
                    'label'             => __( 'Maintenance Message', 'bsscommingsoon' ),
                    'type'              => 'wysiwyg'
                ),
                array(
                    'name'              => 'hdm_body_color',
                    'label'             => __( 'Message Title Color', 'bsscommingsoon' ),
                    'desc'              => __( 'Pick Message Color ', 'bsscommingsoon' ),
                    'type'              => 'color',
                    'default'           => ''
                ),
                array(
                    'name'              => 'hdm_div04',
                    'label'             => __( '<span class="hdm_divi" > Background </span>', 'bsscommingsoon' ),
                    'desc'              => __( '<hr>', 'bsscommingsoon' ),
                    'sanitize_callback' => 'esc_html',
                    'type'              => 'html'
                ),
                array(
                    'name'              => 'hdm_bg_select',
                    'label'             => __( 'Choose Background Type', 'bsscommingsoon' ),
                    'type'              => 'select',
                    'options'           => array(
                        'color'        => 'Color',
                        'image'        => 'User Image',
                        'video'        => 'video' 
                    )
                ),
                array(
                    'name'              => 'hdm_bg',
                    'label'             => __( 'Background Image', 'bsscommingsoon' ),
                    'desc'              => __( 'Choose background image for maintenace page', 'bsscommingsoon' ),
                    'type'              => 'file',
                    'sanitize_callback' => 'esc_url',
                    'default'           => ''
                ),
                array(
                    'name'              => 'hdm_bg_option',
                    'label'             => __( 'Background Image Style', 'bsscommingsoon' ),
                    'type'              => 'radio',
                    'options'           => array(
                        'stretch'   => 'Stretch',
                        'contain'   => 'Contain',
                        'cover'     => 'Cover',
                        'repeat'    => 'Repeat',
                        'repeatx'   => 'Repeat-X',
                        'repeaty'   => 'Repeat-Y'
                        )
                ),
                array(
                    'name'              => 'hdm_bg_color',
                    'label'             => __( 'Message Title Color', 'bsscommingsoon' ),
                    'desc'              => __( 'Pick Message Color ', 'bsscommingsoon' ),
                    'type'              => 'color',
                    'sanitize_callback' => 'sanitize_text_field',
                    'default'           => ''
                ),
                array(
                    'name'              => 'hdm_bg_video',
                    'label'             => __( 'Background Video', 'bsscommingsoon' ),
                    'desc'              => __( 'Ogg', 'bsscommingsoon' ),
                    'type'              => 'file',
                    'sanitize_callback' => 'esc_url',
                    'default'           => ''
                ),
                array(
                    'name'              => 'hdm_bg_webm',
                    'label'             => __( 'Background Video', 'bsscommingsoon' ),
                    'desc'              => __( 'WemM', 'bsscommingsoon' ),
                    'type'              => 'file',
                    'sanitize_callback' => 'esc_url',
                    'default'           => ''
                ),
                array(
                    'name'              => 'hdm_bg_mp4',
                    'label'             => __( 'Background Video', 'bsscommingsoon' ),
                    'desc'              => __( 'Mp4', 'bsscommingsoon' ),
                    'type'              => 'file',
                    'sanitize_callback' => 'esc_url',
                    'default'           => ''
                ),
                array(
                    'name'              => 'hdm_div05',
                    'label'             => __( '<span class="hdm_divi" > Custom Style </span>', 'bsscommingsoon' ),
                    'desc'              => __( '<hr>', 'bsscommingsoon' ),
                    'sanitize_callback' => 'esc_html',
                    'type'              => 'html'
                ),               
                array(
                    'name'              => 'hdm_style',
                    'label'             => __( 'Costum Style', 'bsscommingsoon' ),
                    'desc'              => __( 'Edit template style', 'bsscommingsoon' ),
                    'sanitize_callback' => 'esc_textarea',
                    'type'              => 'textarea'
                ),                                                   
            ),    
            'com_tab' => array(
                array(
                    'name'              => 'hdm_div06',
                    'label'             => __( '<span class="hdm_divi" > Contact Form </span>', 'bsscommingsoon' ),
                    'desc'              => __( '<hr>', 'bsscommingsoon' ),
                    'sanitize_callback' => 'esc_html',
                    'type'              => 'html'
                ),    
                array(
                    'name'              => 'hdm_contact_active',
                    'label'             => __( 'Contact Form Activation', 'bsscommingsoon' ),
                    'type'              => 'radio',
                    'options'           => array(
                            'Active' => 'Active',
                            'Deactive'  => 'Deactive'
                )),
                array(
                    'name'              => 'hdm_contact_email',
                    'label'             => __( 'Admin E-mail', 'bsscommingsoon' ),
                    'desc'              => __( 'Users message will be sent to this address.', 'bsscommingsoon' ),
                    'type'              => 'text',
                    'sanitize_callback' => 'sanitize_text_field',
                    'default'           => $admin_email
                ),
                array(
                    'name'              => 'hdm_div07',
                    'label'             => __( '<span class="hdm_divi" > NewsLetter </span>', 'bsscommingsoon' ),
                    'desc'              => __( '<hr>', 'bsscommingsoon' ),
                    'sanitize_callback' => 'esc_html',
                    'type'              => 'html'
                ),  
                array(
                    'name'              => 'hdm_newsle_active',
                    'label'             => __( 'NewsLetter Activation', 'bsscommingsoon' ),
                    'type'              => 'radio',
                    'options'           => array(
                        'active'      => 'Active',
                        'deactive'    => 'Deactive'
                )),
                array(
                    'name'              => 'hdm_news_select',
                    'label'             => __( 'News Letter', 'bsscommingsoon' ),
                    'desc'              => __( 'Select Mailing System.', 'bsscommingsoon' ),
                    'type'              => 'select',
                    'options'           => array(
                        'FeedBurner'  => 'FeedBurner',
                        'mailchimp'   => 'Mail Chimp'
                    )
                ),
                array(
                    'name'              => 'hdm_chimp_api',
                    'label'             => __( 'MailChimp Api', 'bsscommingsoon' ),
                    'desc'              => __( 'Insert your mailchimp api key here.', 'bsscommingsoon' ),
                    'type'              => 'text',
                    'sanitize_callback' => 'sanitize_text_field',
                    'default'           => ''
                ),
                array(
                    'name'              => 'hdm_chimp_list',
                    'label'             => __( 'MailChimp List Id', 'bsscommingsoon' ),
                    'desc'              => __( 'Insert your mailchimp id here ex(http://kb.mailchimp.com/lists/managing-subscribers/find-your-list-id).', 'bsscommingsoon' ),
                    'type'              => 'text',
                    'sanitize_callback' => 'sanitize_text_field',
                    'default'           => ''
                ),
                array(
                    'name'              => 'hdm_sub_feed',
                    'label'             => __( 'FeedBurner', 'bsscommingsoon' ),
                    'desc'              => __( ' http://feeds2.feedburner.com/( only enter this part ).', 'bsscommingsoon' ),
                    'type'              => 'text',
                    'sanitize_callback' => 'sanitize_text_field',
                    'default'           => ''
                ),
                array(
                    'name'              => 'hdm_sub_feed_btn',
                    'label'             => __( 'Subscriber Button', 'bsscommingsoon' ),
                    'desc'              => __( 'Subscriber Button Text.', 'bsscommingsoon' ),
                    'type'              => 'text',
                    'sanitize_callback' => 'sanitize_text_field',
                    'default'           => 'Notify Me!'
                ),
                array(
                    'name'              => 'hdm_sub_feed_txt',
                    'label'             => __( 'Subscriber Text', 'bsscommingsoon' ),
                    'desc'              => __( 'Edit subscribtion placeholder.', 'bsscommingsoon' ),
                    'type'              => 'text',
                    'sanitize_callback' => 'sanitize_text_field',
                    'default'           => 'Subscribe For Feed...'
                ),
                array(
                    'name'              => 'hdm_div08',
                    'label'             => __( '<span class="hdm_divi" > Social </span>', 'bsscommingsoon' ),
                    'desc'              => __( '<hr>', 'bsscommingsoon' ),
                    'sanitize_callback' => 'esc_html',
                    'type'              => 'html'
                ),  
                array(
                    'name'               => 'hdm_social',
                    'label'              => __( 'Social Networks', 'bsscommingsoon' ),
                    'desc'               => __( 'Show your social networks link.', 'bsscommingsoon' ),
                    'type'               => 'radio',
                    'options'            => array(
                        'active'       => 'Active',
                        'Deactive'     => 'Deactive'
                    )
                ),
                array(
                    'name'              => 'hdm_so_color',
                    'label'             => __( 'Color Of Social Icons', 'bsscommingsoon' ),
                    'type'              => 'color',
                    'default'           => ''
                ),
                array(
                    'name'              => 'hdm_social_fa',
                    'label'             => __( 'Facebook', 'bsscommingsoon' ),
                    'type'              => 'text',
                    'sanitize_callback' => 'sanitize_text_field',
                    'default'           => ''
                ),
                array(
                    'name'              => 'hdm_social_tw',
                    'label'             => __( 'Twitter', 'bsscommingsoon' ),
                    'type'              => 'text',
                    'sanitize_callback' => 'sanitize_text_field',
                    'default'           => ''
                ),
                array(
                    'name'              => 'hdm_social_in',
                    'label'             => __( 'Instagram', 'bsscommingsoon' ),
                    'type'              => 'text',
                    'sanitize_callback' => 'sanitize_text_field',
                    'default'           => ''
                ),
                array(
                    'name'              => 'hdm_social_yo',
                    'label'             => __( 'You Tube', 'bsscommingsoon' ),
                    'type'              => 'text',
                    'sanitize_callback' => 'sanitize_text_field',
                    'default'           => ''
                ),
                array(
                    'name'              => 'hdm_social_g',
                    'label'             => __( 'Google +', 'bsscommingsoon' ),
                    'type'              => 'text',
                    'sanitize_callback' => 'sanitize_text_field',
                    'default'           => ''
                ),
                array(
                    'name'              => 'hdm_social_pi',
                    'label'             => __( 'Pinterest', 'bsscommingsoon' ),
                    'type'              => 'text',
                    'sanitize_callback' => 'sanitize_text_field',
                    'default'           => ''
                ),
                array(
                    'name'              => 'hdm_social_li',
                    'label'             => __( 'Linked In', 'bsscommingsoon' ),
                    'type'              => 'text',
                    'sanitize_callback' => 'sanitize_text_field',
                    'default'           => ''
                ),
                array(
                    'name'              => 'hdm_social_dr',
                    'label'             => __( 'Dribbble', 'bsscommingsoon' ),
                    'type'              => 'text',
                    'sanitize_callback' => 'sanitize_text_field',
                    'default'           => ''
                ),
                array(
                    'name'              => 'hdm_social_gi',
                    'label'             => __( 'Github', 'bsscommingsoon' ),
                    'type'              => 'text',
                    'sanitize_callback' => 'sanitize_text_field',
                    'default'           => ''
                ),
                array(
                    'name'              => 'hdm_div09',
                    'label'             => __( '<span class="hdm_divi" > Footer </span>', 'bsscommingsoon' ),
                    'desc'              => __( '<hr>', 'bsscommingsoon' ),
                    'sanitize_callback' => 'esc_html',
                    'type'              => 'html'
                ), 
                array(
                    'name'              => 'hdm_footer',
                    'label'             => __( 'Footer Copyright', 'bsscommingsoon' ),
                    'type'              => 'text',
                    'sanitize_callback' => 'sanitize_text_field',
                    'default'           => ''
                ),
            )
        );
        return $settings_fields;
    }
    function plugin_page() {
        echo '<div class="wrap">';
        $this->settings_api->show_navigation();
        $this->settings_api->show_forms();
        echo '</div>';
    }

    /**
     * Get all the pages
     *
     * @return array page names with key value pairs
     */
    function get_pages() {
        $pages = get_pages();
        $pages_options = array();
        if ( $pages ) {
            foreach ($pages as $page) {
                $pages_options[$page->ID] = $page->post_title;
            }
        }
        return $pages_options;
    }
}
