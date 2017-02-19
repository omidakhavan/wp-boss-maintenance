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
                'title' => __( 'General Settings', 'avla-maintenance' )
            ),
            array(
                'id' => 'design_tab',
                'title' => __( 'Design Settings', 'avla-maintenance' )
            ),
            array(
                'id' => 'com_tab',
                'title' => __( 'Contact Settings', 'avla-maintenance' )
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
                    'label'             => __( '<span class="hdm_divi" > Activation </span>', 'avla-maintenance' ),
                    'desc'              => __( '<hr>', 'avla-maintenance' ),
                    'type'              => 'html'
                ),
                array(
                    'name'              => 'hdm_active',
                    'label'             => __( 'Plugin Activation', 'avla-maintenance' ),
                    'default'           => 'on',
                    'desc'              => __( 'Active / Deactive', 'avla-maintenance' ),
                    'type'              => 'checkbox'
                ),
                array(
                    'name'              => 'hdm_notif',
                    'label'             => __( 'Dashboard Notifaction', 'avla-maintenance' ),
                    'desc'              => __( 'Reminder notifaction message appear on dashboard', 'avla-maintenance' ),
                    'type'              => 'checkbox'
                ),
                array(
                    'name'              => 'hdm_redirect',
                    'label'             => __( 'Redirect To :', 'avla-maintenance' ),
                    'desc'              => __( 'Redirect to costum page (for example http://example.com).', 'avla-maintenance' ),
                    'type'              => 'url',
                    'default'           => ''
                ),
                array(
                    'name'              => 'hdm_exclude',
                    'label'             => __( 'Exclude', 'avla-maintenance' ),
                    'desc'              => __( 'Exclude Page From Maintenance Mode ( Seprate With Comma )', 'avla-maintenance' ),
                    'type'              => 'textarea'
                ),
                array(
                    'name'              => 'hdm_div01',
                    'label'             => __( '<span class="hdm_divi" > Counter </span>', 'avla-maintenance' ),
                    'desc'              => __( '<hr>', 'avla-maintenance' ),
                    'type'              => 'html'
                ),
                array(
                    'name'              => 'hdm_count',
                    'label'             => __( 'CountDown Activation', 'avla-maintenance' ),
                    'type'              => 'radio',
                    'options'           => array(
                                        'active' => 'Active',
                                        'deactive'  => 'Deactive'
                                        )
                ),
                array(
                    'name'              => 'hdm_start_date',
                    'label'             => __( 'Date', 'avla-maintenance' ),
                    'desc'              => __( 'Automatically disable maintenace mode at this date(mm/dd/yyyy 00:00:00)', 'avla-maintenance' ),
                    'type'              => 'datetime',
                    'default'           => ''
                ),
                array(
                    'name'              => 'hdm_counter_color',
                    'label'             => __( 'Counter Color', 'avla-maintenance' ),
                    'type'              => 'color',
                    'default'           => ''
                ),    
            ),
            'design_tab' => array(
                array(
                    'name'              => 'hdm_div02',
                    'label'             => __( '<span class="hdm_divi" > Logo </span>', 'avla-maintenance' ),
                    'desc'              => __( '<hr>', 'avla-maintenance' ),
                    'type'              => 'html'
                ),
                array(
                    'name'              => 'hdm_logo',
                    'label'             => __( 'Logo', 'avla-maintenance' ),
                    'desc'              => __( 'Choose logo for your maintenace page', 'avla-maintenance' ),
                    'type'              => 'file',
                    'default'           => ''
                ),
                array(
                    'name'              => 'hdm_div03',
                    'label'             => __( '<span class="hdm_divi" > Messages </span>', 'avla-maintenance' ),
                    'desc'              => __( '<hr>', 'avla-maintenance' ),
                    'type'              => 'html'
                ),
                array(
                    'name'              => 'hdm_page_title',
                    'label'             => __( 'Page Title', 'avla-maintenance' ),
                    'desc'              => __( 'Title of page Notice : if empty will be show your defualt blog info.', 'avla-maintenance' ),
                    'type'              => 'text',
                    'default'           => ''
                ),
                array(
                    'name'              => 'hdm_content_title',
                    'label'             => __( 'Message Title', 'avla-maintenance' ),
                    'desc'              => __( 'Title of message that you want to display on your maintenace page.', 'avla-maintenance' ),
                    'type'              => 'text',
                    'default'           => ''
                ),
                array(
                    'name'              => 'vma_title_color',
                    'label'             => __( 'Message Title Color', 'avla-maintenance' ),
                    'desc'              => __( 'Pick Message Color ', 'avla-maintenance' ),
                    'type'              => 'color',
                    'default'           => ''
                ),             
                array(
                    'name'              => 'hdm_describ',
                    'label'             => __( 'Maintenance Message', 'avla-maintenance' ),
                    'desc'              => __( '', 'avla-maintenance' ),
                    'type'              => 'wysiwyg'
                ),
                array(
                    'name'              => 'hdm_body_color',
                    'label'             => __( 'Message Title Color', 'avla-maintenance' ),
                    'desc'              => __( 'Pick Message Color ', 'avla-maintenance' ),
                    'type'              => 'color',
                    'default'           => ''
                ),
                array(
                    'name'              => 'hdm_div04',
                    'label'             => __( '<span class="hdm_divi" > Background </span>', 'avla-maintenance' ),
                    'desc'              => __( '<hr>', 'avla-maintenance' ),
                    'type'              => 'html'
                ),
                array(
                    'name'              => 'hdm_bg_select',
                    'label'             => __( 'Choose Background Type', 'avla-maintenance' ),
                    'type'              => 'select',
                    'options'           => array(
                        'color'        => 'Color',
                        'image'        => 'User Image',
                        'video'        => 'video' 
                    )
                ),
                array(
                    'name'              => 'hdm_bg',
                    'label'             => __( 'Background Image', 'avla-maintenance' ),
                    'desc'              => __( 'Choose background image for maintenace page', 'avla-maintenance' ),
                    'type'              => 'file',
                    'default'           => ''
                ),
                array(
                    'name'              => 'hdm_bg_option',
                    'label'             => __( 'Background Image Style', 'avla-maintenance' ),
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
                    'label'             => __( 'Message Title Color', 'avla-maintenance' ),
                    'desc'              => __( 'Pick Message Color ', 'avla-maintenance' ),
                    'type'              => 'color',
                    'default'           => ''
                ),
                array(
                    'name'              => 'hdm_bg_video',
                    'label'             => __( 'Background Video', 'avla-maintenance' ),
                    'desc'              => __( 'Ogg', 'avla-maintenance' ),
                    'type'              => 'file',
                    'default'           => ''
                ),
                array(
                    'name'              => 'hdm_bg_webm',
                    'label'             => __( 'Background Video', 'avla-maintenance' ),
                    'desc'              => __( 'WemM', 'avla-maintenance' ),
                    'type'              => 'file',
                    'default'           => ''
                ),
                array(
                    'name'              => 'hdm_bg_mp4',
                    'label'             => __( 'Background Video', 'avla-maintenance' ),
                    'desc'              => __( 'Mp4', 'avla-maintenance' ),
                    'type'              => 'file',
                    'default'           => ''
                ),
                array(
                    'name'              => 'hdm_div05',
                    'label'             => __( '<span class="hdm_divi" > Custom Style </span>', 'avla-maintenance' ),
                    'desc'              => __( '<hr>', 'avla-maintenance' ),
                    'type'              => 'html'
                ),               
                array(
                    'name'              => 'hdm_style',
                    'label'             => __( 'Costum Style', 'avla-maintenance' ),
                    'desc'              => __( 'Edit template style', 'avla-maintenance' ),
                    'type'              => 'textarea'
                ),                                                   
            ),    
            'com_tab' => array(
                array(
                    'name'              => 'hdm_div06',
                    'label'             => __( '<span class="hdm_divi" > Contact Form </span>', 'avla-maintenance' ),
                    'desc'              => __( '<hr>', 'avla-maintenance' ),
                    'type'              => 'html'
                ),    
                array(
                    'name'              => 'hdm_contact_active',
                    'label'             => __( 'Contact Form Activation', 'avla-maintenance' ),
                    'type'              => 'radio',
                    'options'           => array(
                            'Active' => 'Active',
                            'Deactive'  => 'Deactive'
                )),
                array(
                    'name'              => 'hdm_contact_email',
                    'label'             => __( 'Admin E-mail', 'avla-maintenance' ),
                    'desc'              => __( 'Users message will be sent to this address.', 'avla-maintenance' ),
                    'type'              => 'text',
                    'default'           => $admin_email
                ),
                array(
                    'name'              => 'hdm_div07',
                    'label'             => __( '<span class="hdm_divi" > NewsLetter </span>', 'avla-maintenance' ),
                    'desc'              => __( '<hr>', 'avla-maintenance' ),
                    'type'              => 'html'
                ),  
                array(
                    'name'              => 'hdm_newsle_active',
                    'label'             => __( 'NewsLetter Activation', 'avla-maintenance' ),
                    'type'              => 'radio',
                    'options'           => array(
                        'active'      => 'Active',
                        'deactive'    => 'Deactive'
                )),
                array(
                    'name'              => 'hdm_news_select',
                    'label'             => __( 'News Letter', 'avla-maintenance' ),
                    'desc'              => __( 'Select Mailing System.', 'avla-maintenance' ),
                    'type'              => 'select',
                    'options'           => array(
                        'FeedBurner'  => 'FeedBurner',
                        'mailchimp'   => 'Mail Chimp'
                    )
                ),
                array(
                    'name'              => 'hdm_chimp_api',
                    'label'             => __( 'MailChimp Api', 'avla-maintenance' ),
                    'desc'              => __( 'Insert your mailchimp api key here.', 'avla-maintenance' ),
                    'type'              => 'text',
                    'default'           => ''
                ),
                array(
                    'name'              => 'hdm_chimp_list',
                    'label'             => __( 'MailChimp List Id', 'avla-maintenance' ),
                    'desc'              => __( 'Insert your mailchimp id here ex(http://kb.mailchimp.com/lists/managing-subscribers/find-your-list-id).', 'avla-maintenance' ),
                    'type'              => 'text',
                    'default'           => ''
                ),
                array(
                    'name'              => 'hdm_sub_feed',
                    'label'             => __( 'FeedBurner', 'avla-maintenance' ),
                    'desc'              => __( ' http://feeds2.feedburner.com/( only enter this part ).', 'avla-maintenance' ),
                    'type'              => 'text',
                    'default'           => ''
                ),
                array(
                    'name'              => 'hdm_sub_feed_btn',
                    'label'             => __( 'Subscriber Button', 'avla-maintenance' ),
                    'desc'              => __( 'Subscriber Button Text.', 'avla-maintenance' ),
                    'type'              => 'text',
                    'default'           => 'Notify Me!'
                ),
                array(
                    'name'              => 'hdm_sub_feed_txt',
                    'label'             => __( 'Subscriber Text', 'avla-maintenance' ),
                    'desc'              => __( 'Edit subscribtion placeholder.', 'avla-maintenance' ),
                    'type'              => 'text',
                    'default'           => 'Subscribe For Feed...'
                ),
                array(
                    'name'              => 'hdm_div08',
                    'label'             => __( '<span class="hdm_divi" > Social </span>', 'avla-maintenance' ),
                    'desc'              => __( '<hr>', 'avla-maintenance' ),
                    'type'              => 'html'
                ),  
                array(
                    'name'               => 'hdm_social',
                    'label'              => __( 'Social Networks', 'avla-maintenance' ),
                    'desc'               => __( 'Show your social networks link.', 'avla-maintenance' ),
                    'type'               => 'radio',
                    'options'            => array(
                        'active'       => 'Active',
                        'Deactive'     => 'Deactive'
                    )
                ),
                array(
                    'name'              => 'hdm_so_color',
                    'label'             => __( 'Color Of Social Icons', 'avla-maintenance' ),
                    'type'              => 'color',
                    'default'           => ''
                ),
                array(
                    'name'              => 'hdm_social_fa',
                    'label'             => __( 'Facebook', 'avla-maintenance' ),
                    'type'              => 'text',
                    'default'           => ''
                ),
                array(
                    'name'              => 'hdm_social_tw',
                    'label'             => __( 'Twitter', 'avla-maintenance' ),
                    'type'              => 'text',
                    'default'           => ''
                ),
                array(
                    'name'              => 'hdm_social_in',
                    'label'             => __( 'Instagram', 'avla-maintenance' ),
                    'type'              => 'text',
                    'default'           => ''
                ),
                array(
                    'name'              => 'hdm_social_yo',
                    'label'             => __( 'You Tube', 'avla-maintenance' ),
                    'type'              => 'text',
                    'default'           => ''
                ),
                array(
                    'name'              => 'hdm_social_g',
                    'label'             => __( 'Google +', 'avla-maintenance' ),
                    'type'              => 'text',
                    'default'           => ''
                ),
                array(
                    'name'              => 'hdm_social_pi',
                    'label'             => __( 'Pinterest', 'avla-maintenance' ),
                    'type'              => 'text',
                    'default'           => ''
                ),
                array(
                    'name'              => 'hdm_social_li',
                    'label'             => __( 'Linked In', 'avla-maintenance' ),
                    'type'              => 'text',
                    'default'           => ''
                ),
                array(
                    'name'              => 'hdm_social_dr',
                    'label'             => __( 'Dribbble', 'avla-maintenance' ),
                    'type'              => 'text',
                    'default'           => ''
                ),
                array(
                    'name'              => 'hdm_social_gi',
                    'label'             => __( 'Github', 'avla-maintenance' ),
                    'type'              => 'text',
                    'default'           => ''
                ),
                array(
                    'name'              => 'hdm_div09',
                    'label'             => __( '<span class="hdm_divi" > Footer </span>', 'avla-maintenance' ),
                    'desc'              => __( '<hr>', 'avla-maintenance' ),
                    'type'              => 'html'
                ), 
                array(
                    'name'              => 'hdm_footer',
                    'label'             => __( 'Footer Copyright', 'avla-maintenance' ),
                    'type'              => 'text',
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
