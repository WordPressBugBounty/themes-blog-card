<?php

/**
 * Option Panel
 *
 * @package blog card
 */

function blogcard_customize_register($wp_customize) {

// $blogcard_default = blogcard_get_default_theme_options();

//=================================
// Trending Posts Section.
//=================================

    $wp_customize->remove_section( 'header_options');
    $wp_customize->remove_section( 'frontpage_advertisement_settings');
    $wp_customize->remove_section( 'social_options');
    $wp_customize->remove_setting( 'background_color');

    
    $wp_customize->add_setting(
        'background_color', 
        array( 
            'sanitize_callback' => 'sanitize_text_field',
            'default' => '',
            
        ) 
    );
  
    $wp_customize->add_control( 'background_color', array(

            'type' => 'color',
            'label'      => __('Background Color', 'blogarise' ),
            'section' => 'colors',
            'priority' => 2,
        )
        
    );

}
add_action('customize_register', 'blogcard_customize_register');