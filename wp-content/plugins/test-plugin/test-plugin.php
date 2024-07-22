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


function menu_customizer_preview_nav_menu($setting) {
    $menu_id = str_replace('nav_menu_', '', $setting->id);

    add_filter('wp_get_nav_menu_items', function($items, $menu, $args) use ($menu_id, $setting) {
        $preview_menu_id = $menu->term_id;

        if ($menu_id == $preview_menu_id) {
            $new_ids = $setting->post_value();
            $new_items = [];
            $i = 1;

            foreach ($new_ids as $item_id) {
                $item = wp_setup_nav_menu_item(get_post($item_id));
                $item->menu_order = $i;
                $new_items[] = $item;
                $i++;
            }
            return $new_items;
        } else {
            return $items;
        }
    }, 10, 3);
}
add_action('customize_preview_nav_menu', 'menu_customizer_preview_nav_menu', 10, 2);
?>