<?php
/**
 * Plugin Name: Test plugin
 * Author: Hawana Tamang
 * Description: This is a testing plugin
 * Version: 1.0.0
 */
function mytheme_customize_register($wp_customize) {
    // Add a custom section
    $wp_customize->add_section('mytheme_new_section', array(
        'title'      => __('Custom Section', 'mytheme'),
        'priority'   => 30,
    ));

    // Add a setting for the color picker
    $wp_customize->add_setting('background_color', array(
        'default'   => '#ffffff',
        'transport' => 'refresh',
    ));

    // Add the color picker control
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'background_color_control', array(
        'label'      => __('Background Color', 'mytheme'),
        'section'    => 'mytheme_new_section',
        'settings'   => 'background_color',
    )));

    // Add a setting for the text input
    $wp_customize->add_setting('custom_text', array(
        'default'   => __('Default Text', 'mytheme'),
        'transport' => 'refresh',
    ));

    // Add the text input control
    $wp_customize->add_control('custom_text_control', array(
        'label'      => __('Custom Text', 'mytheme'),
        'section'    => 'mytheme_new_section',
        'settings'   => 'custom_text',
        'type'       => 'text',
    ));
}
add_action('customize_register', 'mytheme_customize_register');

// Apply the customizations to the theme
function mytheme_customize_css() {
    ?>
<style type="text/css">
body {
    background-color: <?php echo get_theme_mod('background_color', '#ffffff');
    ?>;
}
</style>
<?php
}
add_action('wp_head', 'mytheme_customize_css');

?>