<?php
/**
 * WordPress settings API demo class
 *
 * @author Tareq Hasan
 */
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
                'id' => 'design_tab',
                'title' => __( 'Mail Settings', 'avla-maintenance' )
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
        $settings_fields = array(
            'wedevs_basics' => array(
                array(
                    'name'              => 'text_val',
                    'label'             => __( 'Text Input', 'wedevs' ),
                    'desc'              => __( 'Text input description', 'wedevs' ),
                    'type'              => 'text',
                    'default'           => 'Title',
                    'sanitize_callback' => 'intval'
                ),
                array(
                    'name'              => 'number_input',
                    'label'             => __( 'Number Input', 'wedevs' ),
                    'desc'              => __( 'Number field with validation callback `intval`', 'wedevs' ),
                    'type'              => 'number',
                    'default'           => 'Title',
                    'sanitize_callback' => 'intval'
                ),
                array(
                    'name'  => 'textarea',
                    'label' => __( 'Textarea Input', 'wedevs' ),
                    'desc'  => __( 'Textarea description', 'wedevs' ),
                    'type'  => 'textarea'
                ),
                array(
                    'name'  => 'checkbox',
                    'label' => __( 'Checkbox', 'wedevs' ),
                    'desc'  => __( 'Checkbox Label', 'wedevs' ),
                    'type'  => 'checkbox'
                ),
                array(
                    'name'    => 'radio',
                    'label'   => __( 'Radio Button', 'wedevs' ),
                    'desc'    => __( 'A radio button', 'wedevs' ),
                    'type'    => 'radio',
                    'options' => array(
                        'yes' => 'Yes',
                        'no'  => 'No'
                    )
                ),
                array(
                    'name'    => 'multicheck',
                    'label'   => __( 'Multile checkbox', 'wedevs' ),
                    'desc'    => __( 'Multi checkbox description', 'wedevs' ),
                    'type'    => 'multicheck',
                    'options' => array(
                        'one'   => 'One',
                        'two'   => 'Two',
                        'three' => 'Three',
                        'four'  => 'Four'
                    )
                ),
                array(
                    'name'    => 'selectbox',
                    'label'   => __( 'A Dropdown', 'wedevs' ),
                    'desc'    => __( 'Dropdown description', 'wedevs' ),
                    'type'    => 'select',
                    'default' => 'no',
                    'options' => array(
                        'yes' => 'Yes',
                        'no'  => 'No'
                    )
                ),
                array(
                    'name'    => 'password',
                    'label'   => __( 'Password', 'wedevs' ),
                    'desc'    => __( 'Password description', 'wedevs' ),
                    'type'    => 'password',
                    'default' => ''
                ),
                array(
                    'name'    => 'file',
                    'label'   => __( 'File', 'wedevs' ),
                    'desc'    => __( 'File description', 'wedevs' ),
                    'type'    => 'file',
                    'default' => '',
                    'options' => array(
                        'button_label' => 'Choose Image'
                    )
                )
            ),
            'wedevs_advanced' => array(
                array(
                    'name'    => 'color',
                    'label'   => __( 'Color', 'wedevs' ),
                    'desc'    => __( 'Color description', 'wedevs' ),
                    'type'    => 'color',
                    'default' => ''
                ),
                array(
                    'name'    => 'password',
                    'label'   => __( 'Password', 'wedevs' ),
                    'desc'    => __( 'Password description', 'wedevs' ),
                    'type'    => 'password',
                    'default' => ''
                ),
                array(
                    'name'    => 'wysiwyg',
                    'label'   => __( 'Advanced Editor', 'wedevs' ),
                    'desc'    => __( 'WP_Editor description', 'wedevs' ),
                    'type'    => 'wysiwyg',
                    'default' => ''
                ),
                array(
                    'name'    => 'multicheck',
                    'label'   => __( 'Multile checkbox', 'wedevs' ),
                    'desc'    => __( 'Multi checkbox description', 'wedevs' ),
                    'type'    => 'multicheck',
                    'default' => array('one' => 'one', 'four' => 'four'),
                    'options' => array(
                        'one'   => 'One',
                        'two'   => 'Two',
                        'three' => 'Three',
                        'four'  => 'Four'
                    )
                ),
                array(
                    'name'    => 'selectbox',
                    'label'   => __( 'A Dropdown', 'wedevs' ),
                    'desc'    => __( 'Dropdown description', 'wedevs' ),
                    'type'    => 'select',
                    'options' => array(
                        'yes' => 'Yes',
                        'no'  => 'No'
                    )
                ),
                array(
                    'name'    => 'password',
                    'label'   => __( 'Password', 'wedevs' ),
                    'desc'    => __( 'Password description', 'wedevs' ),
                    'type'    => 'password',
                    'default' => ''
                ),
                array(
                    'name'    => 'file',
                    'label'   => __( 'File', 'wedevs' ),
                    'desc'    => __( 'File description', 'wedevs' ),
                    'type'    => 'file',
                    'default' => ''
                )
            ),
            'wedevs_others' => array(
                array(
                    'name'    => 'text',
                    'label'   => __( 'Text Input', 'wedevs' ),
                    'desc'    => __( 'Text input description', 'wedevs' ),
                    'type'    => 'text',
                    'default' => 'Title'
                ),
                array(
                    'name'  => 'textarea',
                    'label' => __( 'Textarea Input', 'wedevs' ),
                    'desc'  => __( 'Textarea description', 'wedevs' ),
                    'type'  => 'textarea'
                ),
                array(
                    'name'  => 'checkbox',
                    'label' => __( 'Checkbox', 'wedevs' ),
                    'desc'  => __( 'Checkbox Label', 'wedevs' ),
                    'type'  => 'checkbox'
                ),
                array(
                    'name'    => 'radio',
                    'label'   => __( 'Radio Button', 'wedevs' ),
                    'desc'    => __( 'A radio button', 'wedevs' ),
                    'type'    => 'radio',
                    'options' => array(
                        'yes' => 'Yes',
                        'no'  => 'No'
                    )
                ),
                array(
                    'name'    => 'multicheck',
                    'label'   => __( 'Multile checkbox', 'wedevs' ),
                    'desc'    => __( 'Multi checkbox description', 'wedevs' ),
                    'type'    => 'multicheck',
                    'options' => array(
                        'one'   => 'One',
                        'two'   => 'Two',
                        'three' => 'Three',
                        'four'  => 'Four'
                    )
                ),
                array(
                    'name'    => 'selectbox',
                    'label'   => __( 'A Dropdown', 'wedevs' ),
                    'desc'    => __( 'Dropdown description', 'wedevs' ),
                    'type'    => 'select',
                    'options' => array(
                        'yes' => 'Yes',
                        'no'  => 'No'
                    )
                ),
                array(
                    'name'    => 'password',
                    'label'   => __( 'Password', 'wedevs' ),
                    'desc'    => __( 'Password description', 'wedevs' ),
                    'type'    => 'password',
                    'default' => ''
                ),
                array(
                    'name'    => 'file',
                    'label'   => __( 'File', 'wedevs' ),
                    'desc'    => __( 'File description', 'wedevs' ),
                    'type'    => 'file',
                    'default' => ''
                )
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