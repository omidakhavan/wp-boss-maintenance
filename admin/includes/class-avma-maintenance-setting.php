<?php
/**
 * @link              http://averta.net
 * @since             1.0.0
 * @package           averta-maintenance
 *
 * */

require_once AVMA_DIR . 'admin/includes/class-settings-api.php' ;

if ( !class_exists('Avma_Settings' ) ):
class Avma_Settings {
    private $settings_api;
    function __construct() {
        $this->settings_api = new Avma_Settings_API;
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
        add_menu_page( 'Maintenance Page Plugin ', 'Averta Maintenance', 'delete_posts', 'avma-maintenace', array($this, 'plugin_page'),'dashicons-welcome-view-site',79
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
                    'name'              => 'avma_active',
                    'label'             => __( 'Plugin Activation', 'avla-maintenance' ),
                    'default'           => 'on',
                    'desc'              => __( 'Active / Deactive', 'avla-maintenance' ),
                    'type'              => 'checkbox'
                ),
                array(
                    'name'              => 'avma_notif',
                    'label'             => __( 'Dashboard Notifaction', 'avla-maintenance' ),
                    'desc'              => __( 'Reminder notifaction message appear on dashboard', 'avla-maintenance' ),
                    'type'              => 'checkbox'
                ),
                array(
                    'name'              => 'avma_redirect',
                    'label'             => __( 'Redirect To :', 'avla-maintenance' ),
                    'desc'              => __( 'Redirect to costum page (for example http://example.com).', 'avla-maintenance' ),
                    'type'              => 'url',
                    'default'           => ''
                ),
                array(
                    'name'              => 'avma_exclude',
                    'label'             => __( 'Exclude', 'avla-maintenance' ),
                    'desc'              => __( 'Exclude Page From Maintenance Mode ( Seprate With Comma )', 'avla-maintenance' ),
                    'type'              => 'textarea'
                ), 
                array(
                    'name'              => 'avma_count',
                    'label'             => __( 'CountDown Activation', 'avla-maintenance' ),
                    'type'              => 'radio',
                    'options'           => array(
                                        'Active' => 'Active',
                                        'Deactive'  => 'Deactive'
                                        )
                ),
                array(
                    'name'              => 'avma_start_date',
                    'label'             => __( 'Date', 'avla-maintenance' ),
                    'desc'              => __( 'Automatically disable maintenace mode at this date(mm/dd/yyyy 00:00:00)', 'avla-maintenance' ),
                    'type'              => 'datetime',
                    'default'           => ''
                ),
                array(
                    'name'              => 'avma_count_color',
                    'label'             => __( 'CountDown Color', 'avla-maintenance' ),
                    'desc'              => __( 'Pick CountDown Color ', 'avla-maintenance' ),
                    'type'              => 'color',
                    'default'           => ''
                ), 
            ),
            'design_tab' => array(
                array(
                    'name'              => 'avma_logo',
                    'label'             => __( 'Logo', 'avla-maintenance' ),
                    'desc'              => __( 'Choose logo for your maintenace page', 'avla-maintenance' ),
                    'type'              => 'file',
                    'default'           => ''
                ),
                array(
                    'name'              => 'avma_page_title',
                    'label'             => __( 'Page Title', 'avla-maintenance' ),
                    'desc'              => __( 'Title of page Notice : if empty will be show your defualt blog info.', 'avla-maintenance' ),
                    'type'              => 'text',
                    'default'           => ''
                ),
                array(
                    'name'              => 'avma_content_title',
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
                    'name'              => 'avma_describ',
                    'label'             => __( 'Maintenance Message', 'avla-maintenance' ),
                    'desc'              => __( '', 'avla-maintenance' ),
                    'type'              => 'wysiwyg'
                ),
                array(
                    'name'              => 'avma_body_color',
                    'label'             => __( 'Message Title Color', 'avla-maintenance' ),
                    'desc'              => __( 'Pick Message Color ', 'avla-maintenance' ),
                    'type'              => 'color',
                    'default'           => ''
                ),
                array(
                    'name'              => 'avma_bg_select',
                    'label'             => __( 'Choose Background Type', 'avla-maintenance' ),
                    'type'              => 'select',
                    'options'           => array(
                        'color'        => 'Color',
                        'image'        => 'User Image',
                        'defualt'      => 'Defualt Pictures'
                    )
                ),
                array(
                    'name'              => 'avma_bg',
                    'label'             => __( 'Background Image', 'avla-maintenance' ),
                    'desc'              => __( 'Choose background image for maintenace page', 'avla-maintenance' ),
                    'type'              => 'file',
                    'default'           => ''
                ),
                array(
                    'name'              => 'avma_bg_color',
                    'label'             => __( 'Message Title Color', 'avla-maintenance' ),
                    'desc'              => __( 'Pick Message Color ', 'avla-maintenance' ),
                    'type'              => 'color',
                    'default'           => ''
                ),                
                array(
                    'name'              => 'avma_style',
                    'label'             => __( 'Costum Style', 'avla-maintenance' ),
                    'desc'              => __( 'Edit template style', 'avla-maintenance' ),
                    'type'              => 'textarea'
                ),                                                   
            ),    
            'com_tab' => array(
                array(
                    'name'              => 'avma_contact_active',
                    'label'             => __( 'Contact Form Activation', 'avla-maintenance' ),
                    'type'              => 'radio',
                    'options'           => array(
                                        'Active' => 'Active',
                                        'Deactive'  => 'Deactive'
                )),
                array(
                    'name'              => 'avma_contact_email',
                    'label'             => __( 'Admin E-mail', 'avla-maintenance' ),
                    'desc'              => __( 'Users message will be sent to this address.', 'avla-maintenance' ),
                    'type'              => 'text',
                    'default'           => $admin_email
                ),
                array(
                    'name'              => 'avma_newsle_active',
                    'label'             => __( 'NewsLetter Activation', 'avla-maintenance' ),
                    'type'              => 'radio',
                    'options'           => array(
                        'active'      => 'Active',
                        'deactive'    => 'Deactive'
                )),
                array(
                    'name'              => 'avma_news_select',
                    'label'             => __( 'Feed Burner', 'avla-maintenance' ),
                    'desc'              => __( 'Select Mailing System.', 'avla-maintenance' ),
                    'type'              => 'select',
                    'options'           => array(
                        'avma'        => 'Averta Subscriber',
                        'FeedBurner'  => 'FeedBurner'
                    )
                ),
                array(
                    'name'              => 'avma_sub_feed',
                    'label'             => __( 'FeedBurner', 'avla-maintenance' ),
                    'desc'              => __( 'Your feedburner link.', 'avla-maintenance' ),
                    'type'              => 'text',
                    'default'           => ' http://feeds2.feedburner.com/( only enter this part )'
                ),
                array(
                    'name'              => 'avma_sub_feed_btn',
                    'label'             => __( 'FeedBurner Button', 'avla-maintenance' ),
                    'desc'              => __( 'Feed Burner Button Text.', 'avla-maintenance' ),
                    'type'              => 'text',
                    'default'           => 'Notify Me!'
                ),
                array(
                    'name'              => 'avma_sub_feed_txt',
                    'label'             => __( 'FeedBurner Text', 'avla-maintenance' ),
                    'desc'              => __( 'Edit text subscribtion placeholder.', 'avla-maintenance' ),
                    'type'              => 'text',
                    'default'           => 'Subscribe For Feed...'
                ),
                array(
                    'name'               => 'avma_social',
                    'label'              => __( 'Social Networks', 'avla-maintenance' ),
                    'desc'               => __( 'Show your social networks link.', 'avla-maintenance' ),
                    'type'               => 'radio',
                    'options'            => array(
                        'active'       => 'Active',
                        'Deactive'     => 'Deactive'
                    )
                ),
                array(
                    'name'              => 'avma_social_fa',
                    'label'             => __( 'Facebook', 'avla-maintenance' ),
                    'type'              => 'text',
                    'default'           => ''
                ),
                array(
                    'name'              => 'avma_social_tw',
                    'label'             => __( 'Twitter', 'avla-maintenance' ),
                    'type'              => 'text',
                    'default'           => ''
                ),
                array(
                    'name'              => 'avma_social_in',
                    'label'             => __( 'Instagram', 'avla-maintenance' ),
                    'type'              => 'text',
                    'default'           => ''
                ),
                array(
                    'name'              => 'avma_social_yo',
                    'label'             => __( 'You Tube', 'avla-maintenance' ),
                    'type'              => 'text',
                    'default'           => ''
                ),
                array(
                    'name'              => 'avma_social_g',
                    'label'             => __( 'Google +', 'avla-maintenance' ),
                    'type'              => 'text',
                    'default'           => ''
                ),
                array(
                    'name'              => 'avma_social_pi',
                    'label'             => __( 'Pinterest', 'avla-maintenance' ),
                    'type'              => 'text',
                    'default'           => ''
                ),
                array(
                    'name'              => 'avma_social_li',
                    'label'             => __( 'Linked In', 'avla-maintenance' ),
                    'type'              => 'text',
                    'default'           => ''
                ),
                array(
                    'name'              => 'avma_social_dr',
                    'label'             => __( 'Dribbble', 'avla-maintenance' ),
                    'type'              => 'text',
                    'default'           => ''
                ),
                array(
                    'name'              => 'avma_social_gi',
                    'label'             => __( 'Github', 'avla-maintenance' ),
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
endif;