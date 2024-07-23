<?php

/**
 * Plugin Name: Form Data Plugin
 * Author: Hawana Tamang
 * Description: This is a test form data plugin
 * Version: 1.0.0
 */

function test()
{
    if (!is_plugin_active('Panel-plugin/panel-plugin.php')) {
        deactivate_plugins(plugin_basename(__FILE__));
        add_action('admin_notices', function () {
            echo '<div class="error"><p>' . __('The Panel Plugin must be activated for the Form Plugin to work.', 'textdomain') . '</p></div>';
        });
    }
}
add_action('admin_init', 'test');

function form_customize_register($wp_customize)
{
    // Add a section
    $wp_customize->add_section('form_section', array(
        'title'       => __('Form Settings', 'form'),
        'priority'    => 30,
        'panel' => 'hawana_panel'
    ));

    // Radio Button Setting
    $wp_customize->add_setting('form_radio_setting', array(
        'default'           => 'option1',
        'transport'         => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('form_radio_control', array(
        'label'    => __('Radio Button Control', 'form'),
        'section'  => 'form_section',
        'settings' => 'form_radio_setting',
        'type'     => 'radio',
        'choices'  => array(
           'Hawana' => __('Hawana', 'twentysixteen-child'),
            'Tamang' => __('Tamang', 'twentysixteen-child'),
            'DropHills' => __('DropHills', 'twentysixteen-child'),
        ),
    ));

    // Dropdown Setting
    $wp_customize->add_setting('form_dropdown_setting', array(
        'default'           => 'option1',
        'transport'         => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('form_dropdown_control', array(
        'label'    => __('Dropdown Control', 'form'),
        'section'  => 'form_section',
        'settings' => 'form_dropdown_setting',
        'type'     => 'select',
        'choices'  => array(
            'Hawana' => __('Hawana', 'twentysixteen-child'),
            'Tamang' => __('Tamang', 'twentysixteen-child'),
            'DropHills' => __('DropHills', 'twentysixteen-child'),
        ),
    ));

    // Checkbox Setting
    $wp_customize->add_setting('form_checkbox_setting', array(
        'default'           => false,
        'transport'         => 'refresh',
        'sanitize_callback' => 'wp_validate_boolean',
    ));
    $wp_customize->add_control('form_checkbox_control', array(
        'label'    => __('Checkbox Control', 'form'),
        'section'  => 'form_section',
        'settings' => 'form_checkbox_setting',
        'type'     => 'checkbox',
    ));

    // Input Field Setting
    $wp_customize->add_setting('form_input_setting', array(
        'default'           => '',
        'transport'         => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('form_input_control', array(
        'label'    => __('Input Field Control', 'form'),
        'section'  => 'form_section',
        'settings' => 'form_input_setting',
        'type'     => 'text',
    ));
}
add_action('customize_register', 'form_customize_register');


function form_display_customizer_settings()
{
    // Retrieve the customizer settings
    $radio_value = get_theme_mod('form_radio_setting', 'option1');
    $dropdown_value = get_theme_mod('form_dropdown_setting', 'option1');
    $checkbox_value = get_theme_mod('form_checkbox_setting', false);
    $input_value = get_theme_mod('form_input_setting', '');

    // Output the customizer settings
    echo '<div class="customizer-settings">';
    echo '<p>Radio Value: ' . esc_html($radio_value) . '</p>';
    echo '<p>Dropdown Value: ' . esc_html($dropdown_value) . '</p>';
    echo '<p>Checkbox Value: ' . ($checkbox_value ? 'Checked' : 'Unchecked') . '</p>';
    echo '<p>Input Value: ' . esc_html($input_value) . '</p>';
    echo '</div>';
}

// Hook to an appropriate action to display the settings
add_action('wp_footer', 'form_display_customizer_settings');