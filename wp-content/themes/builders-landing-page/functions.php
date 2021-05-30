<?php
/**
 * Theme functions and definitions
 *
 * @package Builders_Landing_Page
 */

/**
 * After setup theme hook
 */
function builders_landing_page_theme_setup(){
    /*
     * Make chile theme available for translation.
     * Translations can be filed in the /languages/ directory.
     */
    load_child_theme_textdomain( 'builders-landing-page', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'builders_landing_page_theme_setup' );

/**
 * Load assets.
 *
 */
function builders_landing_page_enqueue_styles_and_scripts() {
    $my_theme = wp_get_theme();
    $version = $my_theme['Version'];
    
    wp_enqueue_style( 'construction-landing-page-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'builders-landing-page-style', get_stylesheet_directory_uri() . '/style.css', array( 'construction-landing-page-style' ), $version );

    wp_enqueue_style( 'builders-landing-page-google-fonts', builders_landing_page_fonts_url(), array(), null );
}
add_action( 'wp_enqueue_scripts', 'builders_landing_page_enqueue_styles_and_scripts' );

/**
 * Dequeue scripts from parent theme
 */
function builders_landing_page_dequeue_parent_theme_styles_and_scripts(){
    wp_dequeue_style( 'construction-landing-page-google-fonts' );
    wp_deregister_style( 'construction-landing-page-google-fonts' );
}
add_action( 'wp_enqueue_scripts', 'builders_landing_page_dequeue_parent_theme_styles_and_scripts', 100 );

function builders_landing_page_remove_parent_filters(){
    remove_action( 'customize_register', 'construction_landing_page_customizer_demo_content' );
}
add_action( 'init','builders_landing_page_remove_parent_filters' );


/**
 * Implementing parent theme functions to the child theme.
 */
require get_stylesheet_directory() . '/inc/parent-functions.php';
/**
 * Implementing new child theme functions to the child theme.
 */
require get_stylesheet_directory() . '/inc/child-functions.php';

/**
 * Implementing new child theme functions to the child theme.
 */
require get_stylesheet_directory() . '/inc/fontawesome.php';