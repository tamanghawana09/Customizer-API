<?php
/**
 * Plugin Name: Panel Plugin
 * Author: Hawana Tamang
 * Description: This is a plugin for creating a new panel and managing dependencies.
 * Version: 1.0.0
 */



// Add Customizer Panel
function customize_panel_register($wp_customize) {
    $wp_customize->add_panel('hawana_panel', array(
        'title'       => __('Hawana Panel', 'textdomain'),
        'description' => __('A custom panel for Hawana', 'textdomain'),
        'priority'    => 10,
    ));
}
add_action('customize_register', 'customize_panel_register');



// Function to activate required plugins
function activate_required_plugins() {
    if (!current_user_can('activate_plugins')) {
        return;
    }

    $required_plugins = array(
        'color-plugin/color-plugin.php',
        'text-plugin/text-plugin.php',
        'footer-plugin/footer-plugin.php',
        'image-plugin/image-plugin.php'
    );

    foreach ($required_plugins as $plugin) {
        if (!is_plugin_active($plugin)) {
            activate_plugin($plugin);
        }
    }
}
add_action('admin_init', 'activate_required_plugins');
?>