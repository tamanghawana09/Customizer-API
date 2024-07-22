<?php
/**
 * Plugin Name: Color Plugin
 * Author: Hawana Tamang
 * Description: This is a background color plugin
 * Version: 1.0.0
 */
function check_panel_plugin_activation() {
    if (!is_plugin_active('Panel-plugin/panel-plugin.php')) {
        deactivate_plugins(plugin_basename(__FILE__));
        add_action('admin_notices', function() {
            echo '<div class="error"><p>' . __('The Panel Plugin must be activated for the Color Plugin to work.', 'textdomain') . '</p></div>';
        });
    }
}
add_action('admin_init', 'check_panel_plugin_activation');

 function my_custom_register($wp_customize) {
    // Add a section to the Customizer
    $wp_customize->add_section('hawana_color', array(
        'title'    => __('Hawana Background', 'twentysixteen-child'),
        'priority' => 1,
        'panel' => 'hawana_panel',
    ));

    // Add a setting for the background color
    $wp_customize->add_setting('body_bg', array(
        'default'   => '#fff',
        'transport' => 'refresh',
    ));

    // Add a control for the background color
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'body_background_color', array(
        'label'    => __('New Bg Color', 'twentysixteen-child'),
        'section'  => 'hawana_color',
        'settings' => 'body_bg',
    )));
}
add_action('customize_register', 'my_custom_register');

// Add custom CSS to the head for background color
function add_bg_color_css(){
    ?>
<style>
body {
    background-color: <?php echo get_theme_mod('body_bg', '#fff');
    ?>
}
</style>
<?php
}

add_action('wp_head','add_bg_color_css');
?>