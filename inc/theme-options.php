<?php

function sendeturm_customize_register( $wp_customize ) {
    $path = get_template_directory() . '/dist/css';
    $files = array_diff(scandir($path), array('.', '..'));
    $list = array();

    foreach($files as $file) {
        $path_parts = pathinfo($file);
        $list[$path_parts['filename']] = $file;
    }

    ////////////////////////////////////////////////
    // Control for Theme CSS selection

    $wp_customize->add_section( 'sendeturm_theme' , array(
        'title'      => __( 'Theme', 'sendeturm' ),
        'priority'   => 30,
    ));

    $wp_customize->add_setting( 'sendeturm_active_theme', array(
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sendeturm_sanitize_select',
        'default' => $list[0],
    ));

    $wp_customize->add_control( 'sendeturm_active_theme', array(
        'type' => 'select',
        'section' => 'sendeturm_theme', // Add a default or your own section
        'label' => __( 'Active Theme' ),
        'description' => __( 'Which Theme Stylesheet should be used?' ),
        'choices' => $list,
    ));

    
    ////////////////////////////////////////////////
    // Control for additoinal footer content

    $wp_customize->add_section( 'sendeturm_footer' , array(
        'title'      => __( 'Footer', 'sendeturm' ),
        'priority'   => 30,
    ));

    $wp_customize->add_setting( 'sendeturm_footer_content', array(
        'default' => '',
    ));
    
    $wp_customize->add_control( 'sendeturm_footer_content', array(
        'type' => 'textarea',
        'section' => 'sendeturm_footer',
        'label' => __('Custom Content'),
        'description' => __('Custom additional footer content.'),
    ));


    
    ////////////////////////////////////////////////
    // Control for analytics code

    $wp_customize->add_section( 'sendeturm_footer' , array(
        'title'      => __( 'Footer', 'sendeturm' ),
        'priority'   => 30,
    ));

    $wp_customize->add_setting( 'sendeturm_footer_analytics', array(
        'default' => '',
    ));
    
    $wp_customize->add_control( 'sendeturm_footer_analytics', array(
        'type' => 'textarea',
        'section' => 'sendeturm_footer',
        'label' => __('Analytics code'),
        'description' => __('Code for analytics.'),
    ));


    ////////////////////////////////////////////////
    // Control for the footer's "about" section

    $wp_customize->add_section( 'sendeturm_footer' , array(
        'title'      => __( 'Footer', 'sendeturm' ),
        'priority'   => 30,
    ));

    $wp_customize->add_setting( 'sendeturm_footer_about', array(
        'default' => '',
    ));
    
    $wp_customize->add_control( 'sendeturm_footer_about', array(
        'type' => 'textarea',
        'section' => 'sendeturm_footer',
        'label' => __('About the podcast'),
        'description' => __('Short description or mission statement.'),
    ));


    ////////////////////////////////////////////////
    // Control for the footer's "about" section

    $wp_customize->add_setting( 'sendeturm_home_as_blog', array(
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sendeturm_sanitize_checkbox',
    ));
      
    $wp_customize->add_control( 'sendeturm_home_as_blog', array(
        'type' => 'checkbox',
        'section' => 'sendeturm_theme', // Add a default or your own section
        'label' => __( 'Home as Blog' ),
        'description' => __( 'The homepage is used as blog if checked. Otherwise as podcast.' ),
    ));
}

function sendeturm_sanitize_checkbox( $checked ) {
    // Boolean check.
    return ( ( isset( $checked ) && true == $checked ) ? true : false );
}

add_action('customize_register', 'sendeturm_customize_register');