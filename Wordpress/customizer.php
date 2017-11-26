<?php

add_action('customize_register', function($wp_customize) {

    $section = 'custom_section';
    
    $wp_customize->add_section( $section , array(
        'title'      => 'Section title',
        'priority'   => 1,
    ));

    // Multiple settings
    $config_items = array(
        'config_key' => 'Config title',
        // Add more
    );

    foreach($config_items as $key => $title) {
        $wp_customize->add_setting( $key , array(
            'default'   => '',
            'transport' => 'refresh',
        ));
        $wp_customize->add_control( new WP_Customize_Control($wp_customize, $key, array(
            'label'      => $title,
            'section'    => $section,
            'settings'   => $key,
            'type'       => 'text'
        )));
    }

    // Individual settings
    $wp_customize->add_setting( $key , array(
        'default'   => false,
        'transport' => 'refresh',
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize, $key, array(
        'label'      => $title,
        'section'    => $section,
        'settings'   => $key,
        'type'       => 'text'
    )));
});
