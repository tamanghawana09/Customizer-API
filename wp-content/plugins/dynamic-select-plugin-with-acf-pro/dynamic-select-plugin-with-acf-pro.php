<?php
/**
 * Plugin Name: Dynamic Select Plugin with ACF Pro
 * Description: Creates a form with options from an ACF repeater field and redirects based on selected options.
 * Version: 2.0
 * Author: Ujjwal Shrestha
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

// Function to check if ACF Pro is active
function check_acf_pro_dependency() {
    if ( ! class_exists('ACF') || ! function_exists('acf_add_local_field_group') ) {
        // Deactivate the plugin
        deactivate_plugins(plugin_basename(__FILE__));

        // Display admin notice
        add_action('admin_notices', function() {
            echo '<div class="notice notice-error"><p><strong>Dynamic Select Plugin with ACF Pro</strong> requires ACF Pro to be installed and activated. The plugin has been deactivated.</p></div>';
        });

        return;
    }
}

// Hook into admin_init to check ACF Pro on plugin activation
add_action('admin_init', 'check_acf_pro_dependency');

// Enqueue script and localize data
function enqueue_dynamic_select_script() {
    wp_enqueue_script('dynamic-select-script', plugin_dir_url(__FILE__) . 'js/dynamic-select-script.js', array('jquery'), null, true);

    $repeater_data = get_field('option', 'option'); // Replace 'option' with the actual field name
    wp_localize_script('dynamic-select-script', 'acfData', array('repeaterData' => $repeater_data));
}
add_action('wp_enqueue_scripts', 'enqueue_dynamic_select_script');

// Shortcode for the form
function dynamic_select_form() {
    $repeater_data = get_field('option', 'option'); // Replace 'option' with the actual field name

    if ($repeater_data) {
        ob_start();
        ?>
        <form id="redirectForm">
            <select id="option1" name="option1">
                <option value="">Select First Option</option>
            </select>

            <select id="option2" name="option2">
                <option value="">Select Second Option</option>
            </select>

            <button type="submit">Submit</button>
        </form>
        <?php
        return ob_get_clean();
    } else {
        return '<p>No options available at the moment.</p>';
    }
}
add_shortcode('dynamic_select_form', 'dynamic_select_form');

// Create the options page
function create_dynamic_select_options_page() {
    if( function_exists('acf_add_options_page') ) {
        acf_add_options_page(array(
            'page_title'    => 'Dynamic Select Option',
            'menu_title'    => 'Dynamic Select Option',
            'menu_slug'     => 'acf-options-dynamic-select-option',
            'capability'    => 'edit_posts',
            'redirect'      => false
        ));
    }
}
add_action('acf/init', 'create_dynamic_select_options_page');

// Function to create the ACF repeater field
function create_acf_repeater_field() {
    if( function_exists('acf_add_local_field_group') ) {
        acf_add_local_field_group(array(
            'key' => 'group_option_fields',
            'title' => 'Option Fields',
            'fields' => array(
                array(
                    'key' => 'field_option',
                    'label' => 'Option',
                    'name' => 'option',
                    'type' => 'repeater',
                    'sub_fields' => array(
                        array(
                            'key' => 'field_option1',
                            'label' => 'Option1',
                            'name' => 'option1',
                            'type' => 'text',
                            'required' => 1,
                        ),
                        array(
                            'key' => 'field_option2',
                            'label' => 'Option2',
                            'name' => 'option2',
                            'type' => 'text',
                            'required' => 1,
                        ),
                        array(
                            'key' => 'field_url',
                            'label' => 'URL',
                            'name' => 'url',
                            'type' => 'text',
                            'required' => 1,
                        ),
                    ),
                ),
                array(
                    'key' => 'field_shortcode_display',
                    'label' => 'Shortcode',
                    'name' => 'shortcode_display',
                    'type' => 'message',
                    'message' => 'Use the shortcode [dynamic_select_form] to display the form.',
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'options_page',
                        'operator' => '==',
                        'value' => 'acf-options-dynamic-select-option',
                    ),
                ),
            ),
        ));
    }
}
add_action('acf/init', 'create_acf_repeater_field');
