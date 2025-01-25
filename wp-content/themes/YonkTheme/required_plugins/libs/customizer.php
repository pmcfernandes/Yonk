<?php

    if (!defined('ABSPATH')) {
        exit;
    }

    /**
     * Register custom customizer properties
     * 
     * @param object $wp_customizer
     * @return void
     */
    function theme_customize_register( $wp_customize ) {

        $wp_customize->add_section('Yonk_theme_options', array(
            'title'    => __( 'Theme Layout Settings', 'blank' ),
            'description' => __( 'Container width and sidebar defaults', 'blank' ),
            'priority' => 160,
        )); 
    
        $wp_customize->add_setting('Yonk_theme_options[container]', array(
            'default'        => 'container',
            'capability'     => 'edit_theme_options',
            'type'           => 'option',
    
        ));

        $wp_customize->add_control('Yonk_theme_options_container', array(
            'settings'      => 'Yonk_theme_options[container]',
            'label'         => __( 'Container Width', 'blank' ),
            'description'   => __( 'Choose between Bootstrap\'s container and container-fluid', 'blank' ),
            'section'       => 'Yonk_theme_options',
            'type'          => 'select',
            'choices'       => array(
                'container'       => __( 'Fixed width container', 'blank' ),
				'container-fluid' => __( 'Full width container', 'blank' ),
            ),
        ));
      
    }

    add_action( 'customize_register', 'theme_customize_register' );


