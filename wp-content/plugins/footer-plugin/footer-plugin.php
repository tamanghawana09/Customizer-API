<?php
/**
 * Plugin Name: Footer Plugin
 * Author: Hawana Tamang
 * Description: A Footer plugin for all the input fields
 * Version: 1.0.0
 */

 function plugin_activation() {
    if (!is_plugin_active('Panel-plugin/panel-plugin.php')) {
        deactivate_plugins(plugin_basename(__FILE__));
        add_action('admin_notices', function() {
            echo '<div class="error"><p>' . __('The Panel Plugin must be activated for the Footer Plugin to work.', 'textdomain') . '</p></div>';
        });
    }
}
add_action('admin_init', 'plugin_activation');
 function my_footer_customization($wp_customize){
    $wp_customize->add_section('footer_options',array(
        'title' => __('Footer Settings','twentysixteen-child'),
        'priority'=>2,
        'capability'=>'edit_theme_options',
        'description'=>__('Change footer options here,','twentysixteen-child'),
        'panel'=>'hawana_panel'
    ));

    $wp_customize->add_setting('footer_bg_color',
    array(
        'default' =>'f1f1f1',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,'footer_bg_color_control',array(
            'label'=>__('Footer Background Color','twentysixteen-child'),
            'section'=>'footer_options',
            'settings'=>'footer_bg_color',
            'priority'=>10,
        )
    ));
 }
 add_action('customize_register','my_footer_customization');
 
?>