<?php
/**
 * Plugin Name: Media Plugin
 * Author: Hawana Tamang
 * Description: This is a test media plugin
 * Version: 1.0.0
 */

function panel() {
    if (!is_plugin_active('Panel-plugin/panel-plugin.php')) {
        deactivate_plugins(plugin_basename(__FILE__));
        add_action('admin_notices', function() {
            echo '<div class="error"><p>' . __('The Panel Plugin must be activated for the Media Plugin to work.', 'textdomain') . '</p></div>';
        });
    }
}
add_action('admin_init', 'panel');

function mytheme_customize_register($wp_customize) {
    // Add a section
    $wp_customize->add_section('mytheme_media_section', array(
        'title'       => __('Media Settings', 'mytheme'),
        'description' => __('Upload your favorite song.', 'mytheme'),
        'priority'    => 30,
        'panel' => 'hawana_panel'
    ));

    // Add a setting
    $wp_customize->add_setting('mytheme_song', array(
        'default'           => '',
        'transport'         => 'refresh',
        'sanitize_callback' => 'absint', // Save as attachment ID
    ));

    // Add a control for the song
    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'mytheme_song_control', array(
        'label'    => __('Song', 'mytheme'),
        'section'  => 'mytheme_media_section',
        'settings' => 'mytheme_song',
        'mime_type' => 'audio', // Limit to audio files
    )));
}
add_action('customize_register', 'mytheme_customize_register');



function theme_music() {
    $song_id = get_theme_mod('mytheme_song');
    if ($song_id) {
        $song_url = wp_get_attachment_url($song_id);
        if ($song_url) {
            echo '<div>';
            echo '<audio controls>
                    <source src="' . esc_url($song_url) . '" type="audio/mpeg">
                    Your browser does not support the audio element.
                  </audio>';
            echo '</div>';
        } else {
            echo '<p>Invalid song URL.</p>'; // Debugging: Invalid URL
        }
    } else {
        echo '<p>No song selected.</p>'; // Debugging: No song selected
    }
}
add_action('wp_footer', 'theme_music'); // Hook to wp_footer for testing



?>