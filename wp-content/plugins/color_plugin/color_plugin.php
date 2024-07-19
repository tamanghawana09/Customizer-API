<?php
    /**
     * Plugin Name: Color Plugin
     * Author: Hawana Tamang
     * Description: A Customizer API color plugin
     * Version: 1.0.0
     */


     function my_custom_register($wp_customize){
        $wp_customize->add_section('hawana_color',array(
            'title'=>__('Hawana Background','twentysixteen-child'),
            'priority'=>1
        ));

        $wp_customize->add_setting('body_bg',array(
            'default'=> '#fff',
            'transport'=>'refresh'
        ));

        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'body_background_color',array(
            'label' => __("New Bg Color",'twentysixteen-child'),
            'section'=>'hawana_color',
            'settings' => 'body_bg'
        )));
    }
    add_action('customize_register','my_custom_register');
    //This is method 1
    //The other method is going to the specified page and inserting the css to the php file
    function bg_customize_css(){
        ?>
            <style>
                body{
                    background-color: <?php echo get_theme_mod('body_bg','#fff')?>;
                }
            </style>
        <?php
    }
    add_action('wp_head','bg_customize_css');
?>