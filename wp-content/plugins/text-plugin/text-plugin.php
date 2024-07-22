<?php

/**
 * Plugin Name: Text Plugin
 * Author: Hawana Tamang
 * Description: This is a input plugin
 * Version: 1.0.0
 */
function panel_plugin_activation() {
    if (!is_plugin_active('Panel-plugin/panel-plugin.php')) {
        deactivate_plugins(plugin_basename(__FILE__));
        add_action('admin_notices', function() {
            echo '<div class="error"><p>' . __('The Panel Plugin must be activated for the Text Plugin to work.', 'textdomain') . '</p></div>';
        });
    }
}
add_action('admin_init', 'panel_plugin_activation');
function my_text_customization($wp_customize)
{
    $wp_customize->add_section('title_section', array(
        'title' => __("Sub-title", 'twentysixteen-child'),
        'priority' => 3,
        'panel'=>'hawana_panel'
    ));

    $wp_customize->add_setting('site_title', array(
        'default' => __('Enter the sub-title', 'twentysixteen-child'),
        'transport' => 'refresh'
    ));

    $wp_customize->add_control(new WP_Customize_control($wp_customize, 'theme_customization', array(
        'label' => __('Sub-title', 'twentysixteen-child'),
        'section' => 'title_section',
        'settings' => 'site_title'
    )));
}
add_action('customize_register', 'my_text_customization');


function title()
{
?>
<style>
h1::before {
    content: "<?php echo get_theme_mod('site_title', 'Enter the title'); ?>";
    display: block;
}
</style>
<?php
}
add_action('wp_head', 'title');
?>