<?php
    /**
     * Plugin Name: Image Plugin
     * Author: Hawana Tamang
     * Description: This is an image plugin for additional image
     * Version: 1.0.0
     */

    function panel_active(){
        if(!is_plugin_active('Panel-plugin/panel-plugin.php')){
            deactivate_plugins( plugin_basename( __FILE__ ) );
            add_action('admin_notices',function(){
                echo '<div class="error"><p>' . __('The Panel Plugin must be activated for the Image Plugin to work.', 'textdomain') . '</p></div>';
            });
        }
    }
    add_action('admin_init','panel_active');
    
     function customize_image_register_control($wp_customize){
        $wp_customize->add_section('image_section',array(
            'title'=> __('Image Section','twentysixteen-child'),
            'priority'=>4,
            'panel'=>'hawana_panel'
        ));

        $wp_customize->add_setting('image',array(
            'default'=>'',
            'transport'=>'refresh'
        ));
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize,'custom_image',array(
           'label'=>__('Upload Image','twentysixteen-child'),
           'section'=>'image_section',
           'settings'=>'image'
        )));

        $wp_customize->add_setting('text-description',array(
            'default'=>__('Enter image description','twentysixteen-child'),
            'transport'=> 'refresh'
        ));
        $wp_customize->add_control(new WP_Customize_Control($wp_customize,'custom_image_description',array(
            'label'=>__('Image Description','twentysixteen-child'),
            'section'=>'image_section',
            'settings'=>'text-description',
            'type'=>'textarea'
        )));
     }

     add_action('customize_register','customize_image_register_control');
?>