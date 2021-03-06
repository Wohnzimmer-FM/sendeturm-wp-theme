<?php

function sendeturm_customize_register( $wp_customize ) {
    $path = get_template_directory() . '/dist/css';
    $files = array_diff(scandir($path), array('.', '..'));
    $list = array();
    $prefix = 'theme_';

    foreach($files as $file) {
        $path_parts = pathinfo($file);

        if(substr($path_parts['filename'], 0, strlen($prefix)) != $prefix) {
            continue;
        }

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
        'label' => __('Custom Content', 'sendeturm'),
        'description' => __('Custom additional footer content.', 'sendeturm'),
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
        'label' => __('Analytics code', 'sendeturm'),
        'description' => __('Code for analytics.', 'sendeturm'),
    ));

    ////////////////////////////////////////////////
    // Control custom code

    $wp_customize->add_section( 'sendeturm_custom_content' , array(
        'title'      => __( 'Custom global content', 'sendeturm' ),
        'priority'   => 30,
    ));

    $wp_customize->add_setting( 'sendeturm_custom_content_banner', array(
        'default' => '',
    ));
    
    $wp_customize->add_control( 'sendeturm_custom_content_banner', array(
        'type' => 'textarea',
        'section' => 'sendeturm_custom_content',
        'label' => __('Banner content', 'sendeturm'),
        'description' => __('Content for the page banner displayed on every page.', 'sendeturm'),
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
        'label' => __('About the podcast', 'sendeturm'),
        'description' => __('Short description or mission statement.', 'sendeturm'),
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
        'label' => __( 'Used mainly as blog', 'sendeturm' ),
        'description' => __( 'This Wordpress instance is used as blog if checked. Otherwise as podcast.', 'sendeturm' ),
    ));

    // Based on article: https://code.tutsplus.com/tutorials/settings-and-controls-for-a-color-scheme-in-the-theme-customizer--cms-21350
    $colors = array();

    $colors[] = array(
        'slug'=>'sendeturm_main_player_color', 
        'default' => '#fff',
        'label' => __( 'Main Player Color', 'sendeturm' )
    );
    
    $colors[] = array(
        'slug'=>'sendeturm_highlight_player_color', 
        'default' => '#000',
        'label' => __( 'Highlight Player Color', 'sendeturm' )
    );

    $colors[] = array(
        'slug'=>'sendeturm_main_player_color_featured', 
        'default' => '#fff',
        'label' => __( 'Main Player Color for featured episode', 'sendeturm' )
    );
    
    $colors[] = array(
        'slug'=>'sendeturm_highlight_player_color_featured', 
        'default' => '#000',
        'label' => __( 'Highlight Player Color for featured episode', 'sendeturm' )
    );

    // add the settings and controls for each color
    foreach( $colors as $color ) {
        $wp_customize->add_setting(
            $color['slug'], array(
                'default' => $color['default'],
                'sanitize_callback' => 'sanitize_hex_color',
                'capability' => 'edit_theme_options'
            )
        );

        $wp_customize->add_control(
            new WP_Customize_Color_Control(
                $wp_customize, $color['slug'], 
                array(
                    'label' => $color['label'], 
                    'section' => 'sendeturm_theme',
                    'settings' => $color['slug']
                )
            )
        );
    }
}

function sendeturm_sanitize_checkbox( $checked ) {
    // Boolean check.
    return ( ( isset( $checked ) && true == $checked ) ? true : false );
}

add_action('customize_register', 'sendeturm_customize_register');